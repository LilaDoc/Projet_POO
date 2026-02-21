<?php
namespace App\Controller;

use App\Core\View;
use App\Service\UserService;

final class UserController 
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getLoginPage(): void
    {
        $view = new View();
        $view->render('User/login');
    }

    public function login(): void
    {
        // Vérifier si c'est une requête POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->getLoginPage();
            return;
        }

        // Récupérer le username du formulaire
        $username = $_POST['username'] ?? '';

        if (empty($username)) {
            $view = new View();
            $view->render('User/login', ['error' => 'Veuillez entrer un nom d\'utilisateur']);
            return;
        }

        // Vérifier que l'utilisateur existe
        $user = $this->userService->getUserByUsername($username);

        if (!$user) {
            $view = new View();
            $view->render('User/login', ['error' => 'Utilisateur non trouvé']);
            return;
        }

        // Créer la session pour stocker les informations de l'utilisateur
        session_start();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['role'] = $user->getRole();

        // Rediriger vers la liste des tickets
        header('Location: ?action=index');
        exit;
    }

    public function logout(): void
    {
        session_start();
        session_destroy();
        header('Location: ?action=login');
        exit;
    }
}
