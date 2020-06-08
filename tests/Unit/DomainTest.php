<?php

namespace Tafhyseni\PhpGodaddy\Tests;

use PHPUnit\Framework\TestCase;
use Tafhyseni\PhpGodaddy\Exceptions\DomainException;

class DomainTest extends TestCase
{
    /** @test */
    public function it_throws_api_exception()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('API Key has not been provided!');
        $this->expectExceptionCode(401);

        throw DomainException::noApiKeyProvided();
    }

    /** @test */
    public function it_parses_domain()
    {
        $registrableDomain = \Tafhyseni\PhpGodaddy\Actions\MyDomain::parse('http://www.mybestdomain.com')->getRegistrableDomain();
        $this->assertEquals('mybestdomain.com', $registrableDomain);
    }
}