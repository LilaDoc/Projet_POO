<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4a90a4;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .status-ouvert {
            color: #28a745;
            font-weight: bold;
        }
        .status-ferme {
            color: #dc3545;
            font-weight: bold;
        }
        .priority-haute {
            color: #dc3545;
        }
        .priority-moyenne {
            color: #ffc107;
        }
        .priority-basse {
            color: #28a745;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-view {
            background-color: #007bff;
            color: white;
        }
        .btn-view:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Liste des Tickets</h1>
    
    <?php if (!empty($tickets)): ?>
        <table>
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
                        <td><?= htmlspecialchars($ticket['id']) ?></td>
                        <td><?= htmlspecialchars($ticket['title']) ?></td>
                        <td class="status-<?= strtolower($ticket['status']) === 'ouvert' ? 'ouvert' : 'ferme' ?>">
                            <?= htmlspecialchars($ticket['status']) ?>
                        </td>
                        <td class="priority-<?= strtolower($ticket['priority']) ?>">
                            <?= htmlspecialchars($ticket['priority']) ?>
                        </td>
                        <td><?= htmlspecialchars($ticket['created_by']) ?></td>
                        <td><?= htmlspecialchars($ticket['created_at']) ?></td>
                        <td>
                            <a href="?action=show&id=<?= $ticket['id'] ?>" class="btn btn-view">Voir</a>
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

