<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    
    <form method="post" action="?action=login">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
