<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\TicketController;
use App\Controller\UserController;

// Point d'entrée de l'application
$TicketController = new TicketController();
$UserController = new UserController();

// Routage simple basé sur le paramètre 'action' -> le defaut est la page de login
$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'show':
        $id = (int) ($_GET['id'] ?? 0);
        $TicketController->getTicketById($id);
        break;
    
    case 'index':
        $TicketController->getTicket();
        break;

    case 'create':
        $TicketController->createTicket();
        break;

    case 'login':
        $UserController->login();  // Gère GET (affiche formulaire) et POST (traite login)
        break;

    case 'logout':
        $UserController->logout();
        break;

    default:
        $UserController->getLoginPage();
        break;
} 
