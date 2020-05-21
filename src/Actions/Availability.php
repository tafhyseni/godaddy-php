<?php

namespace Tafhyseni\PhpGodaddy\Actions;

class Availability extends \Request\Requests
{
   private $domain;

   public function setDomain(string $domain)
   {
      $this->domain = $domain;
   }
}
