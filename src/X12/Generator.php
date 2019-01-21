<?php

namespace Aonach\X12;

use Aonach\X12\Generator\BaselineItemData;
use Aonach\X12\Generator\FunctionalGroupHeader;
use Aonach\X12\Generator\InterchangeHeader;
use Aonach\X12\Generator\PurchaseOrderAcknowledgment;
use Aonach\X12\Generator\TransactionSetHeader;
use Aonach\X12\Generator\SegmentGeneratorInterface;

class Generator
{

    private $segments;

    /**
     * Generator constructor.
     */
    public function __construct($segments)
    {
    }

    /**
     * @return mixed
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * @param mixed $segments
     */
    public function setSegments($segments): void
    {
        $this->segments = $segments;
    }

}