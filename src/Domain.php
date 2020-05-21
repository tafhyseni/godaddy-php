<?php

namespace Tafhyseni\PhpGodaddy;

// use Tafhyseni\PhpGodaddy\Actions\Availability;
use Tafhyseni\PhpGodaddy\Actions\Configuration;

class Domain
{
    /**
     * Your GoDaddy developer API KEY
     * Haven't one? Get it at https://developer.godaddy.com/
     */
    private $api_key;

    /**
     * Your GoDaddy developer Secret KEY
     * Haven't one? Get it at https://developer.godaddy.com/
     */
    private $secret_key;

    /**
     * Defines environment
     */
    private $environment;

    /**
     * Api Endpoint
     */
    private $endpoint;

    function __construct(
        Configuration $config
    )
    {
        $this->api_key = $config->getApiKey();
        $this->secret_key = $config->getSecretKey();
        $this->environment = $config->getEnvironment();
        $this->endpoint = $config->getEndpoint();
      
        

        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    }

    public static function initialize(string $api_key, string $secret_key, $production = true): self
    {
        $config = (new Configuration())
            ->setApiKey($api_key)
            ->setSecretKey($secret_key)
            ->setEnvironment($production);

        return (new self($config));
    }

    /**
     * Check if a domain is available
     * @param string $domain 'desired domain'
     * return
     */
    public function available(string $domain): \Tafhyseni\PhpGodaddy\Actions\Availability
    {
        return (new \Tafhyseni\PhpGodaddy\Actions\Availability);
    }

    /**
     * Define environment
     */
    public function setDevEnv($status = true)
    {
        if($status)
        {
            $this->env = 'dev';
            return;
        }

        $this->env = 'real';
    }

    public function setKeys(string $api_key, string $secret_key): self
    {
        $this->api_key = $api_key;
        $this->secret_key = $secret_key;
        return new self();
    }

    // public function hello()
    // {
    //     $available = new Availability();
    //     $available->test();
    // }
}
