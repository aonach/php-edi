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
     *
     */
    const SEGMENT_CODE = 'SE';

    /**
     * Total number of segments included in a transaction set including ST and SE segments
     *
     * @var null $numberIncludedSegments
     */
    private $numberIncludedSegments = null;

    /**
     * Identifying control number that must be unique within the transaction set functional group assigned by the originator for a
     * transaction set The control number is assigned by the sender. It should be sequentially assigned within each functional
     * group to aid in error recovery and research. The control number in the SE segment (SE02) must be identical to the control number
     * in the ST segment for each transaction.
     *
     * @var null $transactionSetControlNumber
     */
    private $transactionSetControlNumber = null;

    /**
     * @var null
     */
    private $data = null;

    /**
     * TransactionTrailer constructor.
     */
    public function __construct($numberIncludedSegments = null, $transactionSetControlNumber = null)
    {
        $this->setNumberIncludedSegments($numberIncludedSegments);
        $this->setTransactionSetControlNumber($transactionSetControlNumber);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->setData([
            (!is_null($this->getNumberIncludedSegments())) ? $this->getNumberIncludedSegments() : '',
            (!is_null($this->getTransactionSetControlNumber())) ? $this->getTransactionSetControlNumber() : ''
        ]);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return (!is_null($this->getDAta())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;
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