<?php

namespace Aonach\X12\Segments;

/**
 * Class StParser
 * @package Aonach\X12\Segments
 */
class BegParser {

    /**
     *
     */
    const BEG_00 = 'beginning_segment_po';//ST represents the beginning segment of the purchase order.

    /**
     *
     */
    const BEG_01 = 'transaction_purpose_code'; //Transaction Set Purpose Code - 00 represents a new purchase order.

    /**
     *
     */
    const BEG_02 = 'purchase_order_type'; //Purchase Order Type Code - DS Dropship / SA Stand-alone Order

    /**
     *
     */
    const BEG_03 = 'purchase_order_number'; //Identifying number for Purchase Order assigned by the orderer/purchaser

    /**
     *
     */
    const BEG_04 = 'release_number'; //Number identifying a release against a Purchase Order previously placed by the parties involved in the transaction

    /**
     *
     */
    const BEG_05 = 'date_of_issuance';



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
                $item = [self::BEG_00 => $item];
                break;
            case 1:
                $item = [self::BEG_01 => $item];
                break;
            case 2:
                $item = [self::BEG_02 => $item];
                break;
            case 3:
                $item = [self::BEG_03 => $item];
                break;
            case 4:
                $item = [self::BEG_04 => $item];
                break;
            case 5:
                $item = [self::BEG_05 => $item];
                break;
            default:
                break;
        }
    }
}