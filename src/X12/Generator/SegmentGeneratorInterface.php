<?php

namespace Aonach\X12\Generator;

/**
 * Interface SegmentGeneratorInterface
 * @package Aonach\X12\Generator
 */
interface SegmentGeneratorInterface {

    /**
     * Build the segment data into array;
     * @return mixed
     */
    public function build();

    /**
     * Convert segment data to string to be used in the EDI file;
     *
     * @return string
     */
    public function __toString();
}