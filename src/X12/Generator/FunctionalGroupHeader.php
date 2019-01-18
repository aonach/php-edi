<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;

/**
 * Class FunctionalGroupHeader
 * @package Aonach\X12\Generator
 */
class FunctionalGroupHeader implements SegmentGeneratorInterface
{

    /**
     * Code identifying a group of application related transaction sets
     *
     *      PR      Purchase Order Acknowledgement (855)
     *
     * @var $functionalIdentifierCode string
     */
    private $functionalIdentifierCode;

    /**
     * Code identifying party sending transmission; codes agreed to by trading partners
     *
     * @var $applicationSenderCode string
     */
    private $applicationSenderCode;

    /**
     * Code identifying party receiving transmission; codes agreed to by trading partners
     *
     * @var $applicationReceiverCode string
     */
    private $applicationReceiverCode;

    /**
     * Date expressed as CCYYMMDD
     * @var $date string
     */
    private $date;

    /**
     * Time expressed in 24-hour clock time as follows: HHMM, or HHMMSS, or HHMMSSD, or
     * HHMMSSDD, where H = hours (00-23), M = minutes (00-59), S = integer seconds (00-59) and
     * DD = decimal seconds; decimal seconds are expressed as follows: D = tenths (0-9) and DD =
     * hundredths (00-99)
     *
     * @var $time string
     */
    private $time;

    /**
     *  Assigned number originated and maintained by the sender
     * @var $groupControlNumber int
     */
    private $groupControlNumber;

    /**
     * Code identifying the issuer of the standard; this code is used in conjunction with Data
     * Element 480
     *
     *      X       Accredited Standards Committee X12
     *
     * @var $responsibleAgencyCode string
     */
    private $responsibleAgencyCode;

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
     * @var $version string
     */
    private $version;

    /**
     * FunctionalGroupHeader constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed|void
     */
    public function build()
    {
        // TODO: Implement build() method.
    }

    /**
     * @return string
     */
    public function getFunctionalIdentifierCode(): string
    {
        return $this->functionalIdentifierCode;
    }

    /**
     * @param string $functionalIdentifierCode
     */
    public function setFunctionalIdentifierCode(string $functionalIdentifierCode): void
    {
        $this->functionalIdentifierCode = $functionalIdentifierCode;
    }

    /**
     * @return string
     */
    public function getApplicationSenderCode(): string
    {
        return $this->applicationSenderCode;
    }

    /**
     * @param string $applicationSenderCode
     */
    public function setApplicationSenderCode(string $applicationSenderCode): void
    {
        $this->applicationSenderCode = $applicationSenderCode;
    }

    /**
     * @return string
     */
    public function getApplicationReceiverCode(): string
    {
        return $this->applicationReceiverCode;
    }

    /**
     * @param string $applicationReceiverCode
     */
    public function setApplicationReceiverCode(string $applicationReceiverCode): void
    {
        $this->applicationReceiverCode = $applicationReceiverCode;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getGroupControlNumber(): int
    {
        return $this->groupControlNumber;
    }

    /**
     * @param int $groupControlNumber
     */
    public function setGroupControlNumber(int $groupControlNumber): void
    {
        $this->groupControlNumber = $groupControlNumber;
    }

    /**
     * @return string
     */
    public function getResponsibleAgencyCode(): string
    {
        return $this->responsibleAgencyCode;
    }

    /**
     * @param string $responsibleAgencyCode
     */
    public function setResponsibleAgencyCode(string $responsibleAgencyCode): void
    {
        $this->responsibleAgencyCode = $responsibleAgencyCode;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

}