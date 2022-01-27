<?php

namespace Tafhyseni\PhpGodaddy\Actions;

use Tafhyseni\PhpGodaddy\Exceptions\DomainException;

class Configuration
{
    /**
     * Your GoDaddy developer API KEYs
     * Haven't one? Get it at https://developer.godaddy.com/.
     */
    public $api_key;
    public $secret_key;

    /**
     * Environment
     * Default: Environment.
     */
    public $environment = 'production';

    /**
     * API Endpoints.
     */
//    const API_URL = 'https://api.godaddy.com/';
    const API_URL = 'https://api.godaddy.com/';
    const SANDBOX_URL = 'https://api.ote-godaddy.com/';

    public function __construct(

    ) {
    }

    /**
     * API Key setter.
     * @param string $api_key
     * @return Configuration
     * @throws DomainException
     */
    public function setApiKey(string $api_key): self
    {
        if (! $api_key) {
            throw DomainException::noApiKeyProvided();
        }
        $this->api_key = $api_key;

        return $this;
    }

    /**
     * Secret Key setter.
     * @param string $secret_key
     * @return Configuration
     * @throws DomainException
     */
    public function setSecretKey(string $secret_key): self
    {
        if (! $secret_key) {
            throw DomainException::noSecretKeyProvided();
        }

        $this->secret_key = $secret_key;

        return $this;
    }

    /**
     * Defining Environment.
     * @param bool $is_real
     * @return Configuration
     */
    public function setEnvironment($production = true): self
    {
        if ($production) {
            $this->environment = 'production';

            return $this;
        }

        $this->environment = 'dev';

        return $this;
    }

    /**
     * API Key getter.
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->api_key;
    }

    /**
     * Secret Key getter.
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secret_key;
    }

    /**
     * Environment getter.
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * Endpoint based in environment.
     * @return string
     */
    public function getEndpoint()
    {
        return $this->environment == 'dev' ? self::SANDBOX_URL : self::API_URL;
    }
}
