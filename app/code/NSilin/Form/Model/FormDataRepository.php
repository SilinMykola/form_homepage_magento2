<?php

namespace NSilin\Form\Model;

use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use NSilin\Form\Api\FormDataRepositoryInterface;
use NSilin\Form\Api\Data\FormDataInterface;
use NSilin\Form\Api\Data\FormDataInterfaceFactory;
use NSilin\Form\Api\Data\FormDataSearchResultInterfaceFactory;
use NSilin\Form\Model\ResourceModel\FormData as FormDataResource;
use NSilin\Form\Model\ResourceModel\FormData\CollectionFactory as FromDataCollectionFactory;

class FormDataRepository implements FormDataRepositoryInterface
{
    /**
     * @var FormDataFactory
     */
    private $formDataFactory;
    /**
     * @var FormDataResource
     */
    private $resource;
    /**
     * @var ExtensibleDataObjectConverter
     */
    private $extensibleDataObjectConverter;
    /**
     * @var FromDataCollectionFactory
     */
    private $formDataCollectionFactory;
    /**
     * @var JoinProcessorInterface
     */
    private $extensionAttributesJoinProcessor;
    /**
     * @var FormDataSearchResultInterfaceFactory
     */
    private $formDataSearchResultInterfaceFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        CollectionProcessorInterface $collectionProcessor,
        FormDataInterfaceFactory $formDataFactory,
        FormDataSearchResultInterfaceFactory $formDataSearchResultInterfaceFactory,
        FormDataResource $resource,
        FromDataCollectionFactory $formDataCollectionFactory
    ) {
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->formDataFactory = $formDataFactory;
        $this->resource = $resource;
        $this->formDataCollectionFactory = $formDataCollectionFactory;
        $this->formDataSearchResultInterfaceFactory = $formDataSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(FormDataInterface $formData)
    {
        try {
            $this->resource->save($formData);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save form data: %1',
                $exception->getMessage()
            ));
        }
        return $formData;
    }

    /**
     * @inheritDoc
     */
    public function get($entityId)
    {
        $formData = $this->formDataFactory->create();
        $this->resource->load($formData, $entityId);
        if (!$formData->getEntityId()) {
            throw new NoSuchEntityException(__(
                'FormData with id "%1" does not exist',
                $entityId
            ));
        }
        return $formData;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->formDataCollectionFactory->create();
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            FormDataInterface::class
        );
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->formDataSearchResultInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(FormDataInterface $formData)
    {
        try {
            $formDataModel = $this->formDataFactory->create();
            $this->resource->load($formDataModel, $formData->getEntityId());
            $this->resource->delete($formDataModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete FormData: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($entityId)
    {
        return $this->delete($this->get($entityId));
    }
}