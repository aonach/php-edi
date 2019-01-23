<?php

namespace Aonach\X12;

use Aonach\X12\Generator\BaselineItemData;
use Aonach\X12\Generator\FunctionalGroupHeader;
use Aonach\X12\Generator\InterchangeHeader;
use Aonach\X12\Generator\PurchaseOrderAcknowledgment;
use Aonach\X12\Generator\LineItemAcknowledgement;
use Aonach\X12\Generator\TransactionSetHeader;
use Aonach\X12\Generator\SegmentGeneratorInterface;
use Aonach\X12\Generator\TransactionTrailer;

/**
 * Class Generator
 * @package Aonach\X12
 */
class Generator
{

    /**
     * @var $isaSegment
     */
    private $isaSegment;
    /**
     * @var $gsSegment
     */
    private $gsSegment;
    /**
     * @var $stSegment
     */
    private $stSegment;
    /**
     * @var $bakSegment
     */
    private $bakSegment;
    /**
     * @var $po1Segment
     */
    private $po1Segment;

    private $ackSegment;
    /**
     * @var $seSegment
     */
    private $seSegment;

    /**
     * @var $isaData
     */
    private $isaData;
    /**
     * @var $itemData
     */
    private $itemData;

    /**
     * Generator constructor.
     */
    public function __construct($isaData, $itemData)
    {
        $this->setIsaData($isaData);
        $this->setItemData($itemData);

    }


    public function generate()
    {
        $this->isaSegment = new InterchangeHeader(
            $this->isaData['amazon/authozization_qualifier'],
            $this->isaData['amazon/authorization_information'],
            $this->isaData['amazon/security_qualifier'],
            $this->isaData['amazon/security_information']
        );

        $this->gsSegment = new FunctionalGroupHeader();
        $this->stSegment = new TransactionSetHeader();
        $this->bakSegment =  new PurchaseOrderAcknowledgment();

        foreach ($this->itemData as $item){
            $this->po1Segment[] = new BaselineItemData();
            $this->ackSegment[] = new LineItemAcknowledgement();
        }
        
        $this->stSegment = new TransactionTrailer($this->getNumberOfSegments());

        return $this->__generate();

    }

    private function __generate(){
        $this->getIsaSegment()->build();
        $this->getGsSegment()->build();
        $this->getStSegment()->build();
        $this->getBakSegment()->build();
        foreach ($this->getPo1Segment() as $po1){
            $po1->build();
        }

        foreach ($this->getAckSegment() as $ack) {
            $ack->build();
        }

        $this->getStSegment()->build();
        
        $fileContent = array();

        $fileContent[] = $this->getIsaSegment()->__toString();
        $fileContent[] = $this->getGsSegment()->__toString();
        $fileContent[] = $this->getStSegment()->__toString();
        $fileContent[] = $this->getBakSegment()->__toString();
        foreach ($this->getPo1Segment() as $po1) {
            $fileContent[] = $po1->__toString();
        }

        foreach ($this->getAckSegment() as $ack){
            $fileContent[] = $ack->__toString();
        }
        $fileContent[] = $this->getStSegment()->__toString();

        return implode('~', $fileContent);


    }
    public function getNumberOfSegments(){
        return count($this->getItemData()) + 2;
    }

    /**
     * @return mixed
     */
    public function getIsaSegment()
    {
        return $this->isaSegment;
    }

    /**
     * @param mixed $isaSegment
     */
    public function setIsaSegment($isaSegment): void
    {
        $this->isaSegment = $isaSegment;
    }

    /**
     * @return mixed
     */
    public function getGsSegment()
    {
        return $this->gsSegment;
    }

    /**
     * @param mixed $gsSegment
     */
    public function setGsSegment($gsSegment): void
    {
        $this->gsSegment = $gsSegment;
    }

    /**
     * @return mixed
     */
    public function getStSegment()
    {
        return $this->stSegment;
    }

    /**
     * @param mixed $stSegment
     */
    public function setStSegment($stSegment): void
    {
        $this->stSegment = $stSegment;
    }

    /**
     * @return mixed
     */
    public function getBakSegment()
    {
        return $this->bakSegment;
    }

    /**
     * @param mixed $bakSegment
     */
    public function setBakSegment($bakSegment): void
    {
        $this->bakSegment = $bakSegment;
    }

    /**
     * @return mixed
     */
    public function getPo1Segment()
    {
        return $this->po1Segment;
    }

    /**
     * @param mixed $po1Segment
     */
    public function setPo1Segment($po1Segment): void
    {
        $this->po1Segment = $po1Segment;
    }

    /**
     * @return mixed
     */
    public function getSeSegment()
    {
        return $this->seSegment;
    }

    /**
     * @param mixed $seSegment
     */
    public function setSeSegment($seSegment): void
    {
        $this->seSegment = $seSegment;
    }

    /**
     * @return mixed
     */
    public function getIsaData()
    {
        return $this->isaData;
    }

    /**
     * @param mixed $isaData
     */
    public function setIsaData($isaData): void
    {
        $this->isaData = $isaData;
    }

    /**
     * @return mixed
     */
    public function getItemData()
    {
        return $this->itemData;
    }

    /**
     * @param mixed $itemData
     */
    public function setItemData($itemData): void
    {
        $this->itemData = $itemData;
    }

    /**
     * @return mixed
     */
    public function getAckSegment()
    {
        return $this->ackSegment;
    }

    /**
     * @param mixed $ackSegment
     */
    public function setAckSegment($ackSegment): void
    {
        $this->ackSegment = $ackSegment;
    }

}