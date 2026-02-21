<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\TicketController;

// Point d'entrée de l'application
$controller = new TicketController();
$controller->getTicket();
