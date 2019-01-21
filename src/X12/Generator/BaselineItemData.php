<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;


/**
 * Class BaselineItemData
 *
 * Example:
 *      PO1*000000001*9*EA*26.76*NT*UP*637865247716~
 *
 * @package Aonach\X12\Generator
 */
class BaselineItemData implements SegmentGeneratorInterface
{

    /**
     * Segment code;
     */
    const SEGMENT_CODE = 'PO1';
    /**
     * Number of information in the segment.
     */
    const SEGMENT_SECTIONS_NUMBER = 7;

    /**
     * Alphanumeric characters assigned for differentiation within a transaction set
     *
     * @var null $assignedIdentification
     */
    private $assignedIdentification = null;

    /**
     * Quantity ordered
     *
     * @var null $quantityOrdered
     */
    private $quantityOrdered = null;

    /**
     * Code specifying the units in which a value is being expressed,
     * or manner in which a measurement has been taken
     *      EA      Each
     *      UN      Unit
     *
     * @var null $measurementCode
     */
    private $measurementCode = null;


    /**
     * Price per unit of product, service, commodity, etc
     *
     * @var null $unitPrice
     */
    private $unitPrice = null;

    /**
     * Code identifying the type of unit price for an item
     *
     *      CA      Catalog
     *      CT      Contract
     *      DI      Distributor
     *      HP      Price per Hundred
     *      PE      Price per Each
     *      QT      Quoted
     *      TE      Contract Price per Each
     *      TP      Price per Thousand
     *
     * Prima sample file: NT
     *
     * @var null $basisUnitPriceCode
     */
    private $basisUnitPriceCode = 'NT';


    /**
     * Code identifying the type/source of the descriptive number used in Product/Service ID (234)
     *
     *      AB      Assembly
     *      BP      Buyer's Part Number
     *      DR      Drawing Revision Number
     *      EC      Engineering Change Level
     *      EN      European Article Number (EAN) (2-5-5-1)
     *      MG      Manufacturer's Part Number
     *      PC      Prime Contractor Part Number
     *      PN      Company Part Number
     *      UP      U.P.C. Consumer Package Code (1-5-5-1)
     *      VP      Vendor's (Seller's) Part Number
     *
     * @var null $productIdQualifier
     */
    private $productIdQualifier = 'UP';


    /**
     * Identifying number for a product or service
     *
     * @var null $productId
     */
    private $productId = null;

    /**
     * @var null
     */
    private $data = null;

    /**
     * BaselineItemData constructor.
     */
    public function __construct($assignedIdentification = null, $quantityOrdered = null, $measurementCode = null, $unitPrice = '0.00', $productId = null )
    {
        $this->setAssignedIdentification($assignedIdentification);
        $this->setQuantityOrdered($quantityOrdered);
        $this->setMeasurementCode($measurementCode);
        $this->setUnitPrice($unitPrice);
        $this->setProductId($productId);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->setData([
           self::SEGMENT_CODE,
            (!is_null($this->getAssignedIdentification())) ? : '',
            (!is_array($this->getQuantityOrdered())) ? : '',
            (!is_null($this->getMeasurementCode())) ? : '',
            (!is_null($this->getUnitPrice())) ? : '',
            (!is_null($this->getBasisUnitPriceCode())) ? : '',
            (!is_null($this->getProductIdQualifier())) ? : '',
            (!is_null($this->getProductId())) ? : ''
        ]);
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
    public function getAssignedIdentification()
    {
        return $this->assignedIdentification;
    }

    /**
     * @param null $assignedIdentification
     */
    public function setAssignedIdentification($assignedIdentification): void
    {
        $this->assignedIdentification = $assignedIdentification;
    }

    /**
     * @return null
     */
    public function getQuantityOrdered()
    {
        return $this->quantityOrdered;
    }

    /**
     * @param null $quantityOrdered
     */
    public function setQuantityOrdered($quantityOrdered): void
    {
        $this->quantityOrdered = $quantityOrdered;
    }

    /**
     * @return null
     */
    public function getMeasurementCode()
    {
        return $this->measurementCode;
    }

    /**
     * @param null $measurementCode
     */
    public function setMeasurementCode($measurementCode): void
    {
        $this->measurementCode = $measurementCode;
    }

    /**
     * @return null
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param null $unitPrice
     */
    public function setUnitPrice($unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return null
     */
    public function getBasisUnitPriceCode()
    {
        return $this->basisUnitPriceCode;
    }

    /**
     * @param null $basisUnitPriceCode
     */
    public function setBasisUnitPriceCode($basisUnitPriceCode): void
    {
        $this->basisUnitPriceCode = $basisUnitPriceCode;
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