<?php

namespace Tafhyseni\PhpGodaddy\Request;

use GuzzleHttp\Client;
use Tafhyseni\PhpGodaddy\Actions\Configuration;
use Tafhyseni\PhpGodaddy\Exceptions\DomainException;

class Requests
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var
     */
    public $httpStatus;
    /**
     * @var
     */
    public $httpHeaders;
    /**
     * @var
     */
    public $httpBody;
    /**
     * @var
     */
    public $httpMessage;

    /**
     * Requests constructor.
     * @param Configuration $configuration
     */
    function __construct(
        Configuration $configuration
    )
    {
        $this->configuration = $configuration;
    }

    /**
     * @param string $url
     * @throws DomainException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function doAPIRequest(string $url)
    {
        try {
            $client = new Client(
                $this->getHeaders()
            );
            $request = $client->request(
                'GET',
                $this->configuration->getEndpoint() . $url
            );

            $this->httpStatus = $request->getStatusCode();
            $this->httpHeaders = $request->getHeaders();
            $this->httpBody = json_decode($request->getBody()->getContents());
        }catch (\Exception $e) {
            throw DomainException::authorizationFailed();
        }
    }

    public function doAPIPurchase(string $url, $parameters)
    {
        try {
            $client = new Client(
                $this->getHeaders()
            );
            $request = $client->request(
                'POST',
                $this->configuration->getEndpoint() . $url,
                [
                    'form_params' => $parameters
                ]
            );

            $this->httpStatus = $request->getStatusCode();
            $this->httpHeaders = $request->getHeaders();
            $this->httpBody = json_decode($request->getBody()->getContents());
        }catch (\Exception $e) {
            throw DomainException::authorizationFailed();
        }
    }

    protected function getHeaders(): array
    {
        return [
            'headers' => [
                'Authorization' => ['sso-key ' . $this->configuration->getApiKey() . ':' . $this->configuration->getSecretKey()],
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ];
    }
}