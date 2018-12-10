<?php

namespace Aonach\X12\Segments;

/**
 * Class StParser
 * @package Aonach\X12\Segments
 */
class StParser {

    /**
     *
     */
    const ST_00 = 'transaction_header';//ST represents transaction set header. It marks the beginning of a transactions set and is used to assign a control number.

    /**
     *
     */
    const ST_01 = 'document_type';

    /**
     *
     */
    const ST_02 = 'control_number';


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
                $item = [self::ST_00 => $item];
                break;
            case 1:
                $item = [self::ST_01 => $item];
                break;
            case 2:
                $item = [self::ST_02 => $item];
                break;
            default:
                break;
        }
    }
}