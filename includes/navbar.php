
<!-- includes/navbar.php -->
<header>
    <nav class="navbar">
        <div class="nav-container">
            <h1 class="site-title">NETKO</h1>
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="films.php">Consulter notre sélection</a></li>
                
                <?php if (isLoggedIn()): ?>
                    <!-- Ces liens sont visibles uniquement si connecté -->
                    <li><a href="admin.php">Espace admin</a></li>
                    <li><a href="deconnexion.php">Se déconnecter</a></li>
                <?php else: ?>
                    <!-- Ces liens sont visibles uniquement si NON connecté -->
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="connexion.php">Connexion</a></li>
                <?php endif; ?>
            </ul>    
        </div>
    </nav>
</header>