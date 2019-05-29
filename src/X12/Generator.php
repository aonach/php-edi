<?php

namespace Aonach\X12;

use Aonach\X12\Generator\AckGenerator;
use Aonach\X12\Generator\BakGenerator;
use Aonach\X12\Generator\CttGenerator;
use Aonach\X12\Generator\GeGenerator;
use Aonach\X12\Generator\GsGenerator;
use Aonach\X12\Generator\IeaGenerator;
use Aonach\X12\Generator\IsaGenerator;
use Aonach\X12\Generator\N1Generator;
use Aonach\X12\Generator\Po1Generator;
use Aonach\X12\Generator\SeGenerator;
use Aonach\X12\Generator\StGenerator;
use Aonach\X12\Generator\DtmGenerator;
use Aonach\X12\Generator\Product;
use Faker\Provider\Base;

/**
 * Class Generator
 * @package Aonach\X12
 */
class Generator
{
    /**
     * @var $ackGenerator AckGenerator
     */
    private $ackGenerator = array();
    /**
     * @var $bakGenerator BakGenerator
     */
    private $bakGenerator;
    /**
     * @var $cttGenerator CttGenerator
     */
    private $cttGenerator;
    /**
     * @var $geGenerator GeGenerator
     */
    private $geGenerator;
    /**
     * @var
     */
    private $gsGenerator;
    /**
     * @var
     */
    private $ieaGenerator;

    /**
     * @var $isaGenerator isaGenerator
     */
    private $isaGenerator;

    /**
     * @var
     */
    private $po1Generator = array();
    /**
     * @var
     */
    private $seGenerator;
    /**
     * @var
     */
    private $stGenerator;

    /**
     * @var array
     */
    private $dtmGenerator;

    /**
     * @var
     */
    private $settings;

    /**
     * @var
     */
    private $productsData;

    /**
     * @var
     */
    private $extraInformation;

    /**
     * Generator constructor.
     */
    public function __construct($settings, array $products, $extraInformation)
    {
        $this->setSettings($settings);
        $this->setProductsData($products);
        $this->setExtraInformation($extraInformation);
    }
    
    /**
     * @return string
     */
    public function generate()
    {
        //Initializing all segments.

        $this->initIsaGenerator();
        $this->initGsGenerator();
        $this->initStGenerator();
        $this->initBakGenerator();

        $this->initPo1Generator();

        $this->initAckGenerator();

        $this->initCttGenerator();
        $this->initSeGenerator();
        $this->initGeGenerator();
        $this->initIeaGenerator();


        return $this->__generate();

    }

    /**
     * @return string
     */
    private function __generate()
    {
        $this->getIsaGenerator()->build();
        $this->getGsGenerator()->build();
        $this->getStGenerator()->build();
        $this->getBakGenerator()->build();
//        $this->getN1Generator()->build();

        foreach ($this->getPo1Generator() as $po1) {
            $po1->build();
        }

        foreach ($this->getAckGenerator() as $ack) {
            $ack->build();
        }

        $this->getCttGenerator()->build();
        $this->getSeGenerator()->build();
        $this->getGeGenerator()->build();
        $this->getIeaGenerator()->build();

        $fileContent = array();

        $fileContent[] = $this->getIsaGenerator()->__toString();
        $fileContent[] = $this->getGsGenerator()->__toString();
        $fileContent[] = $this->getStGenerator()->__toString();
        $fileContent[] = $this->getBakGenerator()->__toString();

        for ($i = 0; $i < count($this->getPo1Generator()); $i++) {
            $fileContent[] = $this->getPo1Generator()[$i]->__toString();
            $fileContent[] = $this->getAckGenerator()[$i]->__toString();
            if($this->getAckGenerator()[$i]->getLineItemStatusCode() == 'IA' || $this->getAckGenerator()[$i]->getLineItemStatusCode() == 'IQ'){
                $this->initDtmGenerator($this->extraInformation["855_data"]->dtm[1]->date);
                $this->getDtmGenerator()->build();
                $fileContent[] = $this->getDtmGenerator()->__toString();
            }
        }
        $fileContent[] = $this->getCttGenerator()->__toString();
        $fileContent[] = $this->getSeGenerator()->__toString();
        $fileContent[] = $this->getGeGenerator()->__toString();
        $fileContent[] = $this->getIeaGenerator()->__toString() . '~';

        return implode('~', $fileContent);
    }

