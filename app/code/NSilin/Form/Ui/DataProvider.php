<?php

namespace NSilin\Form\Ui;

use NSilin\Form\Model\ResourceModel\FormData\Grid\Collection;
use NSilin\Form\Model\ResourceModel\FormData\Grid\CollectionFactory;
use NSilin\Form\Service\CurrentFormDataService;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;
    /**
     * @var CurrentFormDataService
     */
    private $getCurrentFormData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        CurrentFormDataService $getCurrentFormData,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->getCurrentFormData = $getCurrentFormData;
    }
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $item = $this->getCurrentFormData->getCurrentFormData();
        if ($item->getEntityId()) {
            $this->loadedData[$item->getEntityId()] = $item->getData();
        }

        if (!isset($this->loadedData)) {
            $model = $this->collection->getNewEmptyItem();
            if ($model->getEntityId()) {
                $this->loadedData[$model->getEntityId()] = $model->getData();
            } else {
                $this->loadedData = [];
            }
        }

        return $this->loadedData;
    }
}
