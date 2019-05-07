<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;


/**
 * Class GeGenerator
 * @package Aonach\X12\Generator
 */
class GeGenerator implements SegmentGeneratorInterface
{

    /**
     *
     */
    const SEGMENT_CODE = 'GE';

    /**
     * @var
     */
    private $numberOfTransactionSetsIncluded;

    /**
     * @var
     */
    private $groupControlNumber;


    public function __construct($numberOfTransactionSetsIncluded, $groupControlNumber)
    {
        $this->setNumberOfTransactionSetsIncluded($numberOfTransactionSetsIncluded);
        $this->setGroupControlNumber($groupControlNumber);
    }

    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->setData([
            self::SEGMENT_CODE,
            (!is_null($this->getNumberOfTransactionSetsIncluded())) ? $this->getNumberOfTransactionSetsIncluded() : '',
            (!is_null($this->getGroupControlNumber())) ? $this->getGroupControlNumber() : ''
        ]);
    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return (!is_null($this->getDAta())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;
    }

    /**
     * @return mixed
     */
    public function getNumberOfTransactionSetsIncluded()
    {
        return $this->numberOfTransactionSetsIncluded;
    }

    /**
     * @param mixed $numberOfTransactionSetsIncluded
     */
    public function setNumberOfTransactionSetsIncluded($numberOfTransactionSetsIncluded): void
    {
        $this->numberOfTransactionSetsIncluded = $numberOfTransactionSetsIncluded;
    }

    /**
     * @return mixed
     */
    public function getGroupControlNumber()
    {
        return $this->groupControlNumber;
    }

    /**
     * @param mixed $groupControlNumber
     */
    public function setGroupControlNumber($groupControlNumber): void
    {
        $this->groupControlNumber = $groupControlNumber;
    }
}
