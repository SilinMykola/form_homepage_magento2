<?php

namespace NSilin\Form\Api\Data;

interface FormDataSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get FormData list
     * @return \NSilin\Form\Api\Data\FormDataInterface[]
     */
    public function getItems();

    /**
     * Set FormData list
     * @param \NSilin\Form\Api\Data\FormDataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}