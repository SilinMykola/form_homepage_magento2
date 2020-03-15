<?php

namespace NSilin\Form\Service;

use Psr\Log\LoggerInterface;
use Magento\Framework\Http\Client\Curl;

class GetCountriesFromApiService
{
    const API_URL = 'https://restcountries.eu/rest/v2/all';
    /**
     * @var \Magento\Framework\Http\Client\Curl
     */
    private $client;
    /**
     * @var LoggerInterface
     */
    private $requestLogger;
    /**
     * @var LoggerInterface
     */
    private $responseLogger;
    /**
     * @var LoggerInterface
     */
    private $errorLogger;


    public function __construct(
        Curl $client,
        LoggerInterface $requestLogger,
        LoggerInterface $responseLogger,
        LoggerInterface $errorLogger
    ) {
        $this->client = $client;
        $this->requestLogger = $requestLogger;
        $this->responseLogger = $responseLogger;
        $this->errorLogger = $errorLogger;
    }
    public function getCountries()
    {
        $countries = [];
        try {
            $this->requestLogger->info("Send request");
            $this->client->get(self::API_URL);
            $response = $this->client->getBody();
            $this->responseLogger->info(__("Get Response: %1", $response));
            $countries = $this->getCountriesName($response);
        } catch (\Exeption $e) {
            $this->errorLogger->info(__('Get Error during request: %1', $e->getMessage()));
        }
        return $countries;
    }
    private function getCountriesName($params)
    {
        $params = json_decode($params, true);
        $countries = [];
        foreach ($params as $param) {
            $countries[] = $param['name'];
        }
        return $countries;
    }
}
