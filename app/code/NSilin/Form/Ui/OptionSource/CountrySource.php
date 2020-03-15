<?php

namespace NSilin\Form\Ui\OptionSource;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\App\ResourceConnection;

class CountrySource implements OptionSourceInterface
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $countries = $this->getCountries();
        $options = [];
        $options[] = [
            'value' => '',
            'label' => __('Select Country')
        ];
        foreach ($countries as $country) {
            $options[] = [
                'value' => $country,
                'label' => $country
            ];
        }
        return $options;
    }
    protected function getCountries()
    {
        $tableName = $this->resourceConnection->getTableName('nsilin_form_countries');
        $sql = 'SELECT country_name FROM ' .$tableName;
        return $this->resourceConnection->getConnection()->fetchCol($sql);
    }
}