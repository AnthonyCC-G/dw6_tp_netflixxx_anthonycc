<?php
require_once 'config/database.php'; // permet d'indiquer ici : depuis le fichier "index", va à la racine, puis dans le dossier config/, prends le fichier database.php et charge le.

/*test pour vérifier que le chargement et que tout fonctionne

var_dump($pdo); // Affiche la connexion pdo 
echo "La connexion est bien établie !! YOUPI !!!"; // pour avoir un visuel plus "parlant"

*/

// Requête pour notre séléction d'informations dans la bdd

$query = $pdo->prepare("SELECT * FROM film ORDER BY id DESC LIMIT 5"); // récupère toutes les colonnes, dans la table "film", trie par id décroissant (du plus récent au plus ancien)
$query->execute();
$films = $query->fetchAll(); // ici je lui demande de récupérer tous les résultats dans un tableau $films



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Netflix du Rire - Découvrez les meilleurs sketchs d'humoristes français">
        <meta name="keywords" content="humour, sketches, comédie, stand-up, rire">
        <title>Netflix du Rire - Accueil | Les meilleurs sketches français</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!--En-tête avec navigation-->
        <header>
            <nav class="navbar">
                <div class="nav-container">
                    <h1 class="site-title">NETKO</h1>
                    <ul class="nav-links">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="films.php">Consulter notre sélection</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="connexion.php">Connexion</a></li>
                    </ul>    
                </div>
            </nav>
        </header>
        <!--Contenu principal de la page -->
        <main class="container">
            <section class="hero" aria-labelledby="hero-title">
                <h2 id="hero-title">Bienvenue sur mon "Netflix" du RIRE</h2>
                <p>Découvrez notre collection de sketches hilarants !</p>
                <img src="assets/image/bannière.png" alt="Bannière Netflix du Rire" class="hero-image">
            </section>
            <section class="films-section" aria-labelledby="films-title">
                <h2 id="films-title">Les 5 derniers sketches ajoutés</h2>
                <div class="films-grid">
                    <?php foreach ($films as $film): ?>
                        <article class="film-card-header">
                            <header class="film-card-header">
                                <h3><?php echo strtoupper(htmlspecialchars($film['title'])); ?></h3>
                                <div class="card-buttons" aria-hidden="true">
                                    <span class="btn-circle orange"></span>
                                    <span class="btn-circle orange"></span>
                                    <span class="btn-circle orange"></span>
                                </div>
                            </header>
                            <div class="film-card-image">
                                <img src="<?php echo htmlspecialchars($film['urlphoto']); ?>" alt="Miniature du sketch : <?php echo htmlspecialchars($film['title']); ?>">
                        </article>

                        <?php endforeach; ?>

                        <?php if (empty($films)): ?>
                            <p class="no-films">Aucun Sketch disponible pour le moment.</p>
                        <?php endif; ?> 
                </div>
            </section>
        </main>
        <!-- Pied de page -->
        <footer class="footer">
            <button class="legal-button" aria-label="Afficher les mentions légales">Mentions légales</button>
        </footer>
    </body>
</html>