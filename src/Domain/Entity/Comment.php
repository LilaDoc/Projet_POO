<?php

namespace App\Domain\Entity;

class Comment
{   private int $id_comment;
    private int $id_ticket;
    private int $id_user;
    public string $body;
    public \DateTime $created_at;

    public function __construct($id_comment, $id_ticket, $id_user, $body, $created_at)
    {
        $this->id_comment = $id_comment;
        $this->id_ticket = $id_ticket;
        $this->id_user = $id_user;
        $this->body = $body;
        $this->created_at = $created_at;
    }

    public function getCommentID(): int
    {
        return $this->id_comment;
    }

    public function getTicketID(): int
    {
        return $this->id_ticket;
    }

    public function getUserID(): int
    {
        return $this->id_user;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }
}
