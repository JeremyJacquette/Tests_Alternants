<?php

class User
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $mailAddress;
    private string $fullname;

    public function __construct(string $firstname, string $lastname ,string $mailAddress)
    {  
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->mailAddress = $mailAddress;
        $this->fullname = $firstname.''.$lastname;
    }

    function getId(): int
    {
        return $this->id;
    }

    function getFirstname(): int
    {
        return $this->firstname;
    }

    function getLastname(){
        return $this->lastname;
    }

    function getMailAddress()
    {
        return $this->mailAddress;
    }

    public function getFullname()
    {
        return $this->fullname;
    }
}