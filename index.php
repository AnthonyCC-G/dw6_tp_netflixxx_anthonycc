<?php
require_once 'config/database.php'; // permet d'indiquer ici : depuis le fichier "index", va à la racine, puis dans le dossier config/, prends le fichier database.php et charge le.

/*test pour vérifier que le chargement et que tout fonctionne

var_dump($pdo); // Affiche la connexion pdo 
echo "La connexion est bien établie !! YOUPI !!!"; // pour avoir un visuel plus "parlant"

*/

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
    <title>Netflix du Rire - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>