<?php

namespace NSilin\Form\Service;


class CurrentFormDataService extends \Magento\Framework\DataObject
{
    /**
     * @var \NSilin\Form\Api\Data\FormDataInterface
     */
    public $currentFormData;

    /**
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function getCurrentFormData()
    {
        return $this->currentFormData;
    }

    /**
     * set current form data
     * @param \NSilin\Form\Api\Data\FormDataInterface $currentFormData
     * @return $this
     */
    public function setCurrentFormData($currentFormData)
    {
        $this->currentFormData = $currentFormData;
        return $this;
    }
}
