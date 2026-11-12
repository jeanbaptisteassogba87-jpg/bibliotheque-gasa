<?php
session_start();
require_once '../config.php';

$erreur = '';
$email  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

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
    <title>Connexion - Bibliothèque GASA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body class="login-page">   

    <main class="login-card">
        <img src="../assets/images/logo-gasa.jpeg" alt="Logo UATM GASA" class="login-logo">
        <h2>Connexion</h2>
        <p class="login-intro">Espace administrateur · Bibliothèque UATM GASA</p>

        <?php if ($erreur): ?>
            <div class="login-error"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="field">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" placeholder="admin@gasa.com"
                       value="<?= htmlspecialchars($email) ?>" required autofocus>
            </div>

            <div class="field">
                <label for="mot_de_passe">Mot de passe</label>
                <div class="input-wrap">
                    <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required>
                    <button type="button" class="toggle-password" id="togglePassword" aria-label="Afficher le mot de passe">
                        <span class="material-symbols-outlined" id="toggleIcon">visibility</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="login-btn">Se connecter</button>
        </form>

        <a href="../index.php" class="login-back">← Retour au site</a>
    </main>
    <p class="login-footer">© <?= date('Y') ?> Bibliothèque UATM GASA Formation</p>
    <script>
        const champ  = document.getElementById('mot_de_passe');
        const bouton = document.getElementById('togglePassword');
        const icone  = document.getElementById('toggleIcon');

        bouton.addEventListener('click', function () {
            const estCache = champ.type === 'password';
            champ.type = estCache ? 'text' : 'password';
            icone.textContent = estCache ? 'visibility_off' : 'visibility';
        });
    </script>
</body>
</html>