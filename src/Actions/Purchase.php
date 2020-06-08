<?php

namespace Tafhyseni\PhpGodaddy\Actions;

use Tafhyseni\PhpGodaddy\Config\ContactRegistrant;
use Tafhyseni\PhpGodaddy\Exceptions\DomainException;
use Tafhyseni\PhpGodaddy\Request\Requests;

class Purchase extends Requests
{
    const API_URL = 'v1/domains/purchase';

    public $consent;
    public $contactAdmin;
    public $contactBilling;
    public $contactRegistrant;
    public $contactTech;

    /**
     * @var
     */
    public $domain;

    public $nameServers;

    public $period = 1;

    // boolean, default: false
    public $privacy = false;

    // boolean, default: true
    public $renewAuto = true;

    // returned instance of Agreement
    public $agreement;

    public $currency;
    public $itemCount;
    public $orderId;
    public $total;

    public function setOptions(array $options): self
    {
        $this->consent = $this->getAgreement();
        $this->contactAdmin = (new ContactRegistrant())->setData($options)->setAddressMailing($options);
        $this->contactBilling = $this->contactAdmin;
        $this->contactRegistrant = $this->contactAdmin;
        $this->contactTech = $this->contactAdmin;

        return $this;
    }

    /**
     * @param string $domain
     * @return Purchase
     * @throws DomainException
     */
    public function setDomain(string $domain): self
    {
        if (! $domain) {
            throw DomainException::noDomainProvided();
        }

        $this->domain = MyDomain::parse($domain)->getRegistrableDomain();

        return $this;
    }

    /**
     * Returns user agreement contract.
     */
    protected function getAgreement()
    {
        return (new Agreement($this->configuration, $this->domain))->agreement(MyDomain::parse($this->domain)->getPublicSuffix());
    }

    /**
     * @param bool $privacy
     * @return Purchase
     */
    public function privacy(bool $privacy = true): self
    {
        $this->privacy = $privacy;

        return $this;
    }

    /**
     * @param array $nameServers
     * @return Purchase
     */
    public function nameServers(array $nameServers = []): self
    {
        $this->nameServers = $nameServers;

        return $this;
    }

    /**
     * @param int $period
     * @return Purchase
     * @throws DomainException
     */
    public function period(int $period = 1): self
    {
        if ($period < 1 || $period > 10) {
            throw DomainException::invalidDomainPeriod();
        }

        $this->period = $period;

        return $this;
    }

    /**
     * @param bool $autorenew
     */
    public function autorenew(bool $autorenew = true)
    {
        $this->renewAuto = $autorenew;
    }

    public function submit(): self
    {
        self::doAPIPurchase(self::API_URL, $this->purchaseParameters());

        $this->currency = $this->httpBody->currency;
        $this->itemCount = $this->httpBody->itemCount;
        $this->orderId = $this->httpBody->orderId;
        $this->total = $this->httpBody->total;

        return $this;
    }

    protected function purchaseParameters()
    {
        return [
            'consent' => $this->consent,
            'domain' => $this->domain,
            'nameServers' => $this->nameServers,
            'period' => $this->period,
            'privacy' => $this->privacy,
            'renewAuto' => $this->renewAuto,
            'contactAdmin' => $this->contactAdmin,
            'contactBilling' => $this->contactBilling,
            'contactRegistrant' => $this->contactRegistrant,
            'contactTech' => $this->contactTech,
        ];
    }
}
