<?php
namespace Aonach\X12\Generator;

/**
 * Class InterchangeHeader
 * @package Aonach\X12\Generator
 */
class InterchangeHeader implements SegmentGeneratorInterface {

    
    const SEGMENTS_NUMBER = 16;

    /**
     *  Code to identify the type of information in the Authorization Information
     *       00        No Authorization Information Present (No Meaningful Information in I02)
     *       01        UCS Communications ID
     *
     * @var $authorizationInformationQualifier string
     */
    private $authorizationInformationQualifier;

    /**
     *  Information used for additional identification or authorization of the interchange sender
     *  or the data in the interchange; the type of information is set by the Authorization Information Qualifier (I01)
     *
     * @var $authorizationInformation string
     */
    private $authorizationInformation;

    /**
     *  Code to identify the type of information in the Security Information
     *
     * @var $securityInformationQualifier string
     */
    private $securityInformationQualifier;

    /**
     * This is used for identifying the security information about the interchange sender or the data
     * in the interchange; the type of information is set by the Security Information Qualifier (I03)
     *
     * @var $securityInformation string
     */
    private $securityInformation;

    /**
     * Qualifier to designate the system/method of code structure used
     * to designate the sender or receiver ID element being qualified
     *
     * @var $interchangeIdQualifier string
     */
    private $interchangeIdQualifier;

    /**
     * Identification code published by the sender for other parties to use as the receiver ID to route data to them;\
     * the sender always codes this value in the sender ID element
     *
     * @var $interchangeSenderId string
     */
    private $interchangeSenderId;

    /**
     * Identification code published by the receiver of the data;
     * When sending, it is used by the sender as their sending ID,
     * thus other parties sending to them will use this as a receiving
     * ID to route data to them
     *
     * @var $interchangeReceiverId string
     */
    private $interchangeReceiverId;

    /**
     * Date of the interchange
     *
     * @var $interchangeDate string
     */
    private $interchangeDate;

    /**
     * @var $interchangeControlStandardsIdentifier string
     */
    private $interchangeControlStandardsIdentifier;

    /**
     * Code specifying the version number of the interchange control segments
     *
     * @var $interchangeControlVersionNumber string
     */
    private $interchangeControlVersionNumber;

    /**
     *  A control number assigned by the interchange sender
     *
     * @var $interchangeControlNumber string
     */
    private $interchangeControlNumber;

    /**
     * Code sent by the sender to request an interchange acknowledgment (TA1)
     *
     *      0       No Acknowledgment Requested
     *
     * @var $acknowledgmentRequested string
     */
    private $acknowledgmentRequested;

    /**
     * Code to indicate whether data enclosed by this interchange envelope is test, production or information
     *
     *      P       Production Data
     *      T       Test Data
     *
     * @var $usageIndicator string
     */
    private $usageIndicator;


    /**
     * InterchangeHeader constructor.
     */
    public function __construct($authorizationInformation = null, $securityInformation = null, $interchangeSenderId = null, $interchangeReceiverId = null)
    {
        $this->setAuthorizationInformation($authorizationInformation);
        $this->setSecurityInformation($securityInformation);
        $this->setInterchangeSenderId($interchangeSenderId);
        $this->setInterchangeReceiverId($interchangeReceiverId);
    }

    /**
     * return
     * @return mixed|void
     */
    public function build()
    {
        for ($i = 1; $i <= self::SEGMENTS_NUMBER; $i++){

        }
    }

    /**
     * @return string
     */
    public function getAuthorizationInformationQualifier(): string
    {
        return $this->authorizationInformationQualifier;
    }

    /**
     * @param string $authorizationInformationQualifier
     */
    public function setAuthorizationInformationQualifier(string $authorizationInformationQualifier): void
    {
        $this->authorizationInformationQualifier = $authorizationInformationQualifier;
    }

    /**
     * @return string
     */
    public function getAuthorizationInformation(): string
    {
        return $this->authorizationInformation;
    }

    /**
     * @param string $authorizationInformation
     */
    public function setAuthorizationInformation(string $authorizationInformation): void
    {
        $this->authorizationInformation = $authorizationInformation;
    }

    /**
     * @return string
     */
    public function getSecurityInformationQualifier(): string
    {
        return $this->securityInformationQualifier;
    }

    /**
     * @param string $securityInformationQualifier
     */
    public function setSecurityInformationQualifier(string $securityInformationQualifier): void
    {
        $this->securityInformationQualifier = $securityInformationQualifier;
    }

    /**
     * @return string
     */
    public function getSecurityInformation(): string
    {
        return $this->securityInformation;
    }

    /**
     * @param string $securityInformation
     */
    public function setSecurityInformation(string $securityInformation): void
    {
        $this->securityInformation = $securityInformation;
    }

    /**
     * @return string
     */
    public function getInterchangeIdQualifier(): string
    {
        return $this->interchangeIdQualifier;
    }

    /**
     * @param string $interchangeIdQualifier
     */
    public function setInterchangeIdQualifier(string $interchangeIdQualifier): void
    {
        $this->interchangeIdQualifier = $interchangeIdQualifier;
    }

    /**
     * @return string
     */
    public function getInterchangeSenderId(): string
    {
        return $this->interchangeSenderId;
    }

    /**
     * @param string $interchangeSenderId
     */
    public function setInterchangeSenderId(string $interchangeSenderId): void
    {
        $this->interchangeSenderId = $interchangeSenderId;
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
     * @return string
     */
    public function getInterchangeDate(): string
    {
        return $this->interchangeDate;
    }

    /**
     * @param string $interchangeDate
     */
    public function setInterchangeDate(string $interchangeDate): void
    {
        $this->interchangeDate = $interchangeDate;
    }

    /**
     * @return string
     */
    public function getInterchangeControlStandardsIdentifier(): string
    {
        return $this->interchangeControlStandardsIdentifier;
    }

    /**
     * @param string $interchangeControlStandardsIdentifier
     */
    public function setInterchangeControlStandardsIdentifier(string $interchangeControlStandardsIdentifier): void
    {
        $this->interchangeControlStandardsIdentifier = $interchangeControlStandardsIdentifier;
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
     * @return string
     */
    public function getInterchangeControlNumber(): string
    {
        return $this->interchangeControlNumber;
    }

    /**
     * @param string $interchangeControlNumber
     */
    public function setInterchangeControlNumber(string $interchangeControlNumber): void
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
     * @return string
     */
    public function getUsageIndicator(): string
    {
        return $this->usageIndicator;
    }

    /**
     * @param string $usageIndicator
     */
    public function setUsageIndicator(string $usageIndicator): void
    {
        $this->usageIndicator = $usageIndicator;
    }

}