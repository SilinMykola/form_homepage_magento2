<?php

namespace NSilin\Form\Api\Data;

interface FormDataInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const EMAIL = 'email';
    const TELEPHONE = 'telephone';
    const ADDRESS = 'address';
    const RANDOM_CHECK = 'random_check';
    const COUNTRY = 'country';

    /**
     * Get entity id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity id
     * @param string $id
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function setEntityId($id);

    /**
     * Get Name
     * @return string|null
     */
    public function getName();

    /**
     * Set Name
     * @param string $name
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function setName($name);

    /**
     * Get Email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set Email
     * @param string $email
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function setEmail($email);

    /**
     * Get telephone
     * @return string|null
     */
    public function getTelephone();

    /**
     * Set telephone
     * @param string $telephone
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function setTelephone($telephone);

    /**
     * Get address
     * @return string|null
     */
    public function getAddress();

    /**
     * Set address
     * @param string $address
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function setAddress($address);

    /**
     * Get random check
     * @return string|null
     */
    public function getRandomCheck();

    /**
     * Set random check
     * @param string $randomCheck
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function setRandomCheck($randomCheck);

    /**
     * Get country
     * @return string|null
     */
    public function getCountry();

    /**
     * Set country
     * @param string $country
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function setCountry($country);
}
