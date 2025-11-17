<?php

// Cours reçu de l'école EEDN et Maheva D.
// Ressource : Claude IA - by Anthropic


require_once 'config/database.php'; // permet d'indiquer ici : depuis le fichier "index", va à la racine, puis dans le dossier config/, prends le fichier database.php et charge le.
require_once 'config/session.php';

//Test lors du développement : connexion des liens de navigation de la nav bar :  "Oups" j'ai supprimé le code teste, je ne peux donc pas vous le montrer

//Test lors du développement : pour vérification du chargement de la page avec var_dump (fait)

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
        <link rel="stylesheet" href="assets/css/styles1.css">
        <link rel="stylesheet" href="assets/css/layout-pako.css">
    </head>
    <body>
        <!-- Navigation -->
        <?php require_once 'includes/navbar.php'; ?>
        <!--Contenu principal de la page -->
        <main class="main-layout container">
        <!-- Zone de contenu (gauche) -->
        <div class="content-zone">
            <section class="hero" aria-labelledby="hero-title">
                <h2 id="hero-title">Bienvenue sur Netko</h2>
                <p>Découvrez notre collection de sketches hilarants !</p>
            </section>
            <section class="films-section" aria-labelledby="films-title">
                <h2 id="films-title">Les 5 derniers sketches ajoutés</h2>
                
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
        <!-- Zone mascotte (droite) - Pako sticky -->
        <aside class="mascotte-zone" aria-label="Mascotte Pako">
            <img src="assets/images/pako-animated.gif" 
                alt="Pako, mascotte de Netflix du Rire" 
                class="mascotte-pako"
                loading="eager">
        </aside>
    </main>
        <!-- Pied de page -->
        <footer class="footer">
            <button class="legal-button" aria-label="Afficher les mentions légales">Mentions légales</button>
        </footer>
    </body>
</html>