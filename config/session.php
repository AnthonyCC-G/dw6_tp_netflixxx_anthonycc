<?php 

// Ressource : https://www.php.net/manual/fr/function.session-status.php (session)
// Ressource : https://laconsole.dev/blog/fonctions-utilitaires#:~:text=Aussi%20couramment%20appel%C3%A9es%20%C2%AB%20utils%20%C2%BB%20ou,diff%C3%A9rentes%20parties%20d'une%20application. (Fonction helper)
// principes du DRY (don't repeat yourself) et SRP (single responsibility principle)
// Ressource : Claude IA - by Anthropic


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
    return null; // return null si aucun utilisateur connecté
}

?>




