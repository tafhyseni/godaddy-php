<?php


namespace Tafhyseni\PhpGodaddy\Actions;


class Purchase extends Request
{
    // Required
    public $consent;

    public $contactAdmin;
    public $contactBilling;
    public $contactRegistrant;
    public $contactTech;

    // required
    public $domain;

    public $nameServers;

    // default: 1, maximum: 10, minimum 1.
    public $period;

    // boolean, default: false
    public $privacy;
    // boolean, default: true
    public $renewAuto;

    /**
     * Returns user agreement contract
     */
    protected function getAgreement()
    {

    }



}