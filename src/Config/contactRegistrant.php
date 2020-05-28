<?php


namespace Tafhyseni\PhpGodaddy\Config;


class ContactRegistrant
{
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $organization;
    public $addressMailing;

    /**
     * @param mixed $name
     * @return contactRegistrant
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $surname
     * @return contactRegistrant
     */
    public function setSurname($surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @param mixed $email
     * @return contactRegistrant
     */
    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param mixed $phone
     * @return contactRegistrant
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param mixed $organization
     * @return contactRegistrant
     */
    public function setOrganization($organization): self
    {
        $this->organization = $organization;
        return $this;
    }

    /**
     * @param mixed $addressMailing
     * @return contactRegistrant
     */
    public function setAddressMailing($addressMailing): self
    {
        $this->addressMailing = (new ContactAddress())
                        ->setAddress('Address')
                        ->setCity('City')
                        ->setCountry('US')
                        ->setPostalCode('60669')
                        ->setState('IL');
        return $this;
    }
}