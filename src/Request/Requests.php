<?php

namespace Tafhyseni\PhpGodaddy\Request;

use GuzzleHttp\Client;
use Tafhyseni\PhpGodaddy\Actions\Configuration;

class Requests
{
    protected $configuration;

    public $httpStatus;
    public $httpHeaders;
    public $httpBody;
    public $httpMessage;



    function __construct(
        Configuration $configuration
    )
    {
        $this->configuration = $configuration;
    }

    public function getRequest(string $url)
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
            $this->httpStatus = $e->getCode();
            $this->httpMessage = $e->getMessage();
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