# Documentation de l'API de l'application de gestion de notes

Bienvenue dans la documentation de l'API de notre application. Cette API permet de gérer les notes des utilisateurs.

## Authentification

L'API utilise l'authentification basée sur les tokens. Pour accéder aux routes protégées, vous devez inclure le token d'authentification dans les en-têtes de vos requêtes.

## Endpoints

### /api/auth/register

- **Méthode**: POST
- **Description**: Permet d'enregistrer un nouvel utilisateur.
- **Paramètres**:
  - name (obligatoire): Le nom de l'utilisateur.
  - email (obligatoire): L'adresse email de l'utilisateur.
  - password (obligatoire): Le mot de passe de l'utilisateur.
- **Réponse**: Retourne les informations de l'utilisateur nouvellement enregistré.

### /api/auth/login

- **Méthode**: POST
- **Description**: Permet de se connecter en tant qu'utilisateur.
- **Paramètres**:
    - email (obligatoire): L'adresse email de l'utilisateur.
    - password (obligatoire): Le mot de passe de l'utilisateur.
- **Réponse**: Retourne le token d'authentification.

### /api/auth/logout

- **Méthode**: POST
- **Description**: Permet de se déconnecter en tant qu'utilisateur.
- **En-têtes**: Inclure le token d'authentification dans les en-têtes de la requête.
- **Réponse**: Retourne un message de succès.

### /api/notes

- **Méthode**: GET
- **Description**: Récupère toutes les notes de l'utilisateur connecté.
- **En-têtes**: Inclure le token d'authentification dans les en-têtes de la requête.
- **Réponse**: Retourne un tableau contenant toutes les notes de l'utilisateur connecté.

- **Méthode**: POST
- **Description**: Crée une nouvelle note pour l'utilisateur connecté.
- **En-têtes**: Inclure le token d'authentification dans les en-têtes de la requête.
- **Paramètres**:
    - content (obligatoire): Le contenu de la note.
- **Réponse**: Retourne la note nouvellement créée.

### /api/notes/:id

- **Méthode**: GET
- **Description**: Récupère les détails d'une note spécifique.
- **En-têtes**: Inclure le token d'authentification dans les en-têtes de la requête.
- **Réponse**: Retourne les détails de la note demandée.

- **Méthode**: PUT
- **Description**: Met à jour une note spécifique.
- **En-têtes**: Inclure le token d'authentification dans les en-têtes de la requête.
- **Paramètres**:
    - content (obligatoire): Le nouveau contenu de la note.
- **Réponse**: Retourne la note nouvellement mise à jour.

- **Méthode**: DELETE
- **Description**: Supprime une note spécifique.
- **En-têtes**: Inclure le token d'authentification dans les en-têtes de la requête.


