<?php
// La page qui inclut ce fichier définit avant : $page_active = 'livres';
$page_active = $page_active ?? '';
?>
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <span class="material-symbols-outlined brand-icon">menu_book</span>
        GASA Admin
    </div>

    <nav class="sidebar-menu">
        <div class="menu-label">Main Menu</div>
        <a href="dashboard.php" class="menu-item <?= $page_active === 'dashboard' ? 'active' : '' ?>">
            <span class="material-symbols-outlined">dashboard</span> Dashboard
        </a>
        <a href="livres.php" class="menu-item <?= $page_active === 'livres' ? 'active' : '' ?>">
            <span class="material-symbols-outlined">menu_book</span> Livres
        </a>
        <a href="membres.php" class="menu-item <?= $page_active === 'membres' ? 'active' : '' ?>">
            <span class="material-symbols-outlined">group</span> Membres
        </a>
        <a href="emprunts.php" class="menu-item <?= $page_active === 'emprunts' ? 'active' : '' ?>">
            <span class="material-symbols-outlined">swap_horiz</span> Emprunts
        </a>

        <div class="menu-label" style="margin-top: 30px;">Settings</div>
        <a href="logout.php" class="menu-item logout">
            <span class="material-symbols-outlined">logout</span> Déconnexion
        </a>
    </nav>
</aside>