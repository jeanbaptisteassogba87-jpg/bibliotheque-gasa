<?php $nom_admin = $_SESSION['admin_nom'] ?? 'Admin'; ?>
<header class="topbar">
    <form class="search" method="GET" action="livres.php">
        <span class="material-symbols-outlined">search</span>
        <input type="text" name="q" placeholder="Rechercher un livre ou un auteur"
               value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    </form>

    <div class="profile">
        <div class="avatar"><?= htmlspecialchars(mb_strtoupper(mb_substr($nom_admin, 0, 1))) ?></div>
        <div class="profile-info">
            <strong><?= htmlspecialchars($nom_admin) ?></strong>
            <small>Administrateur</small>
        </div>
    </div>
</header>