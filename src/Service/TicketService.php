<?php

namespace App\Service;

use App\Domain\Entity\Ticket;
use App\Domain\Repository\TicketRepository;

class TicketService
{
    private TicketRepository $ticketRepository;

    public function __construct()
    {
        $this->ticketRepository = new TicketRepository();
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
    public function createTicket(array $data): Ticket
    {
        return $this->ticketRepository->save(
            $data['id'],
            $data['title'],
            $data['status'],
            $data['description'],
            $data['priority'],
            $data['created_at'],
            $data['created_by'],
            $data['assigned_to'] ?? null
        );
    }

    /**
     * Récupère les tickets d'un utilisateur
     * @return Ticket[]
     */
    public function getTicketsByUser(int $userId): array
    {
        return $this->ticketRepository->findByUser((string) $userId);
    }
}