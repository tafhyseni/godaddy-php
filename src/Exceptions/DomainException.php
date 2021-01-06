<?php

namespace Tafhyseni\PhpGodaddy\Exceptions;

use Exception;

class DomainException extends Exception
{
    public static function noApiKeyProvided(): self
    {
        return new static('API Key has not been provided!', 401);
    }

    public static function noSecretKeyProvided(): self
    {
        return new static('Secret Key has not been provided!', 401);
    }

    public static function authorizationFailed(): self
    {
        return new static('Authorization failed. Check your secret/api keys.',401);
    }

    public static function noDomainProvided(): self
    {
        return new static('Domain name is required and cannot be empty!', 400);
    }

    public static function noKeywordProvided(): self
    {
        return new static('No keyword has been specified!', 400);
    }

    public static function invalidDomainPeriod(): self
    {
        return new static('Domain period should be within 1 and 10 range', 400);
    }

    public static function domainNotAvailable(): self
    {
        return new static('Domain is not available for registration', 404);
    }

    public static function invalidPaymentInfo(): self
    {
        return new static('Invalid payment information provided at your API account!', 403);
    }

    public static function invalidRecordType(): self
    {
        return new static('Record type is invalid. Available types are: A, AAA, CNAME, MX, NS, SRV, TXT', 400);
    }

    public static function recordDomainNotFound(): self
    {
        return new static ('Given domain has not been found or is not registered');
    }
}
