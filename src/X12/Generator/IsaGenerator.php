<?php

namespace Aonach\X12\Generator;

/**
 * Class IsaGenerator
 *
 * Example : ST*855*852281220
 *
 *
 * @package Aonach\X12\Generator
 */
class IsaGenerator implements SegmentGeneratorInterface
{

    /**
     * Segment code;
     */
    const SEGMENT_CODE = 'ISA';
    /**
     * Number of information in the segment.
     */
    const SEGMENT_SECTIONS_NUMBER = 16;

    /**
     *  ISA01
     *
     *  Code to identify the type of information in the Authorization Information
     *       00        No Authorization Information Present (No Meaningful Information in I02)
     *       01        UCS Communications ID
     *
     * @var $authorizationInformationQualifier null
     */
    private $authorizationInformationQualifier = null;

    /**
     * ISA02
     *
     * Information used for additional identification or authorization of the interchange sender
     * or the data in the interchange; the type of information is set by the Authorization Information Qualifier (I01)
     *
     * @var $authorizationInformation null
     */
    private $authorizationInformation = null;

    /**
     * ISA03
     *
     * Code to identify the type of information in the Security Information
     *
     * @var $securityInformationQualifier null
     */
    private $securityInformationQualifier = null;

    /**
     * ISA04
     *
     * This is used for identifying the security information about the interchange sender or the data
     * in the interchange; the type of information is set by the Security Information Qualifier (I03)
     *
     * @var $securityInformation null
     */
    private $securityInformation = null;

    /**
     * ISA05
     *
     * Qualifier to designate the system/method of code structure used
     * to designate the sender or receiver ID element being qualified
     *
     * @var $interchangeIdQualifier01 null
     */
    private $interchangeIdQualifier01 = null;

    /**
     * ISA06
     *
     * Identification code published by the sender for other parties to use as the receiver ID to route data to them;\
     * the sender always codes this value in the sender ID element
     *
     * @var $interchangeSenderId null
     */
    private $interchangeSenderId = null;

    /**
     * ISA07
     *
     * Qualifier to designate the system/method of code structure used
     * to designate the sender or receiver ID element being qualified
     *
     * @var $interchangeIdQualifier02 null
     */
    private $interchangeIdQualifier02 = null;

    /**
     * ISA08
     *
     * Identification code published by the receiver of the data;
     * When sending, it is used by the sender as their sending ID,
     * thus other parties sending to them will use this as a receiving
     * ID to route data to them
     *
     * This will be Amazon's EDI ID. AMAZON for Amazon US, AMAZONCA for Amazon Canada, AMAZONMX for Amazon Mexico and AMAZONBR for Amazon Brazil
     *
     * @var $interchangeReceiverId string
     */
    private $interchangeReceiverId = 'AMAZON         ';

    /**
     * ISA09
     *
     * Date of the interchange
     *
     * @var $interchangeDate null
     */
    private $interchangeDate = null;


    /**
     * ISA10
     *
     * Time of the interchange
     *
     * @var $interchangeTime null
     */
    private $interchangeTime = null;

    /**
     * ISA11
     *
     * Repetition Separator
     *
     * @var $repetitionSeparator string
     */
    private $repetitionSeparator = 'U';

    /**
     * ISA12
     *
     * Code specifying the version number of the interchange control segments
     *
     * @var $interchangeControlVersionNumber string
     */
    private $interchangeControlVersionNumber = '00400';

    /**
     * ISA13
     *
     * A control number assigned by the interchange sender
     *
     * @var $interchangeControlNumber null
     */
    private $interchangeControlNumber = null;

    /**
     * ISA14
     *
     * Code sent by the sender to request an interchange acknowledgment (TA1)
     *
     *      0 No Acknowledgment Requested
     *      1 Interchange Acknowledgment Requested
     *
     * @var $acknowledgmentRequested string
     */
    private $acknowledgmentRequested = '0';

    /**
     * ISA15
     *
     * Code to indicate whether data enclosed by this interchange envelope is test, production or information
     *
     *      P       Production Data
     *      T       Test Data
     *
     * @var $usageIndicator null
     */
    private $usageIndicator = null;

