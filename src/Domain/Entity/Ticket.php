<?php

namespace App\Domain\Entity;

use DateTime;

class Ticket
{    
    private int $id_ticket;
    private string $title;
    private string $description;
    private string $status;
    private string $priority;
    public DateTime $created_at;
    public array $comments;

    public function __construct($id_ticket,$title,$description,$status,$priority,$created_at,$comments)
    {
        $this->id_ticket = $id_ticket;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->created_at = new DateTime();
        $this->comments = $comments;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTicketID(): int
    {
        return $this->id_ticket;
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

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

}
