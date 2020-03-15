<?php

namespace NSilin\Form\Controller\Adminhtml;

use Magento\Backend\App\Action;
use NSilin\Form\Model\FormDataRepository;

abstract class FormData extends Action
{
    const ADMIN_RESOURCE = 'NSilin_Form::formDataGrid_new';
    /**
     * @var FormDataRepository
     */
    protected $formDataRepository;

    public function __construct(
        \NSilin\Form\Model\FormDataRepository $formDataRepository,
        \Magento\Backend\App\Action\Context $context
    ) {
        parent::__construct($context);
        $this->formDataRepository = $formDataRepository;
    }
}
