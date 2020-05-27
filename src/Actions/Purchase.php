<?php


namespace Tafhyseni\PhpGodaddy\Actions;


use Tafhyseni\PhpGodaddy\Exceptions\DomainException;
use Tafhyseni\PhpGodaddy\Request\Requests;

class Purchase extends Requests
{
    // Required
    public $consent;

    public $contactAdmin;
    public $contactBilling;
    public $contactRegistrant;
    public $contactTech;

    /**
     * @var $domain
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

    /**
     * @param string $domain
     * @return Purchase
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

    /**
     * Returns user agreement contract
     */
    protected function getAgreement(): Agreement
    {
        return (new Agreement($this->configuration, $this->domain))->agreement();
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
        if($period < 1 || $period > 10)
        {
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

    public function submit()
    {

    }
}