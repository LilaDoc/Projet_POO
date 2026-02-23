<?php

namespace App\Domain\Entity;

class Comment
{   private int $id_comment;
    private int $id_ticket;
    private string $author;
    public string $body;
    public \DateTime $created_at;

    public function __construct($id_comment, $id_ticket, $author, $body, $created_at)
    {
        $this->id_comment = $id_comment;
        $this->id_ticket = $id_ticket;
        $this->author = $author;
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

    public function getAuthor(): string
    {
        return $this->author;
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
