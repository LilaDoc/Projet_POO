<?php

namespace App\Controller;

use App\Core\View;

class TicketController
{
    public function getTicket()
    {
        //a ce stade on est sensé recupéré les tickets depuis serviceTicket et les envoyer a la vue
    
        // Simulons la récupération des tickets depuis un service
        $tickets = [
            ['id' => 1,
            'title' => 'Problème de connexion',
            'status' => 'Ouvert',
            'description' => 'Je ne peux pas me connecter à mon compte.',
            'priority' => 'Haute',
            'created_at' => '2024-06-01 10:00:00',
            'created_by' => 'John Doe'
            ],
            ['id' => 2, 'title' => 'Problème de paiement', 
            'status' => 'Fermé',
            'description' => 'Je ne peux pas effectuer de paiement.',
            'priority' => 'Moyenne',
            'created_at' => '2024-06-02 14:30:00',
            'created_by' => 'Jane Smith'
            ]
        ];

        // On appel la classe view pour afficher les tickets
        $view = new View();
        $view->render('tickets/index', ['tickets' => $tickets]);
    }
}
