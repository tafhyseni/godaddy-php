<?php

namespace Tafhyseni\PhpGodaddy\Config;

class contactAddress
{
    public $address1;
    public $city;
    public $country;
    public $postalCode;
    public $state;

    /**
     * @param mixed $address
     * @return contactAddress
     */
    public function setAddress($address)
    {
        $this->address1 = $address;

        return $this;
    }

    /**
     * @param mixed $city
     * @return contactAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param mixed $country
     * @return contactAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param mixed $postalCode
     * @return contactAddress
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @param mixed $state
     * @return contactAddress
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}
