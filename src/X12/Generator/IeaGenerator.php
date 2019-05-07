<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

/**
 * Class CttGenerator
 * @package Aonach\X12\Generator
 */
class IeaGenerator implements SegmentGeneratorInterface
{
    /**
     *
     */
    const SEGMENT_CODE = 'IEA';

    /**
     * @var
     */
    private $numberOfIncludedFunctionalGroups;

    /**
     * @var
     */
    private $interchangeControlNumber;

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
    public function getNumberOfIncludedFunctionalGroups()
    {
        return $this->numberOfIncludedFunctionalGroups;
    }

    /**
     * @param mixed $numberOfIncludedFunctionalGroups
     */
    public function setNumberOfIncludedFunctionalGroups($numberOfIncludedFunctionalGroups): void
    {
        $this->numberOfIncludedFunctionalGroups = $numberOfIncludedFunctionalGroups;
    }

    /**
     * @return mixed
     */
    public function getInterchangeControlNumber()
    {
        return $this->interchangeControlNumber;
    }

    /**
     * @param mixed $interchangeControlNumber
     */
    public function setInterchangeControlNumber($interchangeControlNumber): void
    {
        $this->interchangeControlNumber = $interchangeControlNumber;
    }
}