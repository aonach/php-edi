<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

/**
 * Class LineItemAcknowledgement
 * @package Aonach\X12\Generator
 */
class LineItemAcknowledgement implements SegmentGeneratorInterface
{

    /**
     * Segment code;
     */
    const SEGMENT_CODE = 'ACK';

    /**
     * Alphanumeric characters assigned for differentiation within a transaction set
     *      AC      Item accepted and shipped
     *      AR      Item accepted and released for shipment
     *      BP      Item accepted, Partial shipment , Balanced BO
     *      DR      Item accepted – Date rescheduled
     *      IA      Item accepted
     *      IB      Item BO
     *      IC      Item accepted and Changes made
     *      ID      Item deleted
     *      IE      Item accepted, price pending
     *      IF      Item On hold, Incomplete Description
     *      IH      Item on hold
     *      IP      Item accepted, price changed
     *      IQ      Item accepted, Qty changed
     *      IR      Item rejected
     *      IS      Item accepted, Substitution made
     *      IW      Item on hold, Waiver required
     *      SP      Item accepted – Schedule date pending
     *
     * @var null $lineItemStatusCode
     */
    private $lineItemStatusCode = 'IA';

    /**
     * @var null
     */
    private $quantity = null;

    /**
     * @var null
     */
    private $basisMeasurementCode = null;

    /**
     *      069     Promise date
     *      011     Shipped
     * @var $dateQualifier
     */
    private $dateQualifier = null;

    /**
     * Date expressed as CCYYMMDD
     *
     * @var null $lineItemPromiseDate
     */
    private $lineItemPromiseDate = null;

    /**
     *
     * @var null $requestReferenceNumber
     */
    private $requestReferenceNumber = null;

    private $data;

    /**
     * LineItemAcknowledgement constructor.
     */
    public function __construct($quantity = 0, $basisMeasurementCode = 'EA')
    {
        $this->setQuantity($quantity);
        $this->setBasisMeasurementCode($basisMeasurementCode);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->setData([
                self::SEGMENT_CODE,
                (!is_null($this->getLineItemStatusCode())) ? $this->getLineItemStatusCode() : '',
                (!is_null($this->getQuantity())) ? $this->getQuantity() : '',
                (!is_null($this->getBasisMeasurementCode())) ? $this->getBasisMeasurementCode() : '',
                (!is_null($this->getDateQualifier())) ? $this->getDateQualifier() : '',
                (!is_null($this->getLineItemPromiseDate())) ? $this->getLineItemPromiseDate() : '',
                (!is_null($this->getRequestReferenceNumber())) ? $this->getRequestReferenceNumber() : ''
            ]

        );

    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return (!is_null($this->getData())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;
    }

    /**
     * @return null
     */
    public function getLineItemStatusCode()
    {
        return $this->lineItemStatusCode;
    }

    /**
     * @param null $lineItemStatusCode
     */
    public function setLineItemStatusCode($lineItemStatusCode): void
    {
        $this->lineItemStatusCode = $lineItemStatusCode;
    }

    /**
     * @return null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param null $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return null
     */
    public function getBasisMeasurementCode()
    {
        return $this->basisMeasurementCode;
    }

    /**
     * @param null $basisMeasurementCode
     */
    public function setBasisMeasurementCode($basisMeasurementCode): void
    {
        $this->basisMeasurementCode = $basisMeasurementCode;
    }

    /**
     * @return mixed
     */
    public function getDateQualifier()
    {
        return $this->dateQualifier;
    }

    /**
     * @param mixed $dateQualifier
     */
    public function setDateQualifier($dateQualifier): void
    {
        $this->dateQualifier = $dateQualifier;
    }

    /**
     * @return null
     */
    public function getLineItemPromiseDate()
    {
        return $this->lineItemPromiseDate;
    }

    /**
     * @param null $lineItemPromiseDate
     */
    public function setLineItemPromiseDate($lineItemPromiseDate): void
    {
        $this->lineItemPromiseDate = $lineItemPromiseDate;
    }

    /**
     * @return null
     */
    public function getRequestReferenceNumber()
    {
        return $this->requestReferenceNumber;
    }

    /**
     * @param null $requestReferenceNumber
     */
    public function setRequestReferenceNumber($requestReferenceNumber): void
    {
        $this->requestReferenceNumber = $requestReferenceNumber;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }
}