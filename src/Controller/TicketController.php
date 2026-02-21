<?php

namespace App\Controller;

use App\Core\View;
use App\Service\TicketService;
use App\Service\UserService;

class TicketController
{
    private TicketService $ticketService;
    private UserService $userService;

    public function __construct()
    {
        $this->ticketService = new TicketService();
        $this->userService = new UserService();
    }

    public function getTicket()
    {
        // Vérifier si l'utilisateur est connecté
        session_start();
        $username = $_SESSION['username'] ?? null;

        if (!$username) {
            // Rediriger vers login si non connecté
            header('Location: ?action=login');
            exit;
        }

        // Récupérer l'utilisateur et son rôle
        $user = $this->userService->getUserByUsername($username);
        $role = $user->getRole();

        // Récupérer les tickets selon le rôle
        if ($role === 'client') {
            // Client = seulement ses tickets
            $tickets = $this->ticketService->getTicketsByUser($user->getId());
        } else {
            // Chef de projet / Développeur = tous les tickets
            $tickets = $this->ticketService->getTickets();
        }

        // Affichage via la vue
        $view = new View();
        $view->render('tickets/index', ['tickets' => $tickets, 'user' => $user]);
    }
    public function getTicketById(int $id)
    {
        // Récupération du ticket depuis le service
        $ticket = $this->ticketService->getTicketById($id);

        // Affichage via la vue
        $view = new View();
        $view->render('tickets/show', ['ticket' => $ticket]);
    }
}
