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

use Aonach\X12\Generator\Product;
use Faker\Provider\Base;

/**
 * Class Generator
 * @package Aonach\X12
 */
class Generator
{
    /**
     * @var
     */
    private $ackGenerator = array();
    /**
     * @var
     */
    private $bakGenerator;
    /**
     * @var
     */
    private $cttGenerator;
    /**
     * @var
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
     * @var
     */
    private $isaGenerator;
    /**
     * @var
     */
    private $n1Generator;
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
        $this->initN1Generator();

        foreach ($this->productsData as $product) {
            $this->setPo1Generator(new Po1Generator($product));
            $this->initAckGenerator($product);
        }

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
        $this->getN1Generator()->build();

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
        $fileContent[] = $this->getN1Generator()->__toString();

        for ($i = 0; $i < count($this->getPo1Generator()); $i++) {
            $fileContent[] = $this->getPo1Generator()[$i]->__toString();
            $fileContent[] = $this->getAckGenerator()[$i]->__toString();
        }
        $fileContent[] = $this->getCttGenerator()->__toString();
        $fileContent[] = $this->getSeGenerator()->__toString();
        $fileContent[] = $this->getGeGenerator()->__toString();
        $fileContent[] = $this->getIeaGenerator()->__toString();

        return implode('~', $fileContent);
    }

    /**
     *
     */
    private function initIsaGenerator()
    {
        $this->setIsaGenerator(new IsaGenerator(
            $this->getSettings()['amazon/authorization_qualifier'],
            $this->getSettings()['amazon/authorization_information'],
            $this->getSettings()['amazon/security_qualifier'],
            $this->getSettings()['amazon/security_information'],
            $this->getExtraInformation()['855_data']->interchange_receiver_id, // this will be used in the 'Interchange Sender's ID
            $this->getSettings()['amazon/usage_indicator']
        ));

        $this->getIsaGenerator()->setInterchangeDate($this->getExtraInformation()['855_data']->interchange_date);
        $this->getIsaGenerator()->setInterchangeTime($this->getExtraInformation()['855_data']->interchange_time);
        $this->getIsaGenerator()->setInterchangeIdQualifier($this->getSettings()['amazon/interchange_id_qualifier']);
        $this->getIsaGenerator()->setInterchangeControlNumber($this->getExtraInformation()['855_data']->isa_interchange_control_number);
    }

    /**
     *
     */
    private function initGsGenerator()
    {
        $this->setGsGenerator(new GsGenerator(
            $this->getExtraInformation()['855_data']->application_receiver_code, // This will be used in the 'Application Sender's Code'.
            $this->getExtraInformation()['855_data']->date,
            $this->getExtraInformation()['855_data']->time,
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
                $this->getExtraInformation()['acknowledgment_type'],
                $this->getExtraInformation()['855_data']->purchase_order_number,
                $this->getExtraInformation()['855_data']->date)
        );
    }

    /**
     *
     */
    private function initN1Generator()
    {
        $this->setN1Generator(new N1Generator(
            $this->getExtraInformation()['855_data']->name,
            $this->getExtraInformation()['855_data']->identification_code
        ));
    }

    /**
     *
     */
    private function initCttGenerator()
    {
        $ctt02 = 0;

        foreach ($this->getProductsData() as $product) {
            $ctt02 += $product->getQuantityOrdered();
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

    private function initAckGenerator($product)
    {
        $ackObj = new AckGenerator($product);

        foreach ($this->getExtraInformation()['855_data']->po1 as $item) {
            if($item->buyer_product_id == $product->getProductId()){
                if($item->quantity_ordered > $product->getQuantityOrdered()){
                    $ackObj->setLineItemStatusCode('IR');
                    $ackObj->setIndustryCode('03');
                    $this->setAckGenerator($ackObj);
                    return;
                }
                $ackObj->setLineItemStatusCode('IA');
                $ackObj->setIndustryCode('00');
                $this->setAckGenerator($ackObj);
                return;
            }
        }
    }

    /**
     * @return int
     */
    public function getNumberOfSegments()
    {
        return count($this->getProductsData()) * 2 + 9;
    }

    /**
     * @return int
     */
    public function getNumberOfLineItems()
    {
        return count($this->getProductsData());
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
     * @return mixed
     */
    public function getBakGenerator()
    {
        return $this->bakGenerator;
    }

    /**
     * @param mixed $bakGenerator
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
     * @return mixed
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