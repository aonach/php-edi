<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

class DtmGenerator implements SegmentGeneratorInterface
{
    /**
     * If you can provide Estimated delivery dates per line item, you have to state these in DTM02 with DTM01 qualifier 067.
     *
     * WE CAN'T
     */
    const SEGMENT_CODE = 'DTM';

    /*
     * DTM01
     *
     */
    private $dateQualifier = null;

    /*
     * DTM02
     */
    private $date = null;

    public function build()
    {
        // TODO: Implement build() method.
    }

    public function __toString()
    {
        return 'tostring';
    }

}