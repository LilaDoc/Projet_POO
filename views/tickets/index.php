<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tickets</title>
</head>
<body>
    <h1>Liste des Tickets</h1>
    
    <h2>Créer un nouveau ticket</h2>
    <form method="post" action="?action=create">
        <label for="title">Titre :</label><br>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
        
        <label for="priority">Priorité :</label><br>
        <select id="priority" name="priority" required>
            <option value="Basse">Basse</option>
            <option value="Moyenne" selected>Moyenne</option>
            <option value="Haute">Haute</option>
        </select><br><br>
        
        <button type="submit">Créer le ticket</button>
    </form>
    
    <hr>
    
    <?php if (!empty($tickets)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Statut</th>
                    <th>Priorité</th>
                    <th>Créé par</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?= htmlspecialchars($ticket->getId()) ?></td>
                        <td><?= htmlspecialchars($ticket->getTitle()) ?></td>
                        <td><?= htmlspecialchars($ticket->getStatus()) ?></td>
                        <td><?= htmlspecialchars($ticket->getPriority()) ?></td>
                        <td><?= htmlspecialchars($ticket->getCreatedBy()) ?></td>
                        <td><?= htmlspecialchars($ticket->getCreatedAt()) ?></td>
                        <td>
                            <a href="?action=show&id=<?= $ticket->getId() ?>">Voir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun ticket disponible.</p>
    <?php endif; ?>
</body>
</html>

