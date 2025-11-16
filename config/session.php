<?php 

// Ressource : https://www.php.net/manual/fr/function.session-status.php (session)
// Ressource : https://laconsole.dev/blog/fonctions-utilitaires#:~:text=Aussi%20couramment%20appel%C3%A9es%20%C2%AB%20utils%20%C2%BB%20ou,diff%C3%A9rentes%20parties%20d'une%20application. (Fonction helper)
// principes du DRY (don't repeat yourself) et SRP (single responsibility principle)
// Ressource : Claude IA - by Anthropic
// Cours reçu de l'école EEDN et Maheva D.
// Ressource : https://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes : SESSION START/EXPIRE - StackOverflow
// Pour ce TP, le renouvellement de session n'est pas utile mais principe du renouvellement de session comprit mais pas codé

// Si AUCUNE session n'existe ALORS démarre en une
if (session_status() === PHP_SESSION_NONE) { // vérifie qu'aucune session n'est active (PHP)
    session_start(); 
}

//Fonction "helper"/utilitaire : fonction indépendantes du contexte / Ici on vérifie que l'utilisateur est connecté
// return TRUE si c'est vrai et FALSE si faux
function isLoggedIn() { // la fonction s'appelle "isLoggedIn" / 
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);  // vérifie que la session user_id existe ET qu'elle n'est pas vide - les deux conditions doivent être vraies (&&)
}

// Fonction pour obtenir les infos de l'utilisateur connecté : qui est l'utilisateur connecté
function getCurrentUser () { // fonction s'appelle getCurrentUser (currentUser = utilisateur actuel)
    if (isLoggedIn()) { // si un utilisateur est connecté : 
        return [ // return un tableau avec les données OU null si personne n'est connecté
            'id' => $_SESSION['user_id'],
            'login' => $_SESSION['user_login'] ?? null
        ];
    }
    return null; // retourne null si aucun utilisateur connecté
}

// Fonction pour gérer l'expiration d'une session. Ici permet de vérifier si la session a expiré
function checkSessionExpiration() {
    if (isLoggedIn()) { // si l'utilisateur est connecté
        $now = time(); // le temps = "maintenant"
        
        if (isset($_SESSION['expire']) && $now > $_SESSION['expire']) { // si un décompte du temps existe bien (timestamp) ET qu'il est dépassé
            session_destroy(); // détruit la session en cours
            header('Location: connexion.php?error=session_expired'); // redirige le vers la page ...
            exit; // n'exécute plus rien après cette ligne
        }
    }
}


?>




