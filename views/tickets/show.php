<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du Ticket</title>
</head>
<body>
    <h1>Détail du Ticket</h1>
    
    <p><strong>ID:</strong> <?= htmlspecialchars($ticket->getId()) ?></p>
    <p><strong>Titre:</strong> <?= htmlspecialchars($ticket->getTitle()) ?></p>
    <p><strong>Statut:</strong> <?= htmlspecialchars($ticket->getStatus()) ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($ticket->getDescription()) ?></p>
    <p><strong>Priorité:</strong> <?= htmlspecialchars($ticket->getPriority()) ?></p>
    <p><strong>Créé par:</strong> <?= htmlspecialchars($ticket->getCreatedBy()) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($ticket->getCreatedAt()) ?></p>
    
    <a href="/">Retour à la liste</a>
</body>
</html>
