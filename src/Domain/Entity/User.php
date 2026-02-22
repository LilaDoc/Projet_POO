<?php
namespace App\Domain\Entity;

class User
{       
    private int $id_user;
    private string $username;
    private string $roles;

    public function __construct($id_user, $id_ticket, $username, $roles)
    {
        $this->id_user = $id_user;
        $this->username = $username;
        $this->roles = $roles;
    }
        public function getUserID(): int
    {
        return $this->id_user;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRoles(): string
    {
        return $this->roles;
    }
}