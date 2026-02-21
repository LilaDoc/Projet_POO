<?php

namespace App\Service;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getUserByUsername(string $username): ?User
    {
                return $this->userRepository->getByUsername($username);
    }

    public function getRoleByUsername(string $username): ?string
    {
        $user = $this->userRepository->getByUsername($username);
        if ($user) {
            return $user->getRole();  // Accès via le getter
        }
        return null;
    }
}