    /**
     * ISA16
     *
     * Type is not applicable; the component element separator is a delimiter and not a data element; this field provides the delimiter used to
     * separate component data elements within a composite data structure; this value must be different than the data element separator and the
     * segment terminator
     *
     * @var string $componentElementSeparator
     */
    private $componentElementSeparator = '>';


    /**
     * Hold the actual data for the segment
     *
     * @var $data null
     */
    private $data = null;


    /**
     * InterchangeHeader constructor.
     */
    public function __construct($authorizationInformationQualifier = null,
                                $authorizationInformation = null,
                                $securityInformationQualifier = null,
                                $securityInformation = null,
                                $interchangeSenderId = null,
                                $usageIndicator = null)
    {
        $this->setAuthorizationInformationQualifier($authorizationInformationQualifier);
        $this->setAuthorizationInformation($authorizationInformation);
        $this->setSecurityInformationQualifier($securityInformationQualifier);
        $this->setSecurityInformation($securityInformation);
        $this->setInterchangeSenderId($interchangeSenderId);
        $this->setUsageIndicator($usageIndicator);
        $this->setInterchangeDate(date('ymd'));
        $this->setInterchangeTime(date('hi'));
    }


    /**
     * Build segment data
     *
     * @return mixed|null
     */
    public function build()
    {
        $this->setData([
            self::SEGMENT_CODE,
            (!is_null($this->getAuthorizationInformationQualifier())) ? $this->getAuthorizationInformationQualifier() : '',
            (!is_null($this->getAuthorizationInformation())) ? $this->getAuthorizationInformation() : '',
            (!is_null($this->getSecurityInformationQualifier())) ? $this->getSecurityInformationQualifier() : '',
            (!is_null($this->getSecurityInformation())) ? $this->getSecurityInformation() : '',
            (!is_null($this->getInterchangeIdQualifier01())) ? $this->getInterchangeIdQualifier01() : '',
            (!is_null($this->getInterchangeSenderId())) ? $this->getInterchangeSenderId() : '',
            (!is_null($this->getInterchangeIdQualifier02())) ? $this->getInterchangeIdQualifier02() : '',
            (!is_null($this->getInterchangeReceiverId())) ? $this->getInterchangeReceiverId() : '',
            (!is_null($this->getInterchangeDate())) ? $this->getInterchangeDate() : '',
            (!is_null($this->getInterchangeTime())) ? $this->getInterchangeTime() : '',
            (!is_null($this->getRepetitionSeparator())) ? $this->getRepetitionSeparator() : '',
            (!is_null($this->getInterchangeControlVersionNumber())) ? $this->getInterchangeControlVersionNumber() : '',
            (!is_null($this->getInterchangeControlNumber())) ? $this->getInterchangeControlNumber() : '',
            (!is_null($this->getAcknowledgmentRequested())) ? $this->getAcknowledgmentRequested() : '',
            (!is_null($this->getUsageIndicator())) ? $this->getUsageIndicator() : '',
            (!is_null($this->getComponentElementSeparator())) ? $this->getComponentElementSeparator() : ''
        ]);

        return $this->getData();
    }

