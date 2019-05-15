<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;
use Aonach\X12\Generator\Product;


/**
 * Class AckGenerator
 * @package Aonach\X12\Generator
 */
class AckGenerator implements SegmentGeneratorInterface
{

    /**
     * Segment code;
     */
    const SEGMENT_CODE = 'ACK';

    /**
     * ACK01
     *
     * If codes IS, AN, BC, BH, IF, IH, or IW are used, the messages contained in this file will reject in Amazon's systems.
     * Please also see the Appendix EDI 855 document for further information.
     *
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
    private $lineItemStatusCode = null;

    /**
     * ACK02
     *
     * @var null
     */
    private $quantity = null;

    /**
     * ACK03
     *
     * @var null
     */
    private $basisMeasurementCode = null;

    /**
     * ACK04
     *
     *      069     Promise date
     *      011     Shipped
     *
     * @var $dateQualifier
     */
    private $dateQualifier = null;

    /**
     * ACK05
     *
     * @var null
     */
    private $date = null;

    /**
     *
     * @var null $requestReferenceNumber
     */
    private $requestReferenceNumber = null;


    /**
     * @var null
     */
    private $productIdQualifier = null;

    /**
     * @var null
     */
    private $productId = null;


    /**
     * @var null
     */
    private $industryCode = null;



    /**
     * @var
     */
    private $data;

    /**
     * LineItemAcknowledgement constructor.
     */
    public function __construct(Product $product)
    {
        $this->setProductId($product->getProductId());
        $this->setProductIdQualifier($product->getProductIdQualifier());
        $this->setQuantity($product->getQuantityOrdered());
        $this->setBasisMeasurementCode($product->getMeasurementCode());
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
                (!is_null($this->getBasisMeasurementCode())) ? $this->getBasisMeasurementCode() : ''
//                (!is_null($this->getDateQualifier())) ? $this->getDateQualifier() : '',
//                (!is_null($this->getDate())) ? $this->getDate() : ''
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
    public function getProductIdQualifier()
    {
        return $this->productIdQualifier;
    }

    /**
     * @param null $productIdQualifier
     */
    public function setProductIdQualifier($productIdQualifier): void
    {
        $this->productIdQualifier = $productIdQualifier;
    }

    /**
     * @return null
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param null $productId
     */
    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return null
     */
    public function getIndustryCode()
    {
        return $this->industryCode;
    }

    /**
     * @param null $industryCode
     */
    public function setIndustryCode($industryCode): void
    {
        $this->industryCode = $industryCode;
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