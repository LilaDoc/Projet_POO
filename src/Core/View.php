<?php

namespace App\Core;

class View
{
    public function render($view, $data = [])
    {
        // Extraire les données pour les rendre disponibles dans la vue
        extract($data);
        
        // Inclure la vue (chemin absolu depuis la racine du projet)
        $path = dirname(__DIR__, 2) . "/views/{$view}.php";
        include $path;
    }
}
