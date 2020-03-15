<?php

namespace NSilin\Form\Model\ResourceModel\FormData;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NSilin\Form\Model\FormData::class,
            \NSilin\Form\Model\ResourceModel\FormData::class
        );
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }
}
