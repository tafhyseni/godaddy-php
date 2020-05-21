<?php

namespace Tafhyseni\PhpGodaddy\Actions;

use Tafhyseni\PhpGodaddy\Request\Requests;

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

    const URL_AVAILABLE_DOMAIN = 'v1/domains/available?domain=';

    /**
     * @param string $domain
     * @return Availability
     */
    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    public function check(): self
    {
        $this->getRequest(
            self::URL_AVAILABLE_DOMAIN . $this->domain
        );

        if($this->httpStatus === 200)
        {
            $this->domain = $this->httpBody->domain;
            $this->availability = $this->httpBody->available;
            $this->price = $this->httpBody->price ?? null;
            $this->currency = $this->httpBody->currency ?? null;
            $this->period = $this->httpBody->period ?? null;
        }

        return $this;
    }

    public function getStatus()
    {
        return $this->availability ?? false;
    }
}
