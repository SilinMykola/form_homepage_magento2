<?php

namespace NSilin\Form\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FormDataRepositoryInterface
{
    /**
     * Save Form Data
     * @param \NSilin\Form\Api\Data\FormDataInterface $formData
     * @return \NSilin\Form\Api\Data\FormDataInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \NSilin\Form\Api\Data\FormDataInterface $formData
    );

    /**
     * Get Form Data
     * @param string $entityId
     * @return \NSilin\Form\Api\Data\FormDataInterface
     */
    public function get($entityId);

    /**
     * Get list Form data
     * @param SearchCriteriaInterface $searchCriteria
     * @return \NSilin\Form\Api\Data\FormDataInterface[]
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Form data
     * @param \NSilin\Form\Api\Data\FormDataInterface $formData
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \NSilin\Form\Api\Data\FormDataInterface $formData
    );

    /**
     * Delete Form data by Id
     * @param string $entityId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($entityId);
}
