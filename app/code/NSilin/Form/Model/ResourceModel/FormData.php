<?php

namespace NSilin\Form\Model\ResourceModel;

class FormData extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('nsilin_form_data', 'entity_id');
    }
}
