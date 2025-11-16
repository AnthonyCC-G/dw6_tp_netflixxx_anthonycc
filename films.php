<?php

// Ressource : https://www.php.net/manual/fr/function.strtoupper.php : strtoupper 
// Cours reçu de l'école EEDN et Maheva D.
// Ressource : Claude IA - by Anthropic


require_once 'config/database.php'; // script qui gère la base de donnée
require_once 'config/session.php'; // script qui gère les sessions

// requête permettant de récupérer tous les films présents dans la BDD (sans la limite des 5 premiers contrairement au premier exercice du TP)
// depuis le début j'utilise $pdo et ici je reste sur cette utilisation 
$query = $pdo->prepare("SELECT * FROM film ORDER BY id DESC");
$query->execute();
$films = $query->fetchAll(); // récupère tout

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Netflix du Rire - Découvrez les meilleurs sketchs d'humoristes français">
        <meta name="keywords" content="humour, sketches, comédie, stand-up, rire">
        <title>Liste des films - NETKO</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!-- Navigation -->
        <?php require_once 'includes/navbar.php'; ?>
        <!-- Contenu principal de la page -->
        <main class="container">
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
                                <img src="<?php echo htmlspecialchars($film['urlphoto']); ?>" alt="Miniature du sketch : <?php echo htmlspecialchars($film['title']); ?>">
                            </div>
                            <!-- Lien vers la page de détails -->
                            <a href="film_details.php?id=<?php echo $film['id']; ?>" class="btn-details">
                                Consulter ce sketch
                            </a>
                        </article>
                    <?php endforeach; ?>
                    <?php if (empty($films)): ?>
                        <p class="no-films"> Aucun Sketch disponible pour le moment.</p>
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