
//== DARK/LIGHT MODE =============================
//================================================
// Par Anthony - Projet Netflix du Rire

// Sélection du bouton avec son ID
const themeToggle = document.querySelector("#theme-toggle");

// Fonction pour basculer entre dark et light mode
function toggleTheme() {
    // Ajouter ou retirer la classe 'light-mode' sur le body
    document.body.classList.toggle('light-mode');
    
    // Récupérer l'état actuel du thème
    const isLightMode = document.body.classList.contains('light-mode');
    
    // Envoyer au serveur PHP pour sauvegarder dans un cookie
    fetch('actions/set_theme.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'theme=' + (isLightMode ? 'light' : 'dark')
    })
    .then(response => response.json())
    .then(data => {
        console.log('Thème sauvegardé:', data.theme);
    })
    .catch(error => {
        console.error('Erreur lors de la sauvegarde du thème:', error);
    });
}

// Écouter le clic sur le bouton
if (themeToggle) {
    themeToggle.addEventListener('click', toggleTheme);
}