    /**
     *
     */
    private function initIsaGenerator()
    {
        $this->setIsaGenerator(new isaGenerator(
            $this->getSettings()['amazon/authorization_qualifier'],
            $this->getSettings()['amazon/authorization_information'],
            $this->getSettings()['amazon/security_qualifier'],
            $this->getSettings()['amazon/security_information'],
            $this->getExtraInformation()['855_data']->interchange_receiver_id, // this will be used in the 'Interchange Sender's ID
            $this->getSettings()['amazon/usage_indicator']
        ));

        $this->getIsaGenerator()->setInterchangeIdQualifier01($this->getSettings()['amazon/interchange_id_qualifier']);
        $this->getIsaGenerator()->setInterchangeIdQualifier02($this->getSettings()['amazon/interchange_id_qualifier']);
        $this->getIsaGenerator()->setInterchangeControlNumber($this->getExtraInformation()['855_data']->isa_interchange_control_number);
    }

    /**
     *
     */
    private function initGsGenerator()
    {
        $this->setGsGenerator(new GsGenerator(
            $this->getExtraInformation()['855_data']->application_receiver_code, // This will be used in the 'Application Sender's Code'.
            $this->getExtraInformation()['855_data']->gs_group_control_number
        ));
    }

    /**
     *
     */
    private function initStGenerator()
    {
        $this->setStGenerator(new StGenerator(
            $this->getExtraInformation()['855_data']->transaction_control_number
        ));
    }

    /**
     *
     */
    private function initBakGenerator()
    {
        $this->setBakGenerator(
            new BakGenerator(
                $this->getExtraInformation()['855_data']->purchase_order_number,
                $this->getExtraInformation()['855_data']->date)
        );
    }

   private function initDtmGenerator($date)
   {
       $this->setDtmGenerator(new DtmGenerator($date));
   }

    /**
     * Init CTT generator
     * Gets the amount of PO1 items and sum all qty ordered.
     * 
     */
    private function initCttGenerator()
    {
        $ctt02 = 0;

        foreach ($this->getPo1Generator() as $po) {
            $ctt02 += $po->getQuantityOrdered();
        }

        $this->setCttGenerator(new CttGenerator($this->getNumberOfLineItems(), $ctt02));
    }

    /**
     *
     */
    private function initSeGenerator()
    {
        $this->setSeGenerator(new SeGenerator(
            $this->getNumberOfSegments(),
            $this->getExtraInformation()['855_data']->transaction_control_number
        ));
    }

    /**
     *
     */
    private function initGeGenerator()
    {
        $this->setGeGenerator(new GeGenerator(
            $this->getExtraInformation()['855_data']->number_of_transactions,
            $this->getExtraInformation()['855_data']->ge_group_control_number
        ));
    }

    /**
     *
     */
    private function initIeaGenerator()
    {
        $this->setIeaGenerator(new IeaGenerator(
            $this->getExtraInformation()['855_data']->number_of_functional_groups,
            $this->getExtraInformation()['855_data']->iea_interchange_control_number
        ));
    }

    /**
     *
     */
    private function initPo1Generator()
    {
        foreach ($this->getExtraInformation()['855_data']->po1 as $item) {
            $product = new Product();

            $product->setAssignedIdentification($item->assigned_identification);
            $product->setQuantityOrdered($item->quantity_ordered);
            $product->setMeasurementCode('EA'); //Fixed value for Amazon
            $product->setUnitPrice($item->unit_price);
            $product->setBasisUnitPriceCode(null);
            $product->setProductIdQualifier('EN'); //Fixed value for Amazon
            $product->setProductId($item->buyer_product_id);

            $po1Obj = new Po1Generator($product);

            $this->setPo1Generator($po1Obj);

        }
    }

