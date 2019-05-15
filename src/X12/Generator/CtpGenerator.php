<?php

namespace Aonach\X12\Generator;


use Aonach\X12\Generator\SegmentGeneratorInterface;


class CtpGenerator implements SegmentGeneratorInterface
{
    /*
     * The CTP segment is required only if a vendor sells books with a list price. Do not include the CTP segment if there is
     * no list price on the book,or if you do not have product data. If the CTP segment is included and is missing any of the
     * required data, the file will reject in the Amazonsystems.
     */
    const SEGMENT_CODE = 'CTP';

    const SEGMENT_SECTIONS_NUMBER = 7;

    /**
     * CTP02
     * @var string $priceIdentifierCode;
     */
    private $priceIdentifierCode = 'SLP';

    /**
     * CTP03
     *
     * @var null $unitPrice
     */
    private $unitPrice = null;

    /**
     * CTP04
     *
     * @var null $quantity
     */
    private $quantity = null;

    public function build()
    {
        // TODO: Implement build() method.
    }

    public function __toString()
    {
        return 'true';
    }

}