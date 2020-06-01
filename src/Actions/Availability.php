<?php

namespace Tafhyseni\PhpGodaddy\Actions;

use Tafhyseni\PhpGodaddy\{Exceptions\DomainException, Request\Requests};

class Availability extends Requests
{
    /**
     * Domain name
     */
    public $domain;

    /**
     * Availability expressed in boolean
     */
    public $availability;

    /**
     * If available, we collect price aswell.
     */
    public $price;

    /**
     * Price currency
     */
    public $currency;

    /**
     * Domain period
     */
    public $period;

    /**
     * Method Endpoint
     */
    const URL_AVAILABLE_DOMAIN = 'v1/domains/available?domain=';

    /**
     * @param string $domain
     * @return Availability
     * @throws DomainException
     */
    public function setDomain(string $domain): self
    {
        if(!$domain)
        {
            throw DomainException::noDomainProvided();
        }

        $this->domain = MyDomain::parse($domain)->getRegistrableDomain();
        return $this;
    }

    public function check(): self
    {
        $this->doAPIRequest(
            self::URL_AVAILABLE_DOMAIN . $this->domain
        );

        if($this->httpStatus === 200)
        {
            $this->domain = $this->httpBody->domain;
            $this->availability = $this->httpBody->available;
            $this->price = isset($this->httpBody->price) ? ($this->httpBody->price / 1000000) : null;
            $this->currency = isset($this->httpBody->currency) ? $this->httpBody->currency : null;
            $this->period = isset($this->httpBody->period) ? $this->httpBody->period : null;
        }

        return $this;
    }

    public function isAvailable()
    {
        return $this->availability ?? false;
    }

    public function priceToString(): string
    {
        if(!$this->availability)
        {
            return "Domain not available to purchase";
        }
        return "{$this->price} {$this->currency} / {$this->period} year(s)";
    }
}
