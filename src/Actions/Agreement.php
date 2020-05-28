<?php


namespace Tafhyseni\PhpGodaddy\Actions;

use Tafhyseni\PhpGodaddy\Request\Requests;

class Agreement extends Requests
{
    const API_URL = 'v1/domains/agreements';

    public $domain;

    public $privacy = false;

    public $agreedAt;

    public $agreedBy;

    public $agreementKeys;

    public function __construct(
        Configuration $configuration,
        string $domain
    )
    {
        parent::__construct($configuration);
        $this->agreedAt = date('Y-m-d H:i:s');
        $this->agreedBy = $_SERVER['REMOTE_ADDR'];
        $this->domain = $domain;
    }

    public function agreement(): self
    {
        $this->doAPIRequest($this->_prepareEndpoint());
        $this->agreementKeys = [reset($this->httpBody)->agreementKey];

        return $this;
    }

    public function privacy(bool $privacy = true): self
    {
        $this->privacy = $privacy;

        return $this;
    }

    protected function _prepareEndpoint()
    {
        $tldsUrl = self::API_URL . '?tlds=' . $this->getTLDS();
        if($this->privacy)
        {
            return $tldsUrl . '&privacy=true';
        }

        return $tldsUrl;
    }

    private function getTLDS()
    {
        return MyDomain::parse($this->domain)->getPublicSuffix();
    }


}