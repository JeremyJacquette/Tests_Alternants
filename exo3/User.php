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

    function getFirstname(): string
    {
        return $this->firstname;
    }

    function getLastname(): string
    {
        return $this->lastname;
    }

    function getMailAddress(): string
    {
        return $this->mailAddress;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }
}