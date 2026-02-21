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

    public function createTicket()
    {
        session_start();
        $username = $_SESSION['username'] ?? null;

        if (!$username) {
            header('Location: ?action=login');
            exit;
        }

        // Vérifier que c'est une requête POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?action=index');
            exit;
        }

        // Récupérer les données du formulaire
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $priority = $_POST['priority'] ?? 'Moyenne';

        // Récupérer l'utilisateur connecté
        $user = $this->userService->getUserByUsername($username);

        // Préparer les données pour le service
        $data = [
            'id' => time(),  // ID temporaire basé sur le timestamp
            'title' => $title,
            'status' => 'Ouvert',
            'description' => $description,
            'priority' => $priority,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user->getId()
        ];

        // Créer le ticket via le service
        $this->ticketService->createTicket($data);

        // Rediriger vers la liste
        header('Location: ?action=index');
        exit;
    }
}
