<?php


class User
{

    private $usr_id;
    private $usr_voornaam;
    private $usr_naam;
    private $usr_email;

    public function getUsrId()
    {
        return $this->usr_id;
    }

    public function setUsrId($usr_id): void
    {
        $this->usr_id = $usr_id;
    }

    public function getUsrVoornaam()
    {
        return $this->usr_voornaam;
    }

    public function setUsrVoornaam($usr_voornaam): void
    {
        $this->usr_voornaam = $usr_voornaam;
    }

    public function getUsrNaam()
    {
        return $this->usr_naam;
    }

    public function setUsrNaam($usr_naam): void
    {
        $this->usr_naam = $usr_naam;
    }

    public function getUsrEmail()
    {
        return $this->usr_email;
    }

    public function setUsrEmail($usr_email): void
    {
        $this->usr_email = $usr_email;
    }



}