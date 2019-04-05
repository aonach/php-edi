<?php

namespace Aonach\X12\Parse\Document;

class Document {
    private $segments = array();

    function __construct($segments) {
        $this->segments = $segments;
    }

    function __toString() {
        $str = '';
        foreach ($this->segments as $segment) {
            foreach ($segment as &$element) {
                if (is_array($element)) {
                    $element = implode('>', $element);
                }
            }
            $str .= implode('*', $segment);
            $str .= "\n";
        }
        return $str;
    }

    /**
     * @return array
     */
    public function getSegments(): array
    {
        return $this->segments;
    }

    /**
     * @param array $segments
     */
    public function setSegments(array $segments): void
    {
        $this->segments = $segments;
    }
}
