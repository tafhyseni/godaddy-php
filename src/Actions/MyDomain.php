<?php

namespace Tafhyseni\PhpGodaddy\Actions;

use Pdp\Cache;
use Pdp\CurlHttpClient;
use Pdp\Manager;
use Pdp\Rules;

class MyDomain
{
    public $content;
    public $publicSuffix;
    public $registrableDomain;
    public $subDomain;

    public function __construct(string $domain)
    {
        $this->handleParsing($domain);
    }

    public static function parse(string $domain): self
    {
        return new self($domain);
    }

    public function handleParsing(string $domain): self
    {
        $domain = preg_replace('(^https?://)', '', $domain);
        $manager = new Manager(new Cache(), new CurlHttpClient());
        $rules = $manager->getRules();

        $domain = $rules->resolve($domain);
        $this->content = $domain->getContent();
        $this->registrableDomain = $domain->getRegistrableDomain();
        $this->subDomain = $domain->getSubDomain();

        $altSuffix = $rules->getPublicSuffix($domain, Rules::ICANN_DOMAINS);
        $this->publicSuffix = $altSuffix->getContent();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublicSuffix()
    {
        return $this->publicSuffix;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getRegistrableDomain()
    {
        return $this->registrableDomain;
    }

    /**
     * @return mixed
     */
    public function getSubDomain()
    {
        return $this->subDomain;
    }
}
