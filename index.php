<?php
require_once 'config.php';

$stmt_cat = $pdo->query("SELECT DISTINCT categorie FROM livres ORDER BY categorie");
$categories = $stmt_cat->fetchAll(PDO::FETCH_COLUMN);

$categorie_filtre = isset($_GET['categorie']) ? $_GET['categorie'] : 'Tous';

if ($categorie_filtre === 'Tous') {
    $stmt = $pdo->query("SELECT * FROM livres ORDER BY titre");
} else {
    $stmt = $pdo->prepare("SELECT * FROM livres WHERE categorie = ? ORDER BY titre");
    $stmt->execute([$categorie_filtre]);
}
$livres = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bibliothèque universitaire de l'UATM GASA Formation - Ressources documentaires et pédagogiques.">
    <title>Bibliothèque UATM GASA Formation</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <header class="site-header" id="navbar">
        <nav class="navbar">
            <div class="logos">
                <img src="assets/images/logo-gasa.jpeg" id="img" alt="Logo UATM GASA">
            </div>
            <div class="nav-actions">
                <a href="admin/login.php" class="btn-admin">Espace Admin</a>
            </div>
        </nav>
    </header>

    <main>
        <section id="hero">
            <div class="hero-content">
                <h1>La Bibliothèque universitaire de l’UATM GASA Formation est plus proche de vous.</h1>
                <p>
                    La Bibliothèque universitaire de l’UATM GASA Formation met à votre disposition 
                    des ressources documentaires et pédagogiques pour faciliter l’accès au savoir, 
                    accompagner la réussite académique des étudiants et soutenir les activités 
                    de recherche des enseignants.
                </p>
                <button type="button" class="btn-main">Faire une demande</button>
            </div>
        </section>

        <section class="comment-emprunter">
            <div class="section-header">
                <span class="subtitle-top">Guide d'utilisation</span>
                <h2>Comment emprunter ?</h2>
                <p>Trois étapes simples pour profiter de nos ressources.</p>
            </div>

            <div class="cards-container">
                <div class="card">
                    <div class="card-number">01</div>
                    <h3>Cherchez</h3>
                    <p>Parcourez le catalogue ou utilisez la barre de recherche pour trouver le livre qui vous intéresse.</p>
                </div>

                <div class="card">
                    <div class="card-number">02</div>
                    <h3>Vérifiez</h3>
                    <p>Consultez la fiche du livre pour voir s'il est disponible en rayon ou déjà emprunté.</p>
                </div>

                <div class="card">
                    <div class="card-number">03</div>
                    <h3>Empruntez</h3>
                    <p>Rendez-vous à l'accueil avec votre carte d'étudiant pour valider l'emprunt.</p>
                </div>
            </div>
        </section>

                <!-- ================= SECTION CATALOGUE ================= -->
        <section class="catalogue-section">
            <div class="catalogue-header">
                <h2>Le catalogue</h2>
                <p>Découvrez notre collection d'ouvrages disponibles.</p>
            </div>

            <!-- Les filtres (Liens HTML pour recharger la page avec la catégorie) -->
            <div class="filtres">
                <a href="index.php" class="filtre-btn <?= ($categorie_filtre === 'Tous') ? 'active' : '' ?>">Tous</a>
                
                <?php foreach ($categories as $cat): ?>
                    <a href="index.php?categorie=<?= urlencode($cat) ?>" 
                       class="filtre-btn <?= ($categorie_filtre === $cat) ? 'active' : '' ?>">
                        <?= htmlspecialchars($cat) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- La grille de livres -->
            <div class="livres-grid">
                <?php if (count($livres) > 0): ?>
                    <?php foreach ($livres as $livre): ?>
                        <div class="livre-card">
                            <div class="livre-couverture">
                                <!-- On affiche l'image si elle existe, sinon un placeholder -->
                                <img src="assets/images/<?= htmlspecialchars($livre['couverture']) ?>" 
                                     alt="<?= htmlspecialchars($livre['titre']) ?>"
                                     onerror="this.src='https://via.placeholder.com/200x300/1a3a5a/ffffff?text=Livre'">
                                
                                <!-- On met un badge "Disponible" par défaut pour l'instant -->
                                <span class="badge disponible">Disponible</span>
                            </div>
                            <div class="livre-infos">
                                <span class="livre-categorie"><?= htmlspecialchars($livre['categorie']) ?></span>
                                <h3><?= htmlspecialchars($livre['titre']) ?></h3>
                                <p><?= htmlspecialchars($livre['auteur']) ?>, <?= htmlspecialchars($livre['annee']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-books">Aucun livre trouvé dans cette catégorie.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('navbar');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>