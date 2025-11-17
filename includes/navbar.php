
<!-- includes/navbar.php -->
<header>
    <nav class="navbar">
        <div class="nav-container">
            <h1 class="site-title">NETKO</h1>
            <!-- Nouveau wrapper pour les liens + bouton -->
            <div class="nav-bottom">
                <!-- Liens de navigation (centre) -->
                <ul class="nav-links">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="films.php">Consulter notre sélection</a></li>
                    
                    <?php if (isLoggedIn()): ?>
                        <li><a href="admin.php">Espace admin</a></li>
                        <li><a href="deconnexion.php">Se déconnecter</a></li>
                    <?php else: ?>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="connexion.php">Connexion</a></li>
                    <?php endif; ?>
                </ul>
                
                <!-- Bouton Dark/Light Mode (droite) -->
                <button id="theme-toggle" class="theme-toggle" aria-label="Changer de thème" title="Changer de thème">
                    <!-- Icône Soleil (mode dark actif, cliquer = passer en light) -->
                    <svg class="icon-sun" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="5"/>
                        <line x1="12" y1="1" x2="12" y2="3"/>
                        <line x1="12" y1="21" x2="12" y2="23"/>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                        <line x1="1" y1="12" x2="3" y2="12"/>
                        <line x1="21" y1="12" x2="23" y2="12"/>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </svg>
                    
                    <!-- Icône Lune (mode light actif, cliquer = passer en dark) -->
                    <svg class="icon-moon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>