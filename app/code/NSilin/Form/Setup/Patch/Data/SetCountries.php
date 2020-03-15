<?php

namespace NSilin\Form\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\App\ResourceConnection;

class SetCountries implements DataPatchInterface
{
    /**
     * @var \NSilin\Form\Service\GetCountriesFromApiService
     */
    private $getCountriesFromApiService;
    /**
     * @var ResourceConnection
     */
    private $resource;

    public function __construct(
        \NSilin\Form\Service\GetCountriesFromApiService $getCountriesFromApiService,
        ResourceConnection $resource
    ) {
        $this->getCountriesFromApiService = $getCountriesFromApiService;
        $this->resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $countries = $this->getCountriesFromApiService->getCountries();
        $this->resource->getConnection()->insertArray(
            $this->resource->getTableName('nsilin_form_countries'),
        ['country_name'],
            $countries
        );
    }
}
