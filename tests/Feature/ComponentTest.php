<?php

namespace Tafhyseni\PhpGodaddy\Tests;

use Tafhyseni\PhpGodaddy\Domain;
use Tafhyseni\PhpGodaddy\Exceptions\DomainException;

it('throws custom exception', function() {
   throw DomainException::invalidDomainPeriod();
})->throws(DomainException::class);

test('no api key custom exception', function () {
    $this->expectException(DomainException::class);
    $this->expectExceptionMessage('API Key has not been provided!');

    throw DomainException::noApiKeyProvided();
});

it('parses domain', function () {
    $registrableDomain = \Tafhyseni\PhpGodaddy\Actions\MyDomain::parse('http://www.mybestdomain.com')->getRegistrableDomain();
    assertEquals('mybestdomain.com', $registrableDomain);

});