    /**
     * Init ACK generator
     * Checking all products information
     */
    private function initAckGenerator()
    {

        $itemsIncluded = array();

        foreach ($this->getExtraInformation()['855_data']->po1 as $item) {
            //Shipping Items
            foreach ($this->productsData as $product){
                $ackObj = new AckGenerator($product);

                if($item->buyer_product_id == $product->getProductId()) {
                    if($item->quantity_ordered > $product->getQuantityOrdered()){
                        $ackObj->setLineItemStatusCode('IQ');
                        $ackObj->setDate($this->extraInformation["855_data"]->dtm[0]->date);
                        $this->setAckGenerator($ackObj);
                        $itemsIncluded[] = $item->buyer_product_id;
                        break;
                    }
                    $ackObj->setLineItemStatusCode('IA');
                    $ackObj->setDate($this->extraInformation["855_data"]->dtm[0]->date);
                    $this->setAckGenerator($ackObj);
                    $itemsIncluded[] = $item->buyer_product_id;
                    break;
                }
            }

            //Rejected Items
            if(isset($this->getExtraInformation()['rejectedItems'])){
                foreach ($this->getExtraInformation()['rejectedItems'] as $rejectedItem) {
                    if($rejectedItem->getQuantityOrdered() == 0){
                        $rejectedItem->setQuantityOrdered($item->quantity_ordered);
                    }
                    $ackObj = new AckGenerator($rejectedItem);
                    if($item->buyer_product_id == $rejectedItem->getProductId()) {
                        $ackObj->setLineItemStatusCode('IR');
                        $this->setAckGenerator($ackObj);
                        $itemsIncluded[] = $item->buyer_product_id;
                        break;
                    }
                }
            }

            // Missing Items;
            $isOn = false;
            if(isset($this->getExtraInformation()['rejectedItems'])) {
                foreach ($this->getExtraInformation()['rejectedItems'] as $rejectedItem) {
                    if ($item->buyer_product_id == $rejectedItem->getProductId()) {
                        $isOn = true;
                        break;
                    }
                }
            }

            foreach ($this->getProductsData() as $product) {
                if ($item->buyer_product_id == $product->getProductId()) {
                    $isOn = true;
                    break;
                }
            }

            if(!$isOn){
                $product = new Product();

                $product->setAssignedIdentification($item->assigned_identification);
                $product->setQuantityOrdered($item->quantity_ordered);
                $product->setMeasurementCode('EA'); //Fixed value for Amazon
                $product->setUnitPrice($item->unit_price);
                $product->setBasisUnitPriceCode(null);
                $product->setProductIdQualifier('EN'); //Fixed value for Amazon
                $product->setProductId($item->buyer_product_id);

                $ackObj = new AckGenerator($product);
                $ackObj->setLineItemStatusCode('R2');

                $this->setAckGenerator($ackObj);
            }
        }

        $allIncludedProducts = array();

        foreach ($this->getAckGenerator() as $ackItem) {
            $allIncludedProducts[] = $ackItem->getProductId();
        }

        foreach ($this->getExtraInformation()['855_data']->po1 as $item) {
            if(!in_array($item->buyer_product_id, $allIncludedProducts)){
                $product = new Product();

                $product->setAssignedIdentification($item->assigned_identification);
                $product->setQuantityOrdered($item->quantity_ordered);
                $product->setMeasurementCode('EA'); //Fixed value for Amazon
                $product->setUnitPrice($item->unit_price);
                $product->setBasisUnitPriceCode(null);
                $product->setProductIdQualifier('EN'); //Fixed value for Amazon
                $product->setProductId($item->buyer_product_id);

                $ackObj = new AckGenerator($product);

                $ackObj->setLineItemStatusCode('R2');
                $this->setAckGenerator($ackObj);
            }
        }
    }
    

    /**
     * Get the amount of Segments in the file.
     * We are summing up all segments between ST and SE segments (the 4 number down there).
     * Including all occurrences of the PO1, ACK and DTM segments.
     * 
     * @return int
     */
    public function getNumberOfSegments()
    {
        $po1Count = count($this->getPo1Generator());
        $ackCount = count($this->getAckGenerator());
        $dtmCount = 0;

        foreach ($this->getAckGenerator() as $ackItem) {
            if(in_array($ackItem->getLineItemStatusCode(), ['IQ', 'IA'])){
                $dtmCount++;
            }
        }

        return $po1Count + $ackCount + $dtmCount + 4;
    }

