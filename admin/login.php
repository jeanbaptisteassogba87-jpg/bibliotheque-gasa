<?php
session_start();
require_once '../config.php';

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id']  = $admin['id'];
        $_SESSION['admin_nom'] = $admin['nom'];
        header("Location: dashboard.php");
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Bibliothèque GASA</title>
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body class="login-body">

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
                <input type="password" id="mot_de_passe" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <div class="back-link">
            <a href="../index.php">← Retour au site</a>
        </div>
    </div>

</body>
</html>