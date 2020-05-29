<?php


namespace Tafhyseni\PhpGodaddy\Config;


class ContactRegistrant
{
    public $nameFirst;
    public $nameLast;
    public $email;
    public $phone;
    public $organization;
    public $addressMailing;

    /**
     * @param array $options
     * @return ContactRegistrant
     */
    public function setData(array $options): self
    {
        $this->nameFirst = $options['name'];
        $this->nameLast = $options['surname'];
        $this->email = $options['email'];
        $this->phone = $options['phone'];
        $this->organization = $options['organization'] ?? '';

        return $this;
    }

    /**
     * @param $options
     * @return contactRegistrant
     */
    public function setAddressMailing($options): self
    {
        $this->addressMailing = (new ContactAddress())
                        ->setAddress($options['street'])
                        ->setCity($options['city'])
                        ->setCountry($options['country'])
                        ->setPostalCode($options['postalCode'])
                        ->setState($options['state']);
        return $this;
    }
}