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




class Parser {



    public static function parseAllSegments(array $documents) {
        $documetParsed = array();
        foreach ($documents as $document) {
            foreach ($document->getSegments() as $segment){
                switch ($segment[0]){
                    case 'ISA':
                        $documetParsed = array_merge_recursive($documetParsed, IsaParser::parse($segment));
                        break;
                    case 'GS';
                        $documetParsed = array_merge_recursive($documetParsed, GsParser::parse($segment));
                        break;
                    case 'ST';
                        $documetParsed = array_merge_recursive($documetParsed, StParser::parse($segment));
                        break;
                    case 'BEG';
                        $documetParsed = array_merge_recursive($documetParsed, BegParser::parse($segment));
                        break;
                    case 'N1';
                        $documetParsed = array_merge_recursive($documetParsed, N1Parser::parse($segment));
                        break;
                    case 'PO1';
                        $documetParsed['po1'][] = Po1Parser::parse($segment);
                        break;
                    case 'CTT';
                        $documetParsed = array_merge_recursive($documetParsed, CttParser::parse($segment));
                        break;
                    case 'SE';
                        $documetParsed = array_merge_recursive($documetParsed, SeParser::parse($segment));
                        break;
                    case 'GE';
                        $documetParsed = array_merge_recursive($documetParsed, GeParser::parse($segment));
                        break;
                    case 'IEA';
                        $documetParsed = array_merge_recursive($documetParsed, IeaParser::parse($segment));
                        break;
                    default:
                        break;

                };
            }

        }

        return $documetParsed;
    }
}
?>
