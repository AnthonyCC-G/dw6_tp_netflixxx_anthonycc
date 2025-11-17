<?php
require_once 'config/database.php'; // script qui gère la base de donnée
require_once 'config/session.php'; // script qui gère les sessions

// Si l'utilisateur est redirigé, permet une toute petite protection
if (!isLoggedIn()) {
    header('Location: connexion.php');
    exit;
}

checkSessionExpiration(); // pour vérifier si la session a expiré

$success = '';
$error = '';

// Si l'ajout se fait avec succès
if (isset($_GET['success'])) {
    switch ($_GET['success']) {
        case 'film_ajoute':
            $success = "Le sketch a été ajouté avec succès !";
            break;
    }
}

// Si l'ajout rencontre une erreur
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'champs_vides':
            $error = "Tous les champs sont obligatoires.";
            break;
        case 'upload_erreur':
            $error = "Erreur lors de l'upload de l'image.";
            break;
        case 'format_invalide':
            $error = "Format d'image non autorisé. Formats acceptés : JPG, PNG, GIF.";
            break;
        case 'type_mime_invalide':
            $error = "Type de fichier non autorisé.";
            break;
        case 'fichier_trop_gros':
            $error = "Le fichier est trop volumineux (maximum 5 Mo).";
            break;
        case 'upload_echec':
            $error = "Échec du déplacement du fichier.";
            break;
        case 'erreur_bdd':
            $error = "Erreur lors de l'enregistrement en base de données.";
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Netflix du Rire - Découvrez les meilleurs sketchs d'humoristes français">
        <meta name="keywords" content="humour, sketches, comédie, stand-up, rire">
        <title>Espace Admin - NETKO</title>
        <link rel="stylesheet" href="assets/css/styles1.css">
    </head>
    <body>
        <!-- Navigation -->
        <?php require_once 'includes/navbar.php'; ?>
        <!-- Contenu principal de la page -->
        <main class="container">
            <section class="hero">
                <h2>Espace Administrateur</h2>
                <p>Bienvenue <?php echo htmlspecialchars(getCurrentUser()['login'] ?? 'Administrateur'); ?> !</p>
                
                <!-- Message de succès -->
                <?php if (!empty($success)): ?>
                <div style="background-color: #E5F5E5; border: 2px solid #28A745; padding: 15px; margin-bottom: 20px; border-radius: 8px; color: #155724; font-weight: bold;">
                    <?php echo htmlspecialchars($success); ?>
                </div>
                <?php endif; ?>

                <!-- Message d'erreur -->
                <?php if (!empty($error)): ?>
                <div style="background-color: #FFE5E5; border: 2px solid #FF5C14; padding: 15px; margin-bottom: 20px; border-radius: 8px; color: #CC0000; font-weight: bold;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <h3>Ajouter un nouveau sketch</h3>
                <form method="POST" action="actions/add_film.php" enctype="multipart/form-data">
                    <!-- Titre -->
                    <label for="title">Titre du sketch</label>
                    <input type="text" id="title" name="title" required>
                    
                    <!-- Description -->
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                    
                    <!-- Photo -->
                    <label for="photo">Photo (JPG, PNG, GIF - Max 5 Mo)</label>
                    <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/gif" required>
                    
                    <!-- URL Vidéo -->
                    <label for="urlvideo">Code d'intégration YouTube (iframe)</label>
                    <textarea id="urlvideo" name="urlvideo" rows="3" required placeholder='<iframe width="560" height="315" src="https://www.youtube.com/embed/..." ...></iframe>'></textarea>
                    
                    <!-- Bouton de soumission -->
                    <button type="submit">Ajouter le sketch</button>
                </form>
        </section>
        </main>
        <!-- Pied de page -->
        <footer class="footer">
            <button class="legal-button" aria-label="Afficher les mentions légales">Mentions légales</button>
        </footer>
    </body>
</html>