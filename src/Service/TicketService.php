<?php

namespace App\Service;

use App\Domain\Entity\Ticket;
use App\Repository\TicketRepository;
use App\Infrastructure\DbConnection;

class TicketService
{
    private TicketRepository $ticketRepository;

    public function __construct()
    {
        $this->ticketRepository = new TicketRepository(DbConnection::getInstance()->getPdo());
    }

    /**
     * Récupère tous les tickets
     * @return Ticket[]
     */
    public function getTickets(): array
    {
        return $this->ticketRepository->findAll();
    }
    public function getTicketById(int $id): ?Ticket
    {
        return $this->ticketRepository->findById($id);
    }
    public function createTicket(array $data): array
    {
        $ticket = new Ticket(
            $data['title'],
            $data['description'],
            $data['status'],
            $data['priority'],
            $data['created_at'],
            $data['created_by']
        );
        $ticket->setAssignedTo($data['assigned_to'] ?? null);
        return $this->ticketRepository->save($ticket);
    }

    /**
     * Récupère les tickets d'un utilisateur
     * @return Ticket[]
     */
    public function getTicketsByUser(int $userId): array
    {
        return $this->ticketRepository->findAllByUserId($userId);
    }
}