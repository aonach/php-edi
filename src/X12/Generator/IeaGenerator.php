<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

/**
 * Class IeaGenerator
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

    public function __construct($numberOfIncludedFunctionalGroups, $interchangeControlNumber)
    {
        $this->setNumberOfIncludedFunctionalGroups($numberOfIncludedFunctionalGroups);
        $this->setInterchangeControlNumber($interchangeControlNumber);
    }

    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->setData([
            self::SEGMENT_CODE,
            (!is_null($this->getNumberOfIncludedFunctionalGroups())) ? $this->getNumberOfIncludedFunctionalGroups() : '',
            (!is_null($this->getInterchangeControlNumber())) ? $this->getInterchangeControlNumber() : '',
        ]);

    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return (!is_null($this->getData())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;
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