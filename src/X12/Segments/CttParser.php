<?php

namespace Aonach\X12\Segments;

/**
 * Class CTTParser
 * @package Aonach\X12\Segments
 */
class CttParser {


    /**
     *
     */
    const CTT_00 = 'baseline_item_data'; // To specify basic and most frequently used line item data

    /**
     *
     */
    const CTT_01 = 'number_of_items'; //Number of Line Items - Total number of line items in the transaction set

    /**
     *
     */
    const CTT_02 = 'number_of_units'; //Number of units - Total number of units ordered is also 1.



    /**
     * @param $segment
     * @return array
     */
    public static function parse($segment){
        $content = array();
        array_walk_recursive($segment,'self::setContentType');
        foreach ($segment as $key => $item){
            $content[key($item)] = $item[key($item)];
        }

        return $content;
    }

    /**
     * Set the the key to a meaningfull value.
     * @param $item
     * @param $key
     */
    private static function setContentType(&$item, $key){
        switch ($key){
            case 0:
                $item = [self::CTT_00 => $item];
                break;
            case 1:
                $item = [self::CTT_01 => $item];
                break;
            case 2:
                $item = [self::CTT_02 => $item];
                break;
            default:
                break;
        }
    }
}