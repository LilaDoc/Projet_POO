<?php

namespace App\Domain\Entity;

use DateTime;

class Ticket
{    
    private int $idTicket;
    private string $title;
    private string $description;
    private string $status;
    private string $priority;
    private DateTime $createdAt;
    private array $comments;
    private int $userId;
    private int $assignedTo;

    public function __construct(
        $title,
        $description,
        $status,
        $priority,
        $createdAt,
        $userId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->createdAt = $createdAt;
        $this->userId = $userId;
        $this->assignedTo = 0;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTicketID(): int
    {
        return $this->idTicket;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    
    public function getPriority(): string
    {
        return $this->priority;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function getAssignedTo(): int
    {
        return $this->assignedTo;
    }

     public function getUserId(): int
    {
        return $this->userId;
    }

    public function setIdTicket($idTicket) {
        $this->idTicket = $idTicket;
    }

    public function setComments($comments) {
        $this->comments = $comments;
    }

    public function setAssignedTo($userId) {
        $this->assignedTo = $$userId;
    }
}
