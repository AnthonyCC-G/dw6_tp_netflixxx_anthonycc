<?php

// Ressource : https://www.php.net/manual/fr/function.strtoupper.php : strtoupper 
// Cours reçu de l'école EEDN et Maheva D.
// Ressource : Claude IA - by Anthropic

require_once 'config/database.php'; // script qui gère la base de donnée
require_once 'config/session.php'; // script qui gère les sessions

// Récupérer le thème depuis le cookie
$theme = $_COOKIE['user_theme'] ?? 'dark';

// Validation de sécurité
if ($theme !== 'light' && $theme !== 'dark') {
    $theme = 'dark';
}


// requête permettant de récupérer tous les films présents dans la BDD
$query = $pdo->prepare("SELECT * FROM film ORDER BY id DESC");
$query->execute();
$films = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des films - NETKO</title>
    <link rel="stylesheet" href="assets/css/styles1.css">
    <link rel="stylesheet" href="assets/css/layout-pako.css">
</head>
<body class="<?php echo $theme === 'light' ? 'light-mode' : ''; ?>">
    <?php require_once 'includes/navbar.php'; ?>
    
    <!-- LAYOUT AVEC PAKO -->
    <main class="main-layout container">
        
        <div class="content-zone">
            <section class="films-section" aria-labelledby="films-title">
                <h2 id="films-title">Tous nos sketches</h2>
                
                <div class="films-grid">
                    <?php foreach ($films as $film): ?>
                        <article class="film-card">
                            <header class="film-card-header">
                                <h3><?php echo strtoupper(htmlspecialchars($film['title'])); ?></h3>
                                <div class="card-buttons" aria-hidden="true">
                                    <span class="btn-circle orange"></span>
                                    <span class="btn-circle orange"></span>
                                    <span class="btn-circle orange"></span>
                                </div>
                            </header>
                            
                            <div class="film-card-image">
                                <img src="<?php echo htmlspecialchars($film['urlphoto']); ?>" 
                                    alt="Miniature du sketch : <?php echo htmlspecialchars($film['title']); ?>">
                            </div>
                            
                            <a href="film_details.php?id=<?php echo $film['id']; ?>" class="btn-details">
                                Consulter ce sketch
                            </a>
                        </article>
                    <?php endforeach; ?>
                    
                    <?php if (empty($films)): ?>
                        <p class="no-films">Aucun sketch disponible pour le moment.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        
        <!-- Pako -->
        <aside class="mascotte-zone" aria-label="Mascotte Pako">
            <img src="assets/images/pako-animated.gif" 
                alt="Pako, mascotte de Netflix du Rire" 
                class="mascotte-pako"
                loading="eager">
        </aside>
        
    </main>
    
    <footer class="footer">
        <button class="legal-button" aria-label="Afficher les mentions légales">Mentions légales</button>
    </footer>
    <!-- JavaScript pour le toggle du thème -->
    <script src="assets/js/theme-toggle.js"></script>
</body>
</html>