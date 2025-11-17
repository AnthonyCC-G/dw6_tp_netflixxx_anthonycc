<?php
// actions/set_theme.php
// Gestion du cookie pour le thème dark/light mode

// Récupérer le thème envoyé par JavaScript via POST
$theme = $_POST['theme'] ?? 'dark';

// Validation : le thème doit être 'light' ou 'dark'
if ($theme !== 'light' && $theme !== 'dark') {
    $theme = 'dark'; // Valeur par défaut si invalide
}

// Créer un cookie qui dure 1 an
setcookie(
    'user_theme',                      // Nom du cookie
    $theme,                            // Valeur ('light' ou 'dark')
    time() + (365 * 24 * 60 * 60),     // Expire dans 1 an
    '/',                               // Disponible sur tout le site
    '',                                // Domaine (vide = domaine actuel)
    false,                             // Secure (false pour localhost)
    true                               // HttpOnly (protection XSS)
);

// Répondre en JSON pour que JavaScript sache que c'est OK
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'theme' => $theme,
    'message' => 'Thème sauvegardé avec succès'
]);
?>