<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Bibliothèque GASA</title>
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

    <div class="login-box">
        <h2>Espace Administrateur</h2>
        <p class="subtitle">Bibliothèque UATM GASA</p>

        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" id="email" name="email" placeholder="ex: admin@gasa.com" required>
            </div>
            
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <div class="back-link">
            <a href="../index.php">← Retour au site</a>
        </div>
    </div>

</body>
</html>