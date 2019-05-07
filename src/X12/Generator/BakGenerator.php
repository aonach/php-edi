<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;


/**
 * Class PurchaseOrderAcknowledgment
 *
 * 1. BAK04 is the date assigned by the purchaser to purchase order.
 * 2. BAK08 is the seller's order number.
 * 3. BAK09 is the date assigned by the sender to the acknowledgment.
 *
 * Example:
 * BAK*00*AD*0132710645*20090612
 *
 * @package Aonach\X12\Generator
 */
class BakGenerator implements SegmentGeneratorInterface
{

    /**
     * Segment code;
     */
    const SEGMENT_CODE = 'BAK';
    /**
     * Number of information in the segment;
     */
    const SEGMENT_SECTIONS_NUMBER = 6;

    /**
     * Code identifying purpose of transaction set
     *      00      Original
     *
     * @var null $transactionSetPurposeCode
     */
    private $transactionSetPurposeCode = '00';

    /**
     * Code specifying the type of acknowledgment
     *      AC      Acknowledge - With Detail and Change
     *      AD      Acknowledge - With Detail, No Change
     *      AE      Acknowledge - With Exception Detail Only
     *      AK      Acknowledge - No Detail or Change
     *      RD      Reject with Detail
     *      RF      Reject with Exception Detail Only
     *      RJ      Rejected - No Detail
     *
     * @var null $acknowledgmentType
     */
    private $acknowledgmentType = null;

    /**
     * Identifying number for Purchase Order assigned by the orderer/purchaser
     *
     * Buyer's original purchase order number used to identify an order.
     * Received in Purchase Order Number on the BEG segment of the 850 transaction.
     *
     * @var null $purchaseOrderNumber
     */
    private $purchaseOrderNumber = null;


    /**
     * Date expressed as CCYYMMDD
     *
     * Buyer's purchase order date as received on the BEG segment in the 850 transaction.
     *
     * @var null $date
     */
    private $date = null;

    /**
     * Number identifying a release against a Purchase Order previously placed
     * by the parties involved in the transaction
     *
     * @var null $releaseNumber
     */
    private $releaseNumber;

    /**
     * Contract number
     *
     * @var null $contractNumber
     */
    private $contractNumber = null;

    /**
     * @var null
     */
    private $data = null;

    /**
     * PurchaseOrderAcknowledgment constructor.
     */
    public function __construct($acknowledgmentType = null, $purchaseOrderNumber = null, $date = null)
    {
        $this->setAcknowledgmentType($acknowledgmentType);
        $this->setPurchaseOrderNumber($purchaseOrderNumber);
        $this->setDate($date);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->setData([
            self::SEGMENT_CODE,
            (!is_null($this->getTransactionSetPurposeCode())) ? $this->getTransactionSetPurposeCode() : '',
            (!is_null($this->getAcknowledgmentType())) ? $this->getAcknowledgmentType() : '',
            (!is_null($this->getPurchaseOrderNumber())) ? $this->getPurchaseOrderNumber() : '',
            (!is_null($this->getDate())) ? $this->getDate() : '',
            (!is_null($this->getReleaseNumber())) ? $this->getReleaseNumber() : '',
            (!is_null($this->getContractNumber())) ? $this->getContractNumber() : ''
        ]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (!is_null($this->getData())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;
    }

    /**
     * @return null
     */
    public function getTransactionSetPurposeCode()
    {
        return $this->transactionSetPurposeCode;
    }

    /**
     * @param null $transactionSetPurposeCode
     */
    public function setTransactionSetPurposeCode($transactionSetPurposeCode): void
    {
        $this->transactionSetPurposeCode = $transactionSetPurposeCode;
    }

    /**
     * @return null
     */
    public function getAcknowledgmentType()
    {
        return $this->acknowledgmentType;
    }

    /**
     * @param null $acknowledgmentType
     */
    public function setAcknowledgmentType($acknowledgmentType): void
    {
        $this->acknowledgmentType = $acknowledgmentType;
    }

    /**
     * @return null
     */
    public function getPurchaseOrderNumber()
    {
        return $this->purchaseOrderNumber;
    }

    /**
     * @param null $purchaseOrderNumber
     */
    public function setPurchaseOrderNumber($purchaseOrderNumber): void
    {
        $this->purchaseOrderNumber = $purchaseOrderNumber;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param null $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return null
     */
    public function getReleaseNumber()
    {
        return $this->releaseNumber;
    }

    /**
     * @param null $releaseNumber
     */
    public function setReleaseNumber($releaseNumber): void
    {
        $this->releaseNumber = $releaseNumber;
    }

    /**
     * @return null
     */
    public function getContractNumber()
    {
        return $this->contractNumber;
    }

    /**
     * @param null $contractNumber
     */
    public function setContractNumber($contractNumber): void
    {
        $this->contractNumber = $contractNumber;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }
}