<?php
require_once 'config/database.php'; // script qui gère la base de donnée
require_once 'config/session.php'; // script qui gère les sessions

// Si l'utilisateur est redirigé, permet une toute petite protection
if (!isLoggedIn()) {
    header('Location: connexion.php');
    exit;
}

checkSessionExpiration(); // pour vérifier si la session a expiré

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Netflix du Rire - Découvrez les meilleurs sketchs d'humoristes français">
        <meta name="keywords" content="humour, sketches, comédie, stand-up, rire">
        <title>Espace Admin - NETKO</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!-- Navigation -->
        <?php require_once 'includes/navbar.php'; ?>
        <!-- Contenu principal de la page -->
        <main class="container">
            <section class="hero">
                <h2>Espace Administrateur</h2>
                <p>Bienvenue <?php echo htmlspecialchars(getCurrentUser()['login'] ?? 'Administrateur'); ?> !</p>
                <p>Cette page sera développée dans l'exercice 7.</p>
        </section>
        </main>
        <!-- Pied de page -->
        <footer class="footer">
            <button class="legal-button" aria-label="Afficher les mentions légales">Mentions légales</button>
        </footer>
    </body>
</html>