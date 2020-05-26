<?php


namespace Tafhyseni\PhpGodaddy\Actions;


use Tafhyseni\PhpGodaddy\Request\Requests;

class Agreement extends Requests
{
    // Domain Consent & Agreement

    public $agreedAt;

    public $agreedBy;

    public $agreementKeys;

    public function __construct()
    {
        
    }

}