# Contributions — Phase 2

| Bloc | Responsable | Statut | Commits clés |
|------|-------------|--------|--------------|
| A — Auth + Rôles | Justine | Terminé | 266943d, 5485c6f, 7e7f74f |
| B — Modèles | Justine | Terminé | 1cb91ba |
| C — CRUD Voyages | Maudeva | Terminée | 43471f4 |
| D — Participants | Maudeva | Terminé | 43471f4 |
| E — API REST | Maudeva | Terminé | 37a2b11 |

## Auto-évaluation (à remplir en fin de phase)

### Justine
##### PHASE 2 - PARTIE A #####

- Ce que j'ai réalisé :
  - j'ai installé Laravel Breeze pour mettre en place un système d'authentification (login & register) automatiquement
  - j'ai ajouté le champ role dans la table users grâce à une migration Laravel
  - j'ai modifié le modèle User.php pour ajouter le champ role dans #[Fillable(['name', 'email', 'password', 'role'])]
  - j'ai créé la politique VoyagePolicy.php à l'aide de Docker pour préparer les règles d'autorisation 
  - j'ai créé et fait suivre une branche distincte (phase-2A) et ai commit sur cette branche les différentes phases de ma partie A

- Difficulté principale :
  - distinguer la configuration Docker de la configuration Laravel.
  - gérer le workflow Git (ça m'est venu seulement après de créer une branche à part de la branche main)
  - après avoir installé breeze, breeze a bien installé les fichiers, mais il n’a pas pu compiler les assets CSS/JS, j'ai donc dû me dépatouiller

- Ce que j'ai appris :
  - installer et configurer un module Laravel, qui est breeze
  - ajouter des champs en base via les migrations (que je savais déjà un peu faire)
  - mettre en place des Policies pour centraliser les règles d'accès
  - travailler de manière ordonnée et propre avec git/github dans un projet collaboratif

- Commits représentatifs :
  - 266943d
  - 5485c6f
  - 7e7f74f

### Justine
##### PHASE 2 - PARTIE B #####

- Ce que j'ai réalisé :
  - j'ai créé les modèles Laravel Voyage, Participant et Document
  - j'ai généré automatiquement les fichiers de migration
  - j'ai modifié les migrations pour ajouter les champs demandés
  - j'ai exécuté les migrations pour créer les tables
  - j'ai mis en place les premières relations Eloquent dans le modèle Voyage et dans le modèle Participant

- Difficulté principale :
  - aucune... hormis comprendre l'importance des migrations

- Ce que j'ai appris :
  - créer des modèles et migrations avec php artisan
  - concevoir une base de données adaptée aux besoins fonctionnels
  - utiliser Eloquent pour préparer les relations entre entités (hasMany etc)
  - appliquer des migrations

- Commit représentatif :
  - 1cb91ba
 
Maudeva
PHASE 2 - PARTIE C
Ce que j'ai réalisé :
- Création du contrôleur VoyageController pour gérer le CRUD des voyages.
- Enregistrement des routes de ressources web protégées par le middleware d'authentification ("auth").
- Implémentation des validations de données strictes dans store() (champs obligatoires, dates futures avec after:today et retour après le départ).
- Création de la vue Blade index pour lister les voyages et gérer l'accès conditionnel aux boutons d'action via les directives @can de Laravel.
Difficulté principale :
- Mettre en place et tester les règles de validation dynamique des dates (s'assurer que la date de retour est bien postérieure à la date de départ).
Ce que j'ai appris :
- Utiliser le système de validation intégré de Laravel pour sécuriser les données soumises par formulaire.
- Manipuler les directives de droits d'accès (@can) directement dans les fichiers de vue Blade.
Commit représentatif :
- 43471f4

Maudeva
PHASE 2 - PARTIE D
Ce que j'ai réalisé :
- Création du contrôleur ParticipantController gérant l'inscription d'un utilisateur à un voyage.
- Implémentation de la validation de l'inscription (vérification de la présence de l'user_id dans la table users).
- Ajout d'une route spécifique de type PATCH pour gérer la validation de l'autorisation parentale.
- Utilisation de la méthode authorize('update', $participant) pour sécuriser l'enregistrement de l'autorisation en base de données.
Difficulté principale :
- Lier correctement les autorisations (Policies) au contrôleur de participation pour restreindre l'approbation aux utilisateurs légitimes.
Ce que j'ai appris :
- Déclarer et utiliser des routes d'actions spécifiques (PATCH) en dehors des CRUD standards.
- Appliquer les règles de sécurité avec les Policies de Laravel pour protéger les actions sensibles en base.
Commit représentatif :
- 43471f4

Maudeva
PHASE 2 - PARTIE E
Ce que j'ai réalisé :
- Configuration et installation de l'API Laravel et du module d'authentification Sanctum.
- Création de VoyageApiController avec l'option --api sous Docker.
- Implémentation des endpoints index() (avec pagination et chargement de la relation participants) et show() (avec Route Model Binding et chargement imbriqué participants.user).
- Création et structuration d'une collection de tests API complète avec Bruno (alternative open-source à Postman) stockée dans le dossier api-tests/.
Difficulté principale :
- Résoudre le problème d'installation des dépendances Composer dans le conteneur Docker lors de la génération du contrôleur d'API.
Ce que j'ai appris :
- Concevoir des contrôleurs d'API REST standardisés renvoyant du JSON propre avec Laravel.
- Utiliser le client Bruno pour écrire, structurer et versionner des tests d'API directement dans le dépôt Git.
Commit représentatif :
- 37a2b11

# Contributions — Phase 3

| Bloc | Responsable | Statut | Commits clés |
|------|-------------|--------|--------------|
| A — CI/CD | Justine | Terminé | a7785bd, 8843770 |
| B — Kubernetes | Justine | Terminé | 0b0f11b, fc4e34c |
| C — Déploiement Cloud | Maudeva | Terminé  | 348c482, 234f9ee, 5de41cb |

## Auto-évaluation (à remplir en fin de phase)

### Justine
##### PHASE 3 - PARTIE A #####

- Ce que j'ai réalisé :
  - Mise en place d'un workflow GitHub Actions pour les tests
  - Correction des problèmes Vite dans la CI/CD
  - Construction et publication automatique de l'image Docker sur GitHub Container Registry
  - Résolution des problèmes de balises Docker

- Difficulté principale :
  - Comprendre l'origine des erreurs sur la CI/CD (manifest Vite manquant) et résoudre le conflit de la majuscule sur le nom d'utilisateur Docker.

- Ce que j'ai appris :
  - Configurer un workflow GitHub Actions
  - Gérer les artefacts et packages (GHCR) depuis un environnement de CI

- Commits représentatifs :
  - a7785bd
  - 8843770

### Justine
##### PHASE 3 - PARTIE B #####

- Ce que j'ai réalisé :
  - Création des manifestes Kubernetes (`deployment.yaml`, `migrate-job.yaml`, `service.yaml`, `ingress.yaml`, `configmap.yaml`, `secret.yaml`)
  - Connexion des manifestes à l'image GHCR publiée et déploiement de l'application sur k3d
  - Configuration de la haute disponibilité avec 2 replicas
  - Résolution de la perte de session due au load-balancing en passant le `SESSION_DRIVER` de `file` à `database` dans le `configmap.yaml`
  - Validation de la résilience du cluster via la suppression d'un pod sans interruption de service

- Difficulté principale :
  - Relier l'écosystème local K8s à l'image distante sans erreurs de permission (ImagePullBackOff).
  - Comprendre l'impact de l'orchestration sur l'état de l'application (le piège des sessions stockées localement sur le disque du pod)

- Ce que j'ai appris :
  - Les principes fondamentaux de Kubernetes (Deployments, Jobs, Ingress, Services, ConfigMaps, Secrets)
  - La gestion de l'imagePullPolicy et de l'accessibilité des registres de conteneurs
  - L'importance d'une application "stateless" en environnement orchestré pour garantir une expérience utilisateur fluide avec plusieurs replicas

- Commits représentatifs :
  - 0b0f11b
  - fc4e34c
 
Maudeva
PHASE 3 - PARTIE C
Ce que j'ai réalisé :
- Création de la ressource de sauvegarde dans k8s/backup-cronjob.yaml comprenant le CronJob de backup MariaDB et son PVC (PersistentVolumeClaim) dédié de 1 Go.
- Configuration du script automatisé de dump de la base de données s'exécutant tous les jours à 3h du matin.
- Mise en œuvre du Plan B (compilation locale des assets Vite sur l'hôte, construction de l'image de production et importation dans le cluster via k3d) pour résoudre l'erreur 500 et contourner les lenteurs de téléchargement de GHCR.
- Déploiement et validation manuelle réussie de la sauvegarde avec la création d'un Job test-backup, générant un dump SQL fonctionnel de 13 Ko sur le PVC.

Difficulté principale :
- Configurer la connexion de kubectl à l'API Server de k3d sous Windows (résolue en modifiant l'adresse host.docker.internal par 127.0.0.1 dans le fichier de configuration kubeconfig).
- Diagnostiquer l'erreur 500 sur l'écran de connexion (Vite manifest absent) et configurer le cycle de build local complet avant la création de l'image.

