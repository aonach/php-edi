<?php
namespace Aonach\X12\Parse\Segments;

/**
 * Class IeaParser
 * @package Aonach\X12\Parse\Segments
 */
class IeaParser {
    /**
     *
     */
    const IEA_00 = 'end_interchange'; //To define the end of an interchange of zero or more functional groups and interchange-related control segments
    /**
     *
     */
    const IEA_01 = 'number_of_functional_groups'; //Number of Included Functional Groups - A count of the number of functional groups included in an interchange

    /**
     *
     */
    const IEA_02 = 'iea_interchange_control_number'; // Interchange Control Number - A control number assigned by the interchange sender

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
                $item = [self::IEA_00 => $item];
                break;
            case 1:
                $item = [self::IEA_01 => $item];
                break;
            case 2:
                $item = [self::IEA_02 => $item];
                break;
            default:
                break;
        }
    }
}
