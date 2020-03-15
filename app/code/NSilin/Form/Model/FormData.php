<?php

namespace NSilin\Form\Model;

use NSilin\Form\Api\Data\FormDataInterface;

class FormData extends \Magento\Framework\Model\AbstractModel implements FormDataInterface
{
    public function _construct()
    {
        $this->_init(\NSilin\Form\Model\ResourceModel\FormData::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setEntityId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * @inheritDoc
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * @inheritDoc
     */
    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * @inheritDoc
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS);
    }

    /**
     * @inheritDoc
     */
    public function getRandomCheck()
    {
        return $this->getData(self::RANDOM_CHECK);
    }

    /**
     * @inheritDoc
     */
    public function setRandomCheck($randomCheck)
    {
        return $this->setData(self::RANDOM_CHECK, $randomCheck);
    }

    /**
     * @inheritDoc
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * @inheritDoc
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }
}
