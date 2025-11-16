<?php
//Ressource : https://www.php.net/manual/fr/function.nl2br.php : nl2br
// Cours reçu de l'école EEDN et Maheva D.
// Ressource : Claude IA - by Anthropic
require_once 'config/database.php'; // script qui gère la base de donnée
require_once 'config/session.php'; // script qui gère les sessions

// Récupération de l'ID du film
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: films.php');// si pas d'ID ou ID vide redirection vers la liste des films
    exit;
}

$film_id = $_GET['id']; // étape 2 : Récupérer l'ID depuis l'URL


//Requête pour récupérer LE film avec cet ID spécifique
// Utilisation de prepare() pour éviter les injections SQL
$query = $pdo->prepare("SELECT * FROM film WHERE id = :id");
$query->execute(['id' => $film_id]);
$film = $query->fetch(); 

// IF permettant de vérifier que le film existe bien
if (!$film) {
    header('Location: films.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Netflix du Rire - Découvrez les meilleurs sketchs d'humoristes français">
        <meta name="keywords" content="humour, sketches, comédie, stand-up, rire">
        <title><?php echo htmlspecialchars($film['title']); ?> - NETKO</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!-- Navigation -->
        <?php require_once 'includes/navbar.php'; ?>
        <!-- Contenu principal : détails du film -->
        <main class="container">
            <article class="film-details">
                <h2><?php echo strtoupper(htmlspecialchars($film['title'])); ?></h2>
                <div class="film-content">
                    <!-- Image du sketch -->
                    <div class="film-photo">
                        <img src="<?php echo htmlspecialchars($film['urlphoto']); ?>" alt="<?php echo htmlspecialchars($film['title']); ?>">
                    </div>
                    <!-- Description du sketch -->
                    <div class="film-description">
                        <h3>Description</h3>
                        <p><?php echo nl2br(htmlspecialchars($film['description'])); ?></p>
                    </div>
                    <!-- Vidéo YouTube intégrée -->
                    <div class="video-section">
                        <h3>Regarder le sketch</h3>
                        <div class="video-container">
                            <?php echo $film['urlvideo']; ?>
                        </div>
                    </div>
                </div>
                <!-- Bouton retour (en dehors de film-content) -->
                <a href="films.php" class="btn-back">← Retour à la liste des sketches</a>
            </article>
        </main>
        <!-- Pied de page -->
        <footer class="footer">
            <button class="legal-button" aria-label="Afficher les mentions légales">Mentions légales</button>
        </footer>
    </body>
</html>