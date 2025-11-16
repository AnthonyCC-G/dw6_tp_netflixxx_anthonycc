<?php

require_once '../config/database.php'; 
require_once '../config/session.php';

// Ressource : https://www.php.net/manual/fr/features.file-upload.php (upload de fichiers)
// Ressource : https://www.php.net/manual/fr/function.move-uploaded-file.php
// Ressource : https://www.php.net/manual/fr/function.uniqid.php : "unique id" - Php.net
// Ressource : https://www.php.net/manual/fr/function.mime-content-type.php : "type MIME" - Php.net 
// & StackOverflow https://stackoverflow.com/questions/3828352/what-is-a-mime-type
// Cours reçu de l'école EEDN et Maheva D.
// Ressource : Claude IA - by Anthropic


// 1 = Vérifier que l'utilisateur est connecté = fonction déjà définie dans le fichier session.php
if (!isLoggedIn()) {
    header('Location: ../connexion.php');
    exit;
}


// 2 = Vérifier qu'il s'agit bien d'une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../admin.php');
    exit;
}


// 3 = Récupèrer les données du formulaire
$title = $_POST['title'] ?? '';           // Titre du sketch
$description = $_POST['description'] ?? ''; // Description du sketch
$urlvideo = $_POST['urlvideo'] ?? '';    // url de la vidéo (iframe)


// 4 = Vérifier que les champs ne soient pas vides
if (empty($title) || empty($description) || empty($urlvideo)) {
    header('Location: ../admin.php?error=champs_vides');
    exit;
}


// 5 = Vérifier qu'un fichier a bien été uploadé (L'IMAGE)
if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) { // s'il existe un fichier sans erreur ou présent dans l'espace "temporaire" du server
    header('Location: ../admin.php?error=upload_erreur'); //rediriges le vers la page ...
    exit;
}


// concernant le fichier stocker temporairement
$file = $_FILES['photo']; // Récupérer les informations du fichier
$fileName = $file['name'];// Nom original (ex: "mon image.jpg")
$fileTmpName = $file['tmp_name'];// Chemin temporaire
$fileSize = $file['size'];// Taille en octets
$fileError = $file['error'];// Code erreur
$fileType = $file['type'];// Type MIME

// Récupérer l'extension du fichier
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // permet de récupérer l'extension

// Définir les extensions que l'on souhaite initialement
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // test des GIF


// Définir le type MIME (j'ai opter pour cette option après avoir vu cette info un peu partout et également sur l'IA Claude)
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];



// comparaison entre l'extension du fichier récupérer et nos normes initiales 
if (!in_array($fileExt, $allowedExtensions)) {
    header('Location: ../admin.php?error=format_invalide'); //si l'extension n'est pas correcte alors on redirige ...
    exit;
}


// Vérifier le type MIME s'il correspond avec nos normes
if (!in_array($fileType, $allowedMimeTypes)) {
    header('Location: ../admin.php?error=type_mime_invalide');
    exit;
}


// Vérifier la taille du fichier
$maxSize = 5 * 1024 * 1024; // 5 Mo en octets (normes de bases pour le tp)
if ($fileSize > $maxSize) {
    header('Location: ../admin.php?error=fichier_trop_gros');
    exit;
}

// créer un nom unique pour le fichier afin d'éviter les doublons (merci Claude pour le cas de figure que je n'avais pas anticipé)
$newFileName = uniqid() . '_' . $fileName;


// définir le dossier dans lequel "RANGER" l'image et le nommer
$uploadDir = '../assets/uploads/'; // Dossier de destination
$destination = $uploadDir . $newFileName;


// Enfin déplacer le fichier de l'espace temporaire du server et le placer dans le dossier permanent
if (!move_uploaded_file($fileTmpName, $destination)) {
    header('Location: ../admin.php?error=upload_echec');
    exit;
}

// créer un chemin relatif pour la base de donnée
$urlphoto = 'assets/uploads/' . $newFileName;

//=================================================
// partie en lien avec la bdd

//il faut insérer les données dans la base de données 
try {
    $query = $pdo->prepare(" 
        INSERT INTO film (title, description, urlphoto, urlvideo) 
        VALUES (:title, :description, :urlphoto, :urlvideo)
    "); // Requête préparer pour la bdd
    
    $query->execute([
        'title' => $title,
        'description' => $description,
        'urlphoto' => $urlphoto,
        'urlvideo' => $urlvideo
    ]);

    // partie sur le message à afficher si succès
    header('Location: ../admin.php?success=film_ajoute');
    exit;

} catch (PDOException $e) { // s'il existe une erreur, on supprime l'image afin de ne pas stocker d'images "flottantes" dans notre bdd
    if (file_exists($destination)) {
        unlink($destination); // Supprime le fichier
    }
    header('Location: ../admin.php?error=erreur_bdd');
    exit;

}




?>