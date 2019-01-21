<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;


/**
 * Class TransactionTrailer
 * @package Aonach\X12\Generator
 */
class TransactionTrailer implements SegmentGeneratorInterface
{

    /**
     * @var null
     */
    private $numberIncludedSegments = null;

    /**
     * @var null
     */
    private $transactionSetControlNumber = null;

    /**
     * TransactionTrailer constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function build()
    {
        // TODO: Implement build() method.
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    /**
     * @return null
     */
    public function getNumberIncludedSegments()
    {
        return $this->numberIncludedSegments;
    }

    /**
     * @param null $numberIncludedSegments
     */
    public function setNumberIncludedSegments($numberIncludedSegments): void
    {
        $this->numberIncludedSegments = $numberIncludedSegments;
    }

    /**
     * @return null
     */
    public function getTransactionSetControlNumber()
    {
        return $this->transactionSetControlNumber;
    }

    /**
     * @param null $transactionSetControlNumber
     */
    public function setTransactionSetControlNumber($transactionSetControlNumber): void
    {
        $this->transactionSetControlNumber = $transactionSetControlNumber;
    }
}