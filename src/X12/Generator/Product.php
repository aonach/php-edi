<?php

namespace Aonach\X12\Generator;

class Product
{

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
     * Default value for Amazon integration = EA
     *
     * @var null $measurementCode
     */
    private $measurementCode = 'EA';

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
    private $basisUnitPriceCode = null;

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
    private $productIdQualifier = 'SK';


    /**
     * Identifying number for a product or service
     *
     * @var null $productId
     */
    private $productId = null;

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
}