    /**
     * @return int
     */
    public function getNumberOfLineItems()
    {
        return count($this->getPo1Generator());
    }

    /**
     * @return mixed
     */
    public function getAckGenerator()
    {
        return $this->ackGenerator;
    }

    /**
     * @param mixed $ackGenerator
     */
    public function setAckGenerator($ackGenerator): void
    {
        $this->ackGenerator[] = $ackGenerator;
    }

    /**
     * @return BakGenerator
     */
    public function getBakGenerator()
    {
        return $this->bakGenerator;
    }

    /**
     * @param BakGenerator $bakGenerator
     */
    public function setBakGenerator($bakGenerator): void
    {
        $this->bakGenerator = $bakGenerator;
    }

    /**
     * @return mixed
     */
    public function getCttGenerator()
    {
        return $this->cttGenerator;
    }

    /**
     * @param mixed $cttGenerator
     */
    public function setCttGenerator($cttGenerator): void
    {
        $this->cttGenerator = $cttGenerator;
    }

    /**
     * @return mixed
     */
    public function getGeGenerator()
    {
        return $this->geGenerator;
    }

    /**
     * @param mixed $geGenerator
     */
    public function setGeGenerator($geGenerator): void
    {
        $this->geGenerator = $geGenerator;
    }

    /**
     * @return mixed
     */
    public function getGsGenerator()
    {
        return $this->gsGenerator;
    }

    /**
     * @param mixed $gsGenerator
     */
    public function setGsGenerator($gsGenerator): void
    {
        $this->gsGenerator = $gsGenerator;
    }

    /**
     * @return mixed
     */
    public function getIeaGenerator()
    {
        return $this->ieaGenerator;
    }

    /**
     * @param mixed $ieaGenerator
     */
    public function setIeaGenerator($ieaGenerator): void
    {
        $this->ieaGenerator = $ieaGenerator;
    }

    /**
     * @return isaGenerator
     */
    public function getIsaGenerator()
    {
        return $this->isaGenerator;
    }

    /**
     * @param mixed $isaGenerator
     */
    public function setIsaGenerator($isaGenerator): void
    {
        $this->isaGenerator = $isaGenerator;
    }

    /**
     * @return mixed
     */
    public function getN1Generator()
    {
        return $this->n1Generator;
    }

    /**
     * @param mixed $n1Generator
     */
    public function setN1Generator($n1Generator): void
    {
        $this->n1Generator = $n1Generator;
    }

    /**
     * @return mixed
     */
    public function getPo1Generator()
    {
        return $this->po1Generator;
    }

    /**
     * @param mixed $po1Generator
     */
    public function setPo1Generator($po1Generator): void
    {
        $this->po1Generator[] = $po1Generator;
    }

    /**
     * @return mixed
     */
    public function getSeGenerator()
    {
        return $this->seGenerator;
    }

    /**
     * @param mixed $seGenerator
     */
    public function setSeGenerator($seGenerator): void
    {
        $this->seGenerator = $seGenerator;
    }

    /**
     * @return mixed
     */
    public function getStGenerator()
    {
        return $this->stGenerator;
    }

    /**
     * @param mixed $stGenerator
     */
    public function setStGenerator($stGenerator): void
    {
        $this->stGenerator = $stGenerator;
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings): void
    {
        $this->settings = $settings;
    }

    /**
     * @return mixed
     */
    public function getProductsData()
    {
        return $this->productsData;
    }

    /**
     * @param mixed $productsData
     */
    public function setProductsData($productsData): void
    {
        $this->productsData = $productsData;
    }

    /**
     * @return mixed
     */
    public function getDtmGenerator()
    {
        return $this->dtmGenerator;
    }

    /**
     * @param mixed $dtmGenerator
     */
    public function setDtmGenerator($dtmGenerator): void
    {
        $this->dtmGenerator = $dtmGenerator;
    }


    /**
     * @return mixed
     */
    public function getExtraInformation()
    {
        return $this->extraInformation;
    }

    /**
     * @param mixed $extraInformation
     */
    public function setExtraInformation($extraInformation): void
    {
        $this->extraInformation = $extraInformation;
    }


}