Ce que j'ai appris :
- Configurer et orchestrer des services d'état (StatefulSet, PVC) sous Kubernetes.
- Automatiser des tâches de maintenance récurrentes à l'aide des CronJobs Kubernetes.
- Diagnostiquer des problèmes de volumes et de réseau grâce aux commandes de diagnostic kubectl (describe, logs, run).

Commits représentatifs :
- 348c482
- 234f9ee
- 5de41cb

## Décisions d'architecture

### 1. Image unique Apache vs pod multi-conteneurs (nginx + fpm)
Décision : Utilisation d'une image unique Apache + PHP (php:8.3-apache).
Alternatives écartées : Déploiement multi-conteneurs avec Nginx et PHP-FPM séparés.
Pourquoi : L'image unique est plus simple à maintenir, réduit la complexité du déploiement Kubernetes et suffit largement pour les besoins de ce projet, tout en évitant les problèmes de partage de volumes entre conteneurs pour le code statique.

### 2. Driver de sessions
Décision : Utilisation de la base de données MariaDB (`SESSION_DRIVER=database`).
Alternatives écartées : `file`, `cookie`, `redis`.
Pourquoi : Avec `file`, la session est perdue lors du load-balancing car chaque pod a son propre système de fichiers (l'application doit être stateless). Les cookies sont limités en taille. Redis serait la solution idéale et plus performante pour mettre en cache les sessions, mais cela ajouterait un pod supplémentaire à gérer. La base de données MariaDB est déjà présente et suffit pour l'instant.

### 3. Stratégie de tag d'images (:latest vs :sha)
Décision : Utilisation du tag `:latest` pour le déploiement.
Alternatives écartées : Tag explicite par version ou par SHA du commit.
Pourquoi : Avec `imagePullPolicy: Always`, le tag `:latest` permet à Kubernetes de toujours télécharger la dernière image poussée sur GHCR, ce qui simplifie grandement les tests en phase de développement. Dans un contexte de vraie production, utiliser le SHA garantirait une traçabilité et une réversibilité exactes.
