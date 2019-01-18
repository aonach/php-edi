<?php

namespace Aonach\X12\Generator;

/**
 * Interface SegmentGeneratorInterface
 * @package Aonach\X12\Generator
 */
interface SegmentGeneratorInterface {

    /**
     * @return mixed
     */
    public function build();
}