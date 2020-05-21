<?php

namespace Tafhyseni\PhpGodaddy\Actions;

class Configuration
{
    /**
     * Your GoDaddy developer API KEYs
     * Haven't one? Get it at https://developer.godaddy.com/
     */
    public $api_key;
    public $secret_key;

    /**
     * Environment
     * Default: Environment
     */
    public $environment = 'production';

    /**
     * API Endpoints
     */  
    const API_URL = 'https://api.godaddy.com/';
    const SANDBOX_URL = 'https://api.ote-godaddy.com/';

    function __construct(
        
    )
    {
        
    }

    //TODO: If no apikeys throw exception

    public function setApiKey(string $api_key): self
    {
        $this->api_key = $api_key;
        return $this;
    }

    public function setSecretKey(string $secret_key): self
    {
        $this->secret_key = $secret_key;
        return $this;
    }

    public function setEnvironment($is_real = true): self
    {
        if($is_real)
        {
            $this->environment = 'production';
            return $this;
        }

        $this->environment = 'dev';
        return $this;
    }
   
    public function getApiKey(): string
    {
        return $this->api_key;
    }

    public function getSecretKey(): string
    {
        return $this->secret_key;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function getEndpoint()
    {
        return $this->environment == 'dev' ? self::SANDBOX_URL : self::API_URL;
    }
    

}