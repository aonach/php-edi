<?php

namespace Aonach\X12\Parse\Segments;

use Aonach\X12\Parse\Segments\IsaParser;
use Aonach\X12\Parse\Segments\GsParser;
use Aonach\X12\Parse\Segments\StParser;
use Aonach\X12\Parse\Segments\BegParser;
use Aonach\X12\Parse\Segments\N1Parser;
use Aonach\X12\Parse\Segments\Po1Parser;
use Aonach\X12\Parse\Segments\CttParser;
use Aonach\X12\Parse\Segments\SeParser;
use Aonach\X12\Parse\Segments\GeParser;
use Aonach\X12\Parse\Segments\IeaParser;
use Aonach\X12\Parse\Segments\DtmParser;

/**
 * Class Parser
 * @package Aonach\X12\Parse\Segments
 */
class Parser
{

    /**
     * @param array $documents
     * @return array
     */
    public static function parseAllSegments(array $documents)
    {
        $documentParsed = array();
        foreach ($documents as $document) {
            foreach ($document->getSegments() as $segment) {
                switch ($segment[0]) {
                    case 'ISA':
                        $documentParsed = array_merge_recursive($documentParsed, IsaParser::parse($segment));
                        break;
                    case 'GS';
                        $documentParsed = array_merge_recursive($documentParsed, GsParser::parse($segment));
                        break;
                    case 'ST';
                        $documentParsed = array_merge_recursive($documentParsed, StParser::parse($segment));
                        break;
                    case 'BEG';
                        $documentParsed = array_merge_recursive($documentParsed, BegParser::parse($segment));
                        break;
                    case 'N1';
                        $documentParsed = array_merge_recursive($documentParsed, N1Parser::parse($segment));
                        break;
                    case 'PO1';
                        $documentParsed['po1'][] = Po1Parser::parse($segment);
                        break;
                    case 'CTT';
                        $documentParsed = array_merge_recursive($documentParsed, CttParser::parse($segment));
                        break;
                    case 'SE';
                        $documentParsed = array_merge_recursive($documentParsed, SeParser::parse($segment));
                        break;
                    case 'GE';
                        $documentParsed = array_merge_recursive($documentParsed, GeParser::parse($segment));
                        break;
                    case 'IEA';
                        $documentParsed = array_merge_recursive($documentParsed, IeaParser::parse($segment));
                        break;
                    case 'DTM';
                        $documentParsed['dtm'][] = DtmParser::parse($segment);
                    default:
                        break;

                };
            }

        }

        return $documentParsed;
    }
}
