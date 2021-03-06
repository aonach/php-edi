<?php

namespace Aonach\X12\Generator;

use Aonach\X12\Generator\SegmentGeneratorInterface;


/**
 * Class N1Generator
 * @package Aonach\X12\Generator
 */
class N1Generator implements SegmentGeneratorInterface
{

    /**
     *
     */
    const SEGMENT_CODE = 'N1';

    /**
     *
     */
    const SEGMENT_SECTIONS_NUMBER = 4;


    /**
     * @var
     */
    private $entityIdentifierCode = 'SF';

    /**
     * @var
     */
    private $name = 'RNO1';

    /**
     * @var
     */
    private $identificationCodeQualifier = '92';

    /**
     * @var
     */
    private $identificationCode = 'RNO1';

    /**
     * @var
     */
    private $data;


    /**
     * Name constructor.
     */
    public function __construct($name, $identificationCode)
    {
        $this->setName($name);
        $this->setIdentificationCode($identificationCode);
    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return (!is_null($this->getData())) ? implode('*', $this->getData()) : self::SEGMENT_CODE;

    }

    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->setData([
            self::SEGMENT_CODE,
            (!is_null($this->getEntityIdentifierCode())) ? $this->getEntityIdentifierCode() : '',
            (!is_null($this->getName())) ? $this->getName() : '',
            (!is_null($this->getIdentificationCodeQualifier())) ? $this->getIdentificationCodeQualifier() : '',
            (!is_null($this->getIdentificationCode())) ? $this->getIdentificationCode(): '',
        ]);
    }

    /**
     * @return mixed
     */
    public function getEntityIdentifierCode()
    {
        return $this->entityIdentifierCode;
    }

    /**
     * @param mixed $entityIdentifierCode
     */
    public function setEntityIdentifierCode($entityIdentifierCode): void
    {
        $this->entityIdentifierCode = $entityIdentifierCode;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIdentificationCodeQualifier()
    {
        return $this->identificationCodeQualifier;
    }

    /**
     * @param mixed $identificationCodeQualifier
     */
    public function setIdentificationCodeQualifier($identificationCodeQualifier): void
    {
        $this->identificationCodeQualifier = $identificationCodeQualifier;
    }

    /**
     * @return mixed
     */
    public function getIdentificationCode()
    {
        return $this->identificationCode;
    }

    /**
     * @param mixed $identificationCode
     */
    public function setIdentificationCode($identificationCode): void
    {
        $this->identificationCode = $identificationCode;
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