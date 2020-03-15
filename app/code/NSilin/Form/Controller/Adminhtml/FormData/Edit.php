<?php

namespace NSilin\Form\Controller\Adminhtml\FormData;

use Magento\Framework\Exception\NoSuchEntityException;
use NSilin\Form\Service\CurrentFormDataService;

class Edit extends \NSilin\Form\Controller\Adminhtml\FormData
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'NSilin_Form::formDataGrid_edit';
    /**
     * @var \NSilin\Form\Model\FormDataFactory
     */
    private $formDataFactory;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;
    /**
     * @var CurrentFormDataService
     */
    private $currentFormDataService;

    public function __construct(
        \NSilin\Form\Model\FormDataRepository $formDataRepository,
        \NSilin\Form\Model\FormDataFactory $formDataFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        CurrentFormDataService $currentFormDataService
    ) {
        parent::__construct($formDataRepository, $context);
        $this->formDataFactory = $formDataFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->currentFormDataService = $currentFormDataService;
    }

    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $entity_id = $this->getRequest()->getParam('entity_id');
        if ($entity_id) {
            try {
                $formData = $this->formDataRepository->get($entity_id);

            } catch (\Exception $exception) {
                throw new NoSuchEntityException(__(
                    'Data with entity_id %1 doesn\'t exist.',
                    $entity_id
                ));
                $this->_redirect('nsilin_formdata/*');
                return;
            }
        } else {
            $formData = $this->formDataFactory->create();
        }
        $this->currentFormDataService->setCurrentFormData($formData);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Form Data'));
        $resultPage->getConfig()->getTitle()->prepend('Edit Form Data');
        return $resultPage;
    }
}
