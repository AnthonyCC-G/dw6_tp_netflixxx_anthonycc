<?php

// Ressource : https://www.php.net/manual/fr/function.password-hash.php : Password Hash
// Cours reçu de l'école EEDN et Maheva D.
// Ressource : Claude IA - by Anthropic

require_once 'config/database.php'; // script qui gère la base de donnée
require_once 'config/session.php'; // script qui gère les sessions


// variable pour les erreurs
$error = '';

// Récupère les informations sur le serveur , vérifie qu'une requête POST est bien présente
// Puis vérifie les champs s'ils sont vides, 
// Si c'est le cas affiche un message d'erreur
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($login) || empty($password)) { // Vérifie si les champs sont vides
        $error = "Tous les champs sont obligatoires."; // Si login et password sont vide : message d'erreur
    } else {
        $query = $pdo->prepare("SELECT * FROM user WHERE login = :login"); // vérifie si le login existe déjà - requête vers la BDD
        $query->execute(['login' => $login]); // compare le login saisie avec les login dans la bdd
        $userExiste = $query->fetch(); // récupère l'info

        if ($userExiste) { 
            $error = "Ce login est déjà utilisé."; // si le login existe déjà = message d'erreur
        } else {
            $passwordHache = password_hash($password, PASSWORD_DEFAULT); // hashage du mot de passe
            $insertQuery = $pdo->prepare("INSERT INTO user (login, password) VALUES (:login, :password)"); // requête pour l'insérer dans la bdd si le login n'existe pas dans la bdd initialement
            $insertQuery->execute([ 
                'login' => $login,
                'password' => $passwordHache //enregistre le mot de passe dans la bdd et sécurise-le avec le hashage
            ]);
            header('Location: connexion.php'); // redirection vers la page "connexion.php" demandé dans le tp
            exit; // n'execute aucun code après le "exit"
        }
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
        <title>Inscription - NETKO</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!-- Navigation -->
        <?php require_once 'includes/navbar.php'; ?>
        <!-- Contenu principal de la page -->
        <main class="container">
            <section class="hero">
                <h2>Inscription</h2>
                <p>Créez votre compte pour accéder à l'espace administrateur.</p>
                <!-- Message d'erreur -->
                <?php if (!empty($error)): ?>
                <div style="background-color: #FFE5E5; border: 2px solid #FF5C14; padding: 15px; margin-bottom: 20px; border-radius: 8px; color: #CC0000; font-weight: bold;">
                <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>
                <!-- le formulaire -->
                <form method="POST" action="">
                    <!-- Champs -->
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" required>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">S'inscrire</button>
                </form>
            </section>
        </main>
        <!-- Pied de page -->
        <footer class="footer">
            <button class="legal-button" aria-label="Afficher les mentions légales">Mentions légales</button>
        </footer>
    </body>
</html>