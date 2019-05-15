<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

/**
 * Class DtmGenerator
 * @package Aonach\X12\Generator
 */
class DtmGenerator implements SegmentGeneratorInterface
{
    /**
     * If you can provide Estimated delivery dates per line item, you have to state these in DTM02 with DTM01 qualifier 067.
     *
     */
    const SEGMENT_CODE = 'DTM';

    /*
     * DTM01
     *
     */
    /**
     * @var string
     */
    private $dateQualifier = '067';

    /*
     * DTM02
     */
    /**
     * @var null
     */
    private $date = null;

    /**
     * @var null
     */
    private $data = null;


    /**
     * DtmGenerator constructor.
     * @param $date
     */
    public function __construct($date)
    {
        $this->setDate($date);

    }

    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->setData([
                self::SEGMENT_CODE,
                (!is_null($this->getDateQualifier())) ? $this->getDateQualifier() : '',
                (!is_null($this->getDate())) ? $this->getDate() : ''
            ]
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (!is_null($this->getData())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;
    }

    /**
     * @return string
     */
    public function getDateQualifier(): string
    {
        return $this->dateQualifier;
    }

    /**
     * @param string $dateQualifier
     */
    public function setDateQualifier(string $dateQualifier): void
    {
        $this->dateQualifier = $dateQualifier;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param null $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
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