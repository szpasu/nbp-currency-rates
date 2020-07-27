<?php namespace App\Domains\Currency\Api;

use App\Domains\Currency\Api\Interfaces\BaseApiInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * File: BaseApi.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
abstract class BaseApi implements BaseApiInterface
{

    /**
     * @var string
     */
    protected $endpointUrl = '';

    /**
     * @var Client
     */
    protected $guzzleClient;

    /**
     * @param string $query
     * @param string $method
     * @return string
     */
    protected function getData(string $query, string $method = 'GET'): string
    {
        $this->guzzleClient = new Client();

        /* @var ResponseInterface $resource */
        try {
            $resource = $this->guzzleClient->request(
                $method,
                $this->endpointUrl . $query
            );
        } catch (GuzzleException $e) {
            throw new Exception('Not found data for provided currency!');
        }

        if ($resource->getStatusCode() !== 200) {
            throw new Exception('Not found data for provided currency!');
        }

        return $resource->getBody();
    }

}
