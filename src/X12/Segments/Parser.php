<?php

namespace Aonach\X12\Segments;

use Aonach\X12\Segments\IsaParser;
use Aonach\X12\Segments\GsParser;
use Aonach\X12\Segments\StParser;
use Aonach\X12\Segments\BegParser;
use Aonach\X12\Segments\N1Parser;
use Aonach\X12\Segments\Po1Parser;
use Aonach\X12\Segments\CttParser;
use Aonach\X12\Segments\SeParser;
use Aonach\X12\Segments\GeParser;
use Aonach\X12\Segments\IeaParser;




class Parser {



    public static function parseAllSegments(array $documents) {
        $documetParsed = array();
        foreach ($documents as $document) {
            foreach ($document->getSegments() as $segment){
                switch ($segment[0]){
                    case 'ISA':
                        $documetParsed['isa'] = IsaParser::parse($segment);
                        break;
                    case 'GS';
                        $documetParsed['gs'] = GsParser::parse($segment);
                        break;
                    case 'ST';
                        $documetParsed['st'] = StParser::parse($segment);
                        break;
                    case 'BEG';
                        $documetParsed['beg'] = BegParser::parse($segment);
                        break;
                    case 'N1';
                        $documetParsed['n1'] = N1Parser::parse($segment);
                        break;
                    case 'PO1';
                        $documetParsed['pO1'] = Po1Parser::parse($segment);
                        break;
                    case 'CTT';
                        $documetParsed['ctt'] = CttParser::parse($segment);
                        break;
                    case 'SE';
                        $documetParsed['se'] = SeParser::parse($segment);
                        break;
                    case 'GE';
                        $documetParsed['ge'] = GeParser::parse($segment);
                        break;
                    case 'IEA';
                        $documetParsed['iea'] = IeaParser::parse($segment);
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
