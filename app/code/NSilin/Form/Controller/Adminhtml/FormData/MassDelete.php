<?php

namespace NSilin\Form\Controller\Adminhtml\FormData;

use Magento\Framework\App\ResponseInterface;

class MassDelete extends \NSilin\Form\Controller\Adminhtml\FormData
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'NSilin_Form::formDataGrid_massDelete';

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $entityIds = $this->getRequest()->getParam('selected');

        if ($entityIds) {
            foreach ($entityIds as $entityId) {
                try {
                    $this->formDataRepository->deleteById($entityId);
                    $this->messageManager->addSuccessMessage(__('You deleted the FormData.'));
                    return $resultRedirect->setPath('*/*/');
                } catch (\Exeption $exception) {
                    $this->messageManager->addErrorMessage(
                        $exception,
                        __('An error occurred during mass deletion. Please review log and try again.')
                    );
                    return $resultRedirect->setPath('*/*/');
                }
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Form Data to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
