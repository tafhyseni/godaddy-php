<?php

namespace Tafhyseni\PhpGodaddy;

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

    /**
     * Configuration handler
     */
    private $configuration;

    /**
     * Domain constructor.
     * @param Actions\Configuration $config
     */
    function __construct(
        Actions\Configuration $config
    )
    {
        $this->api_key = $config->getApiKey();
        $this->secret_key = $config->getSecretKey();
        $this->environment = $config->getEnvironment();
        $this->endpoint = $config->getEndpoint();
        $this->configuration = $config;
    }

    public static function initialize(string $api_key, string $secret_key, $production = true): self
    {
        $config = (new Actions\Configuration())
            ->setApiKey($api_key)
            ->setSecretKey($secret_key)
            ->setEnvironment($production);

        return (new self($config));
    }

    /**
     * Fetch domain suggestions based on a keyword
     * @param string $keyword
     * @param int $limit
     * @return Actions\Suggestion
     * @throws Exceptions\DomainException
     */
    public function suggestion(string $keyword, int $limit = 0): Actions\Suggestion
    {
        return (new Actions\Suggestion($this->configuration))->setKeyword($keyword)->setLimit($limit)->fetch();
    }

    /**
     * Check if a domain is available
     * @param string $domain 'desired domain'
     * @return Actions\Availability
     * @throws Exceptions\DomainException
     */
    public function available(string $domain): Actions\Availability
    {
        return (new Actions\Availability($this->configuration))->setDomain($domain)->check();
    }

    /**
     * Check multiple domains for their availability status
     * @param array $domains
     * @return array
     * @throws Exceptions\DomainException
     */
    public function availableMultiple(array $domains): array
    {
        $results = [];
        foreach ($domains as $domain){
            $results[] = (new Actions\Availability($this->configuration))->setDomain($domain)->check();
        }

        return $results;
    }

    /**
     * @param string $domain
     * @param array $options
     * @return Actions\Purchase
     * @throws Exceptions\DomainException
     */
    public function purchase(string $domain, array $options): Actions\Purchase
    {
        return (new Actions\Purchase($this->configuration))->setDomain($domain)->setOptions($options);
    }

    public function records(string $domain, string $type, array $data): Actions\Records
    {
        return (new Actions\Records($this->configuration))->setDomain($domain)->setType($type)->setData($data);
    }
}
