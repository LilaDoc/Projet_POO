<?php

namespace App\Domain\Entity;

class Ticket
{   public function __construct(
        private int $id_ticket,
        public string $title,
        public string $description,
        private string $status,

    ){
        
    }

    public function saveTicket(): void
    {
        // Code to save the ticket to the database
    }

    public function writeDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }



}
