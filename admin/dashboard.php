<?php
require_once '../includes/auth.php';

// ---------- Statistiques ----------
$nb_livres   = $pdo->query("SELECT COUNT(*) FROM livres")->fetchColumn();
$nb_membres  = $pdo->query("SELECT COUNT(*) FROM membres")->fetchColumn();
$nb_emprunts = $pdo->query("SELECT COUNT(*) FROM emprunts WHERE date_retour IS NULL")->fetchColumn();
$nb_retards  = $pdo->query("SELECT COUNT(*) FROM emprunts WHERE date_retour IS NULL AND date_prevue < CURDATE()")->fetchColumn();

// ---------- Derniers emprunts (avec le titre du livre et le nom du membre) ----------
$derniers_emprunts = $pdo->query(
    "SELECT e.date_emprunt, e.date_prevue, e.date_retour, l.titre, m.nom
     FROM emprunts e
     JOIN livres l  ON l.id_livre  = e.id_livre
     JOIN membres m ON m.id_membre = e.id_membre
     ORDER BY e.id_emprunt DESC
     LIMIT 5"
)->fetchAll(PDO::FETCH_ASSOC);

// ---------- Derniers livres ----------
$derniers_livres = $pdo->query(
    "SELECT titre, auteur, annee, couverture FROM livres ORDER BY id_livre DESC LIMIT 5"
)->fetchAll(PDO::FETCH_ASSOC);

// Statut d'un emprunt : retourné / en retard / en cours
function statut_emprunt($e) {
    if ($e['date_retour'] !== null) return ['Retourné', 'gris'];
    if ($e['date_prevue'] < date('Y-m-d')) return ['En retard', 'rouge'];
    return ['En cours', 'jaune'];
}

$page_active = 'dashboard';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Bibliothèque GASA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body class="admin-body">

    <?php include '../includes/sidebar.php'; ?>

    <main class="main">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-head">
            <div>
                <h1>Tableau de bord</h1>
                <p>Suivez l'activité de la bibliothèque en un coup d'œil.</p>
            </div>
            <div class="page-actions">
                <a href="ajouter_livre.php" class="btn btn-primary">
                    <span class="material-symbols-outlined">add</span> Ajouter un livre
                </a>
                <a href="emprunts.php" class="btn btn-secondary">Voir les emprunts</a>
            </div>
        </div>

        <!-- STATISTIQUES -->
        <section class="stats">
            <div class="stat">
                <span class="stat-icon bleu"><span class="material-symbols-outlined">library_books</span></span>
                <div>
                    <div class="stat-label">Livres au catalogue</div>
                    <div class="stat-value"><?= $nb_livres ?></div>
                </div>
            </div>
            <div class="stat">
                <span class="stat-icon jaune"><span class="material-symbols-outlined">group</span></span>
                <div>
                    <div class="stat-label">Membres inscrits</div>
                    <div class="stat-value"><?= $nb_membres ?></div>
                </div>
            </div>
            <div class="stat">
                <span class="stat-icon bleu"><span class="material-symbols-outlined">swap_horiz</span></span>
                <div>
                    <div class="stat-label">Emprunts en cours</div>
                    <div class="stat-value"><?= $nb_emprunts ?></div>
                </div>
            </div>
            <div class="stat <?= $nb_retards > 0 ? 'stat-alerte' : '' ?>">
                <span class="stat-icon rouge"><span class="material-symbols-outlined">schedule</span></span>
                <div>
                    <div class="stat-label">Retours en retard</div>
                    <div class="stat-value"><?= $nb_retards ?></div>
                </div>
            </div>
        </section>

        <!-- PANNEAUX -->
        <section class="panels">
            <div class="panel">
                <div class="panel-head">
                    <h2>Derniers emprunts</h2>
                    <a href="emprunts.php" class="link">Tout voir</a>
                </div>
                <table class="table">
                    <thead>
                        <tr><th>Livre</th><th>Membre</th><th>Retour prévu</th><th>Statut</th></tr>
                    </thead>
                    <tbody>
                        <?php if (count($derniers_emprunts) > 0): ?>
                            <?php foreach ($derniers_emprunts as $e): ?>
                                <?php [$libelle, $couleur] = statut_emprunt($e); ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($e['titre']) ?></strong></td>
                                    <td><?= htmlspecialchars($e['nom']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($e['date_prevue'])) ?></td>
                                    <td><span class="badge <?= $couleur ?>"><?= $libelle ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="empty">Aucun emprunt pour l'instant. Les nouveaux emprunts apparaîtront ici.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="panel">
                <div class="panel-head">
                    <h2>Derniers livres ajoutés</h2>
                    <a href="livres.php" class="link">Tout voir</a>
                </div>
                <ul class="book-list">
                    <?php foreach ($derniers_livres as $l): ?>
                        <li>
                            <span class="thumb">
                                <img src="../assets/images/<?= htmlspecialchars($l['couverture']) ?>" alt=""
                                     onerror="this.style.visibility='hidden'">
                            </span>
                            <div>
                                <strong><?= htmlspecialchars($l['titre']) ?></strong>
                                <small><?= htmlspecialchars($l['auteur']) ?>, <?= htmlspecialchars($l['annee']) ?></small>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

        <footer class="admin-footer">© <?= date('Y') ?> Bibliothèque UATM GASA Formation</footer>
    </main>

</body>
</html>