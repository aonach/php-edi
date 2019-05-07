<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

/**
 * Class FunctionalGroupHeader
 * @package Aonach\X12\Generator
 */
class GsGenerator implements SegmentGeneratorInterface
{

    /**
     * Segment code;
     */
    const SEGMENT_CODE = 'GS';
    /**
     * Number of information in the segment.
     */
    const SEGMENT_SECTIONS_NUMBER = 8;

    /**
     * Code identifying a group of application related transaction sets
     *
     *      PR      Purchase Order Acknowledgement (855)
     *
     * @var $functionalIdentifierCode
     */
    private $functionalIdentifierCode = 'PR';

    /**
     * Code identifying party sending transmission; codes agreed to by trading partners
     *
     * @var $applicationSenderCode
     */
    private $applicationSenderCode = null;

    /**
     * Code identifying party receiving transmission; codes agreed to by trading partners
     *
     * @var $applicationReceiverCode
     */
    private $applicationReceiverCode = null;

    /**
     * Date expressed as CCYYMMDD
     *
     * @var $date
     */
    private $date = null;

    /**
     * Time expressed in 24-hour clock time as follows: HHMM, or HHMMSS, or HHMMSSD, or
     * HHMMSSDD, where H = hours (00-23), M = minutes (00-59), S = integer seconds (00-59) and
     * DD = decimal seconds; decimal seconds are expressed as follows: D = tenths (0-9) and DD =
     * hundredths (00-99)
     *
     * @var $time
     */
    private $time = null;

    /**
     *  Assigned number originated and maintained by the sender
     * @var $groupControlNumber
     */
    private $groupControlNumber = null;

    /**
     * Code identifying the issuer of the standard; this code is used in conjunction with Data
     * Element 480
     *
     *      X       Accredited Standards Committee X12
     *
     * @var $responsibleAgencyCode
     */
    private $responsibleAgencyCode = null;

    /**
     * Code indicating the version, release, subrelease, and industry identifier of the EDI
     * standard being used, including the GS and GE segments; if code in DE455 in GS segment is X,
     * then in DE 480 positions 1-3 are the version number; positions 4-6 are the release and
     * subrelease, level of the version; and positions 7-12 are the industry or trade
     * association identifiers (optionally assigned by user); if code in DE455 in  GS segment is T,
     * then other formats are allowed
     *
     *      004010      Draft Standards Approved for Publication by ASC X12 Procedures Review Board through October 1997
     *
     * @var $version
     */
    private $version = null;

    /**
     * Hold the actual data for the segment
     *
     * @var $data
     */
    private $data = null;

    /**
     * FunctionalGroupHeader constructor.
     */
    public function __construct($applicationSenderCode = null)
    {
        $this->applicationSenderCode = $applicationSenderCode;

    }

    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->setData([
            self::SEGMENT_CODE,
            (!is_null($this->getFunctionalIdentifierCode())) ? $this->getFunctionalIdentifierCode() : '',
            (!is_null($this->getApplicationSenderCode())) ? $this->getApplicationSenderCode() : '',
            (!is_null($this->getApplicationReceiverCode())) ? $this->getApplicationReceiverCode() : '',
            (!is_null($this->getDate())) ? $this->getDate() : '',
            (!is_null($this->getTime())) ? $this->getTime() : '',
            (!is_null($this->getGroupControlNumber())) ? $this->getGroupControlNumber() : '',
            (!is_null($this->getResponsibleAgencyCode())) ? $this->getResponsibleAgencyCode(): '',
            (!is_null($this->getVersion())) ? $this->getVersion() : '',
        ]);
    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return (!is_null($this->getData())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;
    }

    /**
     * @return mixed
     */
    public function getFunctionalIdentifierCode()
    {
        return $this->functionalIdentifierCode;
    }

    /**
     * @param mixed $functionalIdentifierCode
     */
    public function setFunctionalIdentifierCode($functionalIdentifierCode): void
    {
        $this->functionalIdentifierCode = $functionalIdentifierCode;
    }

    /**
     * @return mixed
     */
    public function getApplicationSenderCode()
    {
        return $this->applicationSenderCode;
    }

    /**
     * @param mixed $applicationSenderCode
     */
    public function setApplicationSenderCode($applicationSenderCode): void
    {
        $this->applicationSenderCode = $applicationSenderCode;
    }

    /**
     * @return mixed
     */
    public function getApplicationReceiverCode()
    {
        return $this->applicationReceiverCode;
    }

    /**
     * @param mixed $applicationReceiverCode
     */
    public function setApplicationReceiverCode($applicationReceiverCode): void
    {
        $this->applicationReceiverCode = $applicationReceiverCode;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getGroupControlNumber()
    {
        return $this->groupControlNumber;
    }

    /**
     * @param mixed $groupControlNumber
     */
    public function setGroupControlNumber($groupControlNumber): void
    {
        $this->groupControlNumber = $groupControlNumber;
    }

    /**
     * @return mixed
     */
    public function getResponsibleAgencyCode()
    {
        return $this->responsibleAgencyCode;
    }

    /**
     * @param mixed $responsibleAgencyCode
     */
    public function setResponsibleAgencyCode($responsibleAgencyCode): void
    {
        $this->responsibleAgencyCode = $responsibleAgencyCode;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }
}