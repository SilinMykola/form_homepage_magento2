<?php

namespace NSilin\Form\Block;


use Magento\Framework\View\Element\Template;

class Form extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
    public function getJsLayout()
    {
        return json_encode($this->jsLayout);
    }
}
