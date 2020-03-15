<?php

namespace NSilin\Form\Controller\Adminhtml\FormData;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use NSilin\Form\Api\Data\FormDataInterfaceFactory;

class Save extends \NSilin\Form\Controller\Adminhtml\FormData
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'NSilin_Form::formDataGrid_save';
    /**
     * @var \NSilin\Form\Model\FormDataFactory
     */
    private $formDataFactory;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;
    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    private $dataObjectHelper;

    public function __construct(
        \NSilin\Form\Model\FormDataRepository $formDataRepository,
        \NSilin\Form\Api\Data\FormDataInterfaceFactory $formDataFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
    ) {
        parent::__construct($formDataRepository, $context);
        $this->formDataFactory = $formDataFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->dataPersistor = $dataPersistor;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $formDataId = $this->getRequest()->getParam('entity_id');
            if ($formDataId) {
                $formData = $this->formDataRepository->get($formDataId);
            } else {
                    $formData = $this->formDataFactory->create();

            }
            $formData = $this->setModelData($formData, $data);
            try {
                $this->formDataRepository->save($formData);
                $this->messageManager->addSuccessMessage(__('You saved Form Data.'));
                $this->dataPersistor->clear('nsilin_form_data');
            } catch (LocalizedException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Form Data.'));
            }
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
            }
            return $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect->setPath('*/*/');
    }
    protected function setModelData($formData, $data)
    {
        foreach ($data as $key => $value) {
            if ($key != 'form_key') {
                if ($key == 'entity_id' && $data['entity_id'] != '') {
                    $formData->setData($key, $value);
                } elseif ($key != 'entity_id') {
                    $formData->setData($key, $value);
                }
            }
        }
        return $formData;
    }
}
