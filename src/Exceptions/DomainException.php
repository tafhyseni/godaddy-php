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
        return new static("Authorization failed. Check your secret/api keys.");
    }

    public static function noDomainProvided(): self
    {
        return new static('Domain name is required and cannot be empty!');
    }

    public static function noKeywordProvided(): self
    {
        return new static('No keyword has been specified!');
    }

}