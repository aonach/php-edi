<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

/**
 * Class TransactionSetHeader
 * @package Aonach\X12\Generator
 */
class StGenerator implements SegmentGeneratorInterface
{

    /**
     *
     */
    const SEGMENT_CODE = 'ST';
    /**
     *
     */
    const SEGMENT_SECTIONS_NUMBER = 2;

    /**
     *  Code uniquely identifying a Transaction Set
     *
     *      855         Purchase Order Acknowledgment
     *
     * @var $transactionSetIdentifierCode null
     */
    private $transactionSetIdentifierCode = '855';

    /**
     * Identifying control number that must be unique within the transaction set
     * functional group assigned by the originator for a transaction set
     *
     * The control number is assigned by the sender. It should be
     * sequentially assigned within each functional group to aid in error
     * recovery and research. The control number in the SE segment (SE02) must be
     * identical to the control number in the ST segment for each transaction.
     *
     * @var $transactionSetControlNumber null
     */
    private $transactionSetControlNumber = null;

    /**
     *
     * @var $data null
     */
    private $data = null;

    /**
     * TransactionSetHeader constructor.
     */
    public function __construct($transactionSetControlNumber)
    {
        $this->setTransactionSetControlNumber($transactionSetControlNumber);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->setData([
            self::SEGMENT_CODE,
            (!is_null($this->getTransactionSetIdentifierCode())) ? $this->getTransactionSetIdentifierCode() : '',
            (!is_null($this->getTransactionSetControlNumber()))? $this->getTransactionSetControlNumber() : '',
        ]);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return (!is_null($this->getData())) ? implode('*', $this->getData()): self::SEGMENT_CODE;
    }

    /**
     * @return null
     */
    public function getTransactionSetIdentifierCode()
    {
        return $this->transactionSetIdentifierCode;
    }

    /**
     * @param null $transactionSetIdentifierCode
     */
    public function setTransactionSetIdentifierCode($transactionSetIdentifierCode): void
    {
        $this->transactionSetIdentifierCode = $transactionSetIdentifierCode;
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