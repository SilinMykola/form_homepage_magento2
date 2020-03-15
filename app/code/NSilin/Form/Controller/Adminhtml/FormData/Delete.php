<?php

namespace NSilin\Form\Controller\Adminhtml\FormData;


class Delete extends \NSilin\Form\Controller\Adminhtml\FormData
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'NSilin_Form::formDataGrid_delete';

    /**
     * Delete constructor.
     * @param \NSilin\Form\Model\FormDataRepository $formDataRepository
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \NSilin\Form\Model\FormDataRepository $formDataRepository,
        \Magento\Backend\App\Action\Context $context
    ) {
        parent::__construct($formDataRepository, $context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $entityId = $this->getRequest()->getParam('entity_id');
        if ($entityId) {
            try {
                $this->formDataRepository->deleteById($entityId);
                $this->messageManager->addSuccessMessage(__('You deleted the Form Data.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $entityId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Form Data to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
