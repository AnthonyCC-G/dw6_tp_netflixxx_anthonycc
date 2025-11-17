<?php

// Ressources : https://www.php.net/manual/fr/reserved.variables.session.php : pour SESSION
// Ressources : https://www.php.net/manual/en/function.password-verify.php : pour le PASSWORD_VERIFY
// Ressource : Claude IA - by Anthropic
// Ressource : https://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes : Expiration de la session : Stack overflow (SESSION PHP)
// Cours reçu de l'école EEDN et Maheva D.
// Ressource : Claude IA - by Anthropic


require_once 'config/database.php'; // script qui gère la base de donnée
require_once 'config/session.php'; // script qui gère les sessions

// variable pour les erreurs
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // vérifie qu'il existe bien une requête avec POST sur le SERVER

    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($login) || empty($password)) { // Vérifie si les champs sont vides
        $error = "Tous les champs sont obligatoires."; // message d'erreur

    } else {
        $query = $pdo->prepare("SELECT * FROM user WHERE login = :login"); // prépare une requête pour la bdd pour chercher l'utilisateur
        $query->execute(['login' => $login]); // exécute la requête avec le login saisie 
        $user = $query->fetch(); // récupère l'utilisateur si c'est ok sinon "false" si c'est incorrect avec la BDD

        // Il faut vérifier si l'utilisateur existe ET si le mot de passe correspond
        if ($user && password_verify($password, $user['password'])) {

        // Créer une session aevc les infos utilisateurs (le tableau associatif de la "SESSION" permet de stocker les infos pour les autres pages)
        $_SESSION['user_id'] = $user['id']; // Stockage de l'id utilisateur dans la "SESSION"
        $_SESSION['user_login'] = $user['login']; // Stockage du pseudo de l'utilisateur dans la "SESSION"

        // Définition du délai d'expiration en partant du temps de la connexion
        $_SESSION['start'] = time(); // Maintenant
        $_SESSION['expire'] = time() + (60 * 60); // ici cela indique 30minutes, c'est modifiable selon le souhait

        // $_SESSION['expire'] = time() + (15 * 60); <= 15 minutes
        // $_SESSION['expire'] = time() + (60 * 60); <= 1heure
        // $_SESSION['expire'] = time() + (2 * 60 * 60); <= 2heures

        header('Location: admin.php'); // Redirige le sur la page admin.php si l'authentificatione est ok 
        exit; // N'exécute aucun code après cette ligne
        
        } else {
            $error = "Login ou mot de passe incorrect."; // au cas où le login OU le mdp sont erronées ... (ne JAMAIS indiqué s'il s'agit du mdp ou du login)
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
        <title>Connexion - NETKO</title>
        <link rel="stylesheet" href="assets/css/styles1.css">
    </head>
    <body>
        <!-- Navigation -->
        <?php require_once 'includes/navbar.php'; ?>
        <!-- Contenu principal de la page -->
        <main class="container">
            <section class="hero">
                <h2>Connexion</h2>
                <p>Merci de bien vouloir indiquer vos identifiants afin de poursuivre</p>
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
                    <button type="submit">Se connecter</button>
                </form>
            </section>
        </main>
        <!-- Pied de page -->
        <footer class="footer">
            <button class="legal-button" aria-label="Afficher les mentions légales">Mentions légales</button>
        </footer>
    </body>
</html>