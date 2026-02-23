<?php

namespace App\Infrastructure;

use App\Domain\Entity\Ticket;
use App\Domain\Entity\Comment;
use DateTime;

class TicketFactory {

    public static function fromRows(array $ticket, array $comments): Ticket {
        
        $tmp_ticket = new Ticket(
            $ticket["title"],
            $ticket["description"],
            $ticket["status"],
            $ticket["priority"],
            new Datetime($ticket["created_at"]),
            $ticket["user_id"]
        );
        $tmp_ticket->setIdTicket($ticket["id"]);
        $tmp_ticket->setAssignedTo($ticket["assigned_to"] ?? 0);

        $tmp_comments = [];
        foreach($comments as $comment) {
            $tmp_comments[] = new Comment(
                $comment["id"],
                $comment["ticket_id"],
                $comment["author"],
                $comment["body"],
                new Datetime($comment["created_at"])
            );
        }
        $tmp_ticket->setComments($tmp_comments);
        return $tmp_ticket;
    }
}
?>