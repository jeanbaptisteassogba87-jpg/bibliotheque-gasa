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