<?php

namespace NSilin\Form\Controller\Adminhtml\FormData;

class NewAction extends \NSilin\Form\Controller\Adminhtml\FormData
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'NSilin_Form::formDataGrid_new';
    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    private $resultForwardFactory;

    public function __construct(
        \NSilin\Form\Model\FormDataRepository $formDataRepository,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    )
    {
        parent::__construct($formDataRepository, $context);
        $this->resultForwardFactory = $resultForwardFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var  \Magento\Framework\Controller\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
