<?php


namespace Tafhyseni\PhpGodaddy\Actions;


use Tafhyseni\PhpGodaddy\Exceptions\DomainException;
use Tafhyseni\PhpGodaddy\Request\Requests;

class Records extends Requests
{
    const API_URL = 'v1/domains/{domain}/records/{type}';

    public $domain;
    public $type;
    public $data;

    /**
     * @param mixed $domain
     * @return Records
     * @throws DomainException
     */
    public function setDomain(string $domain): self
    {
        if(!$domain)
        {
            throw DomainException::noDomainProvided();
        }

        $this->domain = MyDomain::parse($domain)->getRegistrableDomain();;
        return $this;
    }

    /**
     * @param mixed $type
     * @return Records
     */
    public function setType($type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param mixed $data
     * @return Records
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function set(): self
    {
        self::doAPIrecords($this->endpoint(), $this->data);

        return $this;
    }

    protected function endpoint()
    {
        $slugs = ['{domain}', '{type}'];
        $parameters = [$this->domain, $this->type];
        return str_replace($slugs, $parameters, self::API_URL);
    }

}