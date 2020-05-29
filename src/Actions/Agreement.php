<?php


namespace Tafhyseni\PhpGodaddy\Actions;

use Tafhyseni\PhpGodaddy\Request\Requests;

class Agreement extends Requests
{
    const API_URL = 'v1/domains/agreements';

    protected $tlds;

    public $agreedAt;

    public $agreedBy;

    public $agreementKeys;

    public function __construct(
        Configuration $configuration,
        string $tlds
    )
    {
        parent::__construct($configuration);
        $this->agreedAt = date("Y-m-d\TH:i:s\Z");
        $this->agreedBy = $_SERVER['REMOTE_ADDR'];
        $this->tlds = $tlds;
    }

    public function agreement(string $suffix)
    {
        $this->doAPIAgreement($this->_prepareEndpoint());
        $this->agreementKeys = [$this->httpBody];

        return [
            'agreedAt' => $this->agreedAt,
            'agreedBy' => $this->agreedBy,
            'agreementKeys' => $this->agreementKeys
        ];
    }

    protected function _prepareEndpoint()
    {
        return self::API_URL . '?tlds=' . $this->tlds;
    }

}