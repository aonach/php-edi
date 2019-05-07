<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

/**
 * Class CttGenerator
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


    /**
     * @return mixed|void
     */
    public function build()
    {
        // TODO: Implement build() method.
    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return 'string';
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
