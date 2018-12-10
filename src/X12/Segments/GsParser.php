<?php
namespace Aonach\X12\Segments;

/**
 * Class GsParser
 * @package Aonach\X12\Segments
 */
class GsParser {

    /**
     *
     */
    const GS_00 = 'functional_group_header'; //GS represents functional group header. It marks the beginning of a functional group and is used to provide control information.
    /**
     *
     */
    const GS_01 = 'functional_code_identifier'; //The code ‘PO’ indicates purchase order - What about the other ones? OMG!
    /**
     *
     */
    const GS_02 = 'application_sender_code';
    /**
     *
     */
    const GS_03 = 'application_receiver_code';
    /**
     *
     */
    const GS_04 = 'date';
    /**
     *
     */
    const GS_05 = 'time';
    /**
     *
     */
    const GS_06 = 'gs_group_control_number';
    /**
     *
     */
    const GS_07 = 'agency_code'; // Agency Code is X which represents Accredited Standards Committee X12
    /**
     *
     */
    const GS_08 = 'version'; //Version/Release/Industry Identifier Code. The code 004010 indicates that the draft standards approved for publication by ASC X12 Procedures Review Board through October 1997.

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
                $item = [self::GS_00 => $item];
                break;
            case 1:
                $item = [self::GS_01 => $item];
                break;
            case 2:
                $item = [self::GS_02 => $item];
                break;
            case 3:
                //TODO format
                $item = [self::GS_03 => $item];
                break;
            case 4:
                //TODO format
                $item = [self::GS_04 => $item];
                break;
            case 5:
                $item = [self::GS_05 => $item];
                break;
            case 6:
                $item = [self::GS_06 => $item];
                break;
            case 7:
                $item = [self::GS_07 => $item];
                break;
            case 8:
                $item = [self::GS_08 => $item];
                break;
            default:
                break;
        }
    }
}