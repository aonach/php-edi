<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

class TransactionSetHeader implements SegmentGeneratorInterface
{

    const SEGMENT_CODE = 'ST';
    const SEGMENT_SECTIONS_NUMBER = 2;

    /**
     * Example : ST*855*852281220
     */

    /**
     *  Code uniquely identifying a Transaction Set
     *
     *      855         Purchase Order Acknowledgment
     *
     * @var $transactionSetIdentifierCode null
     */
    private $transactionSetIdentifierCode = null;

    /**
     * Identifying control number that must be unique within the transaction set
     * functional group assigned by the originator for a transaction set
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
    public function __construct($transactionSetIdentifierCode = 855, $transactionSetControlNumber = nul)
    {
        $this->setTransactionSetIdentifierCode($transactionSetIdentifierCode);
        $this->setTransactionSetControlNumber($transactionSetControlNumber);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->setData([
           self::SEGMENT_CODE,
            (!is_null($this->getTransactionSetIdentifierCode())) ? : '',
            (!is_null($this->getTransactionSetControlNumber()))? : '',
        ]);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return (!is_null($this->.$this->getData())) ? implode('*', $this->getData()): self::SEGMENT_CODE;
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