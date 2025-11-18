# Netflix du Rire (NETKO) 🎭

## 📋 Description du projet

Plateforme de streaming dédiée aux sketchs et stand-ups d'humoristes français, développée dans le cadre d'un TP de formation en développement web. Le projet met l'accent sur l'apprentissage des fondamentaux du développement PHP/MySQL avec une attention particulière portée à la sécurité et aux bonnes pratiques.

## 🎯 Objectifs pédagogiques

- Maîtriser les bases de données MySQL et PDO
- Comprendre l'authentification utilisateur et la gestion de sessions
- Implémenter des mesures de sécurité (hachage de mots de passe, requêtes préparées)
- Développer une architecture MVC simplifiée
- Pratiquer le versioning avec Git

## 🛠️ Technologies utilisées

- **Backend** : PHP 7.4+
- **Base de données** : MySQL
- **Serveur local** : MAMP
- **Frontend** : HTML5, CSS3 (variables CSS), JavaScript
- **Versioning** : Git / GitHub

## 📁 Structure du projet

```
tp_netflixx/
├── config/
│   ├── database.php      # Connexion PDO à la base de données
│   └── session.php       # Gestion des sessions et fonctions helper
├── includes/
│   └── navbar.php        # Navigation réutilisable
├── actions/
│   └── add_film.php      # Traitement de l'ajout de films
├── assets/
│   ├── css/
│   │   ├── styles1.css         # Styles de base (dark mode)
│   │   └── layout-pako.css     # Layout avec mascotte Pako
│   └── images/
│       └── pako-animated.gif   # Mascotte animée
├── index.php             # Page d'accueil (5 derniers sketchs)
├── films.php             # Liste complète des sketchs
├── film_details.php      # Page de détail d'un sketch
├── inscription.php       # Formulaire d'inscription
├── connexion.php         # Formulaire de connexion
├── admin.php             # Espace administrateur (ajout de films)
├── deconnexion.php       # Script de déconnexion
└── add_test_data.php     # Script d'ajout de données de test
```

## 🗃️ Base de données

### Table `film`
| Colonne | Type | Contraintes |
|---------|------|-------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT |
| `title` | VARCHAR(255) | |
| `description` | VARCHAR(255) | |
| `urlphoto` | VARCHAR(255) | |
| `urlvideo` | TEXT(500) | |

### Table `user`
| Colonne | Type | Contraintes |
|---------|------|-------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT |
| `login` | VARCHAR(255) | |
| `password` | VARCHAR(255) | *Stocké avec `password_hash()`* |

## ✅ Fonctionnalités implémentées

### Exercices complétés (1 à 7)

- ✅ **Exercice 1** : Création de la base de données
- ✅ **Exercice 2** : Page d'accueil avec les 5 derniers sketchs
- ✅ **Exercice 3** : Barre de navigation dynamique (selon statut connexion)
- ✅ **Exercice 4** : Page de consultation de tous les films
- ✅ **Exercice 5** : Système d'inscription avec hachage de mot de passe
- ✅ **Exercice 6** : Système de connexion avec vérification sécurisée
- ✅ **Exercice 7** : Page Admin avec upload de photos et ajout de films

### Fonctionnalités bonus implémentées

- 🎨 **Design personnalisé** : Thème dark avec palette orange
- 🐾 **Mascotte Pako** : Layout avec personnage animé (responsive)
- 🔒 **Sécurité renforcée** : 
  - Requêtes préparées (protection SQL injection)
  - `htmlspecialchars()` sur toutes les sorties
  - Sessions avec expiration (1h par défaut)
- ♿ **Accessibilité** : Attributs ARIA, navigation clavier
- 📱 **Responsive design** : Mobile-first avec breakpoints adaptés

## 🔐 Sécurité

Le projet implémente plusieurs mesures de sécurité essentielles :

1. **Hachage des mots de passe** : Utilisation de `password_hash()` / `password_verify()`
2. **Protection contre les injections SQL** : Requêtes préparées avec PDO
3. **Protection XSS** : `htmlspecialchars()` sur toutes les données utilisateur
4. **Gestion des sessions** : 
   - Vérification de l'état de connexion
   - Expiration automatique après 1 heure
   - Destruction sécurisée lors de la déconnexion

## 🚀 Installation

### Prérequis
- MAMP (ou équivalent)
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Git

### Étapes d'installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/[username]/dw6_tp_netflixxx_anthonycc.git
   cd dw6_tp_netflixxx_anthonycc
   ```

2. **Configurer la base de données**
   - Créer la base : `tp_netflixx_catancavery_prenom`
   - Importer les tables (voir structure ci-dessus)

3. **Configurer la connexion**
   - Copier `config/database.php` et adapter les paramètres :
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'tp_netflixx_catancavery_prenom');
   define('DB_USER', 'root');
   define('DB_PASS', 'root');
   ```

4. **Ajouter des données de test** (optionnel)
   ```
   Accéder à : http://localhost/add_test_data.php
   ```

5. **Lancer le projet**
   ```
   http://localhost/index.php
   ```

## 🧪 Tests prévus

Fonctionnalités à tester lors de la phase d'amélioration :

- [ ] Upload de fichiers (photos) avec validation
- [ ] Modification/suppression de sketchs
- [ ] Système de pagination
- [ ] Recherche de sketchs
- [ ] Catégories/tags
- [ ] Mode clair/sombre (toggle)
- [ ] Système de favoris

## 📚 Ressources utilisées

- Documentation PHP officielle
- Cours EEDN (Maheva D.)
- Claude AI by Anthropic (assistance technique)
- Stack Overflow (gestion des sessions)
- MDN Web Docs (HTML/CSS/JavaScript)

## 🎓 Apprentissages clés

### Concepts maîtrisés
- **PDO** : Connexion, requêtes préparées, gestion d'erreurs
- **Sessions PHP** : Démarrage, stockage, expiration, destruction
- **Sécurité** : Différence hachage/chiffrement, injections SQL/XSS
- **Architecture** : Séparation des préoccupations (config/includes/actions)
- **Git** : Workflow avec branches (feature branches + merge sur main)

### Bonnes pratiques appliquées
- Principes DRY (Don't Repeat Yourself) et SRP (Single Responsibility Principle)
- Code commenté et documenté
- HTML sémantique pour le SEO
- Gestion des erreurs avec redirections appropriées

## 🔜 Prochaines étapes

### Améliorations futures
- [ ] Modification/suppression de films existants
- [ ] Système de pagination pour la liste des films
- [ ] Recherche de sketchs par titre/description
- [ ] Catégories/tags pour organiser les sketchs
- [ ] Finalisation du mode clair/sombre (toggle button)
- [ ] Système de favoris utilisateur
- [ ] Refactoring du code pour une meilleure organisation
- [ ] Tests unitaires
- [ ] Documentation API
- [ ] Déploiement en ligne

## 📝 Notes de développement

Ce projet privilégie la **compréhension** plutôt que la rapidité. Chaque fonctionnalité est construite from scratch avec une attention particulière portée à :
- La validation des connaissances acquises
- L'explication des choix techniques
- La documentation du code
- Le respect des standards web

## 👤 Auteur

**Anthony** - Étudiant en développement web  
Formation : TP Netflix du Rire  
Approche : Learning-first, step-by-step

---

*Projet pédagogique - 2024*
