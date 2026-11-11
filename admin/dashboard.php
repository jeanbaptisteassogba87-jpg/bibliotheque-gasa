<?php
require_once '../includes/auth.php';

$nb_livres   = $pdo->query("SELECT COUNT(*) FROM livres")->fetchColumn();
$nb_membres  = $pdo->query("SELECT COUNT(*) FROM membres")->fetchColumn();
$nb_emprunts = $pdo->query("SELECT COUNT(*) FROM emprunts WHERE date_retour IS NULL")->fetchColumn();

$derniers = $pdo->query("SELECT titre, auteur, annee FROM livres ORDER BY id_livre DESC LIMIT 5")
                ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - GASA Admin</title>
    <!-- Icônes Google Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body class="admin-body">

    <?php $page_active = 'dashboard'; include '../includes/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <main class="admin-main">

        <!-- TOPBAR -->
        <header class="admin-topbar">
            <div class="search-bar">
                <span class="material-symbols-outlined search-icon">search</span>
                <input type="text" placeholder="Search Anything">
            </div>
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <span class="user-name"><?= htmlspecialchars($_SESSION['admin_nom'] ?? 'Admin') ?></span>
                    <span class="user-role">Admin</span>
                </div>
            </div>
        </header>

        <div class="page-header">
            <h1>Dashboard</h1>
            <p>Bienvenue sur votre espace de gestion.</p>
        </div>

        <!-- STATS CARDS -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">LIVRES AU CATALOGUE</span>
                    <span class="stat-icon blue"><span class="material-symbols-outlined">library_books</span></span>
                </div>
                <div class="stat-value"><?= $nb_livres ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">MEMBRES INSCRITS</span>
                    <span class="stat-icon yellow"><span class="material-symbols-outlined">person_add</span></span>
                </div>
                <div class="stat-value"><?= $nb_membres ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">EMPRUNTS EN COURS</span>
                    <span class="stat-icon light-blue"><span class="material-symbols-outlined">sync</span></span>
                </div>
                <div class="stat-value"><?= $nb_emprunts ?></div>
            </div>
        </div>

        <!-- TABLEAU : derniers livres ajoutés -->
        <div class="table-panel">
            <div class="panel-header">
                <h2>Derniers livres ajoutés</h2>
                <a href="livres.php" class="view-all">Voir tout</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>TITRE</th>
                        <th>AUTEUR</th>
                        <th>ANNÉE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($derniers as $livre): ?>
                        <tr>
                            <td><?= htmlspecialchars($livre['titre']) ?></td>
                            <td><?= htmlspecialchars($livre['auteur']) ?></td>
                            <td><?= htmlspecialchars($livre['annee']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>