<?php

namespace Tafhyseni\PhpGodaddy\Request;

use GuzzleHttp\Client;

class Requests
{

    protected $configuration;

    function __construct(
        \Actions\Availability $configuration
    )
    {
        $this->configuration = $configuration;
    }


}