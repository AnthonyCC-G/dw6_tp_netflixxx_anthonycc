<?php


require_once 'config/session.php'; // fait appel au fichier qui gère la session
$_SESSION = array(); //vide TOUTES les variables de la session en cours puis transforme $_SESSION en tableau vide
session_destroy(); // détruit les données de la session côté serveur et supprime le fichier de session sur le serveur
header('Location: index.php'); // redirige l'utilisateur sur la page d'accueil
exit; // arrête l'execution du script PHP et évite que du code après cette ligne s'execute
?>