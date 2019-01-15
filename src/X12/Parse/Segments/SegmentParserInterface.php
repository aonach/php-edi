<?php

namespace Aonach\X12\Parse\Segments;

/**
 * Interface SegmentParserInterface
 * @package Aonach\X12\Parse\Segments
 */
interface SegmentParserInterface {


    /**
     * @param $segment
     * @return mixed
     */
    public static function parse($segment);
}