<?php
// La page définit avant l'include : $page_active = 'dashboard';
$page_active = $page_active ?? '';
?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <span class="brand-logo"><img src="../assets/images/logo-gasa.jpeg" alt="Logo UATM GASA"></span>
        <span class="brand-text">
            <strong>Bibliothèque</strong>
            <small>Espace administrateur</small>
        </span>
    </div>

    <nav class="sidebar-nav">
        <a href="dashboard.php" class="nav-link <?= $page_active === 'dashboard' ? 'active' : '' ?>">
            <span class="material-symbols-outlined">grid_view</span> Tableau de bord
        </a>
        <a href="livres.php" class="nav-link <?= $page_active === 'livres' ? 'active' : '' ?>">
            <span class="material-symbols-outlined">menu_book</span> Livres
        </a>
        <a href="membres.php" class="nav-link <?= $page_active === 'membres' ? 'active' : '' ?>">
            <span class="material-symbols-outlined">group</span> Membres
        </a>
        <a href="emprunts.php" class="nav-link <?= $page_active === 'emprunts' ? 'active' : '' ?>">
            <span class="material-symbols-outlined">swap_horiz</span> Emprunts
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="../index.php" target="_blank" class="nav-link small">
            <span class="material-symbols-outlined">open_in_new</span> Voir le catalogue public
        </a>
        <a href="logout.php" class="nav-link small logout">
            <span class="material-symbols-outlined">logout</span> Se déconnecter
        </a>
    </div>
</aside>