    /**
     * Convert to string segment content to be used in the 855 file
     *
     * @return string
     */
    public function __toString()
    {
        return (!is_null($this->getData())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;
    }

    /**
     * @return null
     */
    public function getAuthorizationInformationQualifier()
    {
        return $this->authorizationInformationQualifier;
    }

    /**
     * @param null $authorizationInformationQualifier
     */
    public function setAuthorizationInformationQualifier($authorizationInformationQualifier): void
    {
        $this->authorizationInformationQualifier = $authorizationInformationQualifier;
    }

    /**
     * @return null
     */
    public function getAuthorizationInformation()
    {
        return $this->authorizationInformation;
    }

    /**
     * @param null $authorizationInformation
     */
    public function setAuthorizationInformation($authorizationInformation): void
    {
        $this->authorizationInformation = $authorizationInformation;
    }

    /**
     * @return null
     */
    public function getSecurityInformationQualifier()
    {
        return $this->securityInformationQualifier;
    }

    /**
     * @param null $securityInformationQualifier
     */
    public function setSecurityInformationQualifier($securityInformationQualifier): void
    {
        $this->securityInformationQualifier = $securityInformationQualifier;
    }

    /**
     * @return null
     */
    public function getSecurityInformation()
    {
        return $this->securityInformation;
    }

    /**
     * @param null $securityInformation
     */
    public function setSecurityInformation($securityInformation): void
    {
        $this->securityInformation = $securityInformation;
    }

    /**
     * @return null
     */
    public function getInterchangeIdQualifier01()
    {
        return $this->interchangeIdQualifier01;
    }

    /**
     * @param null $interchangeIdQualifier01
     */
    public function setInterchangeIdQualifier01($interchangeIdQualifier01): void
    {
        $this->interchangeIdQualifier01 = $interchangeIdQualifier01;
    }

    /**
     * @return null
     */
    public function getInterchangeSenderId()
    {
        return $this->interchangeSenderId;
    }

    /**
     * @param null $interchangeSenderId
     */
    public function setInterchangeSenderId($interchangeSenderId): void
    {
        $this->interchangeSenderId = $interchangeSenderId;
    }

    /**
     * @return null
     */
    public function getInterchangeIdQualifier02()
    {
        return $this->interchangeIdQualifier02;
    }

    /**
     * @param null $interchangeIdQualifier02
     */
    public function setInterchangeIdQualifier02($interchangeIdQualifier02): void
    {
        $this->interchangeIdQualifier02 = $interchangeIdQualifier02;
    }

    /**
     * @return string
     */
    public function getInterchangeReceiverId(): string
    {
        return $this->interchangeReceiverId;
    }

    /**
     * @param string $interchangeReceiverId
     */
    public function setInterchangeReceiverId(string $interchangeReceiverId): void
    {
        $this->interchangeReceiverId = $interchangeReceiverId;
    }

    /**
     * @return null
     */
    public function getInterchangeDate()
    {
        return $this->interchangeDate;
    }

    /**
     * @param null $interchangeDate
     */
    public function setInterchangeDate($interchangeDate): void
    {
        $this->interchangeDate = $interchangeDate;
    }

    /**
     * @return null
     */
    public function getInterchangeTime()
    {
        return $this->interchangeTime;
    }

    /**
     * @param null $interchangeTime
     */
    public function setInterchangeTime($interchangeTime): void
    {
        $this->interchangeTime = $interchangeTime;
    }

    /**
     * @return string
     */
    public function getRepetitionSeparator(): string
    {
        return $this->repetitionSeparator;
    }

    /**
     * @param string $repetitionSeparator
     */
    public function setRepetitionSeparator(string $repetitionSeparator): void
    {
        $this->repetitionSeparator = $repetitionSeparator;
    }

    /**
     * @return string
     */
    public function getInterchangeControlVersionNumber(): string
    {
        return $this->interchangeControlVersionNumber;
    }

    /**
     * @param string $interchangeControlVersionNumber
     */
    public function setInterchangeControlVersionNumber(string $interchangeControlVersionNumber): void
    {
        $this->interchangeControlVersionNumber = $interchangeControlVersionNumber;
    }

    /**
     * @return null
     */
    public function getInterchangeControlNumber()
    {
        return $this->interchangeControlNumber;
    }

    /**
     * @param null $interchangeControlNumber
     */
    public function setInterchangeControlNumber($interchangeControlNumber): void
    {
        $this->interchangeControlNumber = $interchangeControlNumber;
    }

    /**
     * @return string
     */
    public function getAcknowledgmentRequested(): string
    {
        return $this->acknowledgmentRequested;
    }

    /**
     * @param string $acknowledgmentRequested
     */
    public function setAcknowledgmentRequested(string $acknowledgmentRequested): void
    {
        $this->acknowledgmentRequested = $acknowledgmentRequested;
    }

    /**
     * @return null
     */
    public function getUsageIndicator()
    {
        return $this->usageIndicator;
    }

    /**
     * @param null $usageIndicator
     */
    public function setUsageIndicator($usageIndicator): void
    {
        $this->usageIndicator = $usageIndicator;
    }

    /**
     * @return string
     */
    public function getComponentElementSeparator(): string
    {
        return $this->componentElementSeparator;
    }

    /**
     * @param string $componentElementSeparator
     */
    public function setComponentElementSeparator(string $componentElementSeparator): void
    {
        $this->componentElementSeparator = $componentElementSeparator;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }
}
