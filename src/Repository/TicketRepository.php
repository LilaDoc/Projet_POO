<?php

namespace App\Repository;

use PDO;
use App\Infrastructure\TicketFactory;

class TicketRepository
{    
    private static $tableName = "tickets";
    private PDO $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function save($ticket) {

        $sql = "INSERT INTO " . self::$tableName . " (user_id, title, description, status, priority, created_at, assigned_to)
            VALUES (:user_id, :title, :description, :status, :priority, :created_at, :assigned_to)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(
            [
                "user_id" => $ticket->getUserId(),
                "assigned_to" => $ticket->getAssignedTo(),
                "title" =>  $ticket->getTitle(),
                "description" => $ticket->getDescription(),
                "status" => $ticket->getStatus(),
                "priority" => $ticket->getPriority(),
                "created_at" => $ticket->getCreatedAt()->format('Y-m-d H:i:s')
            ]
        );
        return $this->findAll();
    }

    public function saveTicketClient($ticket) {

        $sql = "INSERT INTO " . self::$tableName . " (user_id, title, description, status, priority, created_at, assigned_to)
            VALUES (:user_id, :title, :description, :status, :priority, :created_at, :assigned_to)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(
            [
                "user_id" => $ticket->getUserId(),
                "assigned_to" => $ticket->getAssignedTo(),
                "title" =>  $ticket->getTitle(),
                "description" => $ticket->getDescription(),
                "status" => $ticket->getStatus(),
                "priority" => $ticket->getPriority(),
                "created_at" => $ticket->getCreatedAt()->format('Y-m-d H:i:s')
            ]
        );
        return $this->findAllByUserId($ticket->getUserId());
    }

    public function assignUserToTicket($userId, $ticketId) {
        
        $sql = "UPDATE " . self::$tableName . " SET assigned_to = :assigned_to WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(
            [
                "assigned_to" => $userId,
                "id" => $ticketId
            ]
        );
        return $this->findById($ticketId);
    }

    //retourne un ticket
    public function findById($ticketId) {
        
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(
            [
                "id" => $ticketId
            ]
        );

        $sql_comments = "SELECT * FROM comments WHERE ticket_id = :ticket_id";
        $stmt_comments = $this->db->prepare($sql_comments);
        $stmt_comments->execute(
            [
                "ticket_id" => $ticketId
            ]
        );
        return TicketFactory::fromRows($stmt->fetch(), $stmt_comments->fetchAll());
    }

    //retourne un tableau de tickets
    public function findAll() {

        $sql = "SELECT * FROM " . self::$tableName;

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $sql_comments = "SELECT * FROM comments";
        $stmt_comments = $this->db->prepare($sql_comments);
        $stmt_comments->execute();
        
        // Regroupe par ticket_id
        $commentsByTicket = [];
        foreach ($stmt_comments->fetchAll() as $comment) {
            $commentsByTicket[$comment["ticket_id"]][] = $comment;
        }

        $tickets = [];
        foreach ($stmt->fetchAll() as $ticket) {
            $comments = $commentsByTicket[$ticket["id"]] ?? [];
            $tickets[] = TicketFactory::fromRows($ticket, $comments);
        }
        
        return $tickets;
    }

    //return un tableau de tickets d'un client
    public function findAllByUserId($userId) {
        
        $sql = "SELECT * FROM " . self::$tableName . " WHERE user_id = :user_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(
            [
                "user_id" => $userId
            ]
        );
        

        $sql_comments = "SELECT * FROM comments";
        $stmt_comments = $this->db->prepare($sql_comments);
        $stmt_comments->execute();
        
        // Regroupe par ticket_id
        $commentsByTicket = [];
        foreach ($stmt_comments->fetchAll() as $comment) {
            $commentsByTicket[$comment["ticket_id"]][] = $comment;
        }

        $tickets = [];
        foreach ($stmt->fetchAll() as $ticket) {
            $comments = $commentsByTicket[$ticket["id"]] ?? [];
            $tickets[] = TicketFactory::fromRows($ticket, $comments);
        }
        return $tickets;
    }
}
?>
