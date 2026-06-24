# Contributions — Phase 2

| Bloc | Responsable | Statut | Commits clés |
|------|-------------|--------|--------------|
| A — Auth + Rôles | Justine | Terminé | 266943d, 5485c6f, 7e7f74f |
| B — Modèles | Justine | Terminé | 1cb91ba |
| C — CRUD Voyages | Maudeva | À faire | — |
| D — Participants | Maudeva | À faire | — |
| E — API REST | Maudeva | À faire | — |

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

# Contributions — Phase 3

| Bloc | Responsable | Statut | Commits clés |
|------|-------------|--------|--------------|
| A — CI/CD | Justine | Terminé | a7785bd, 8843770 |
| B — Kubernetes | Justine | Terminé | 0b0f11b, fc4e34c |
| C — Déploiement Cloud | Maudeva | À faire | — |

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