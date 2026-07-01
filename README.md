# Voyages scolaires — Projet fil rouge

## Stack
Laravel · MariaDB · Docker · GitHub Actions (CI/CD) · Kubernetes (k3d)

## Lancer en dev local
```bash
docker compose up -d
# L'application est alors accessible sur http://localhost:8080
```

## Déployer sur le cluster
```bash
# 1. Créer le cluster k3d
k3d cluster create tp-devops --servers 1 --agents 2 --port "8080:80@loadbalancer"

# 2. Configurer les secrets (mots de passe, clé d'application)
cp k8s/secret.example.yaml k8s/secret.yaml
# Renseigner ensuite les valeurs réelles dans k8s/secret.yaml

# 3. Déployer tous les manifests Kubernetes
kubectl apply -f k8s/
```
*(Note : Si le port 8080 est déjà occupé par Docker Compose sur votre machine, vous pouvez recréer le cluster sur le port 8081 avec `--port "8081:80@loadbalancer"` et accéder à l'application via http://localhost:8081).*

## Architecture
Voir le fichier [CONTRIBUTIONS.md](CONTRIBUTIONS.md) pour les détails et les 3 décisions d'architecture (image unique Apache, session driver en base de données, et stratégie de tags d'images).

## Équipe & rôles
* **Justine** (Dev 1) :
  * **DevOps :** Bloc A (Dockerfile.prod + workflow CI/CD) et Bloc B (déploiements stateless + résolution des sessions).
  * **Laravel :** Authentification, rôles utilisateurs et politique d'accès aux voyages.
* **Maudeva** (Dev 2) :
  * **DevOps :** Bloc C (déploiement stateful MariaDB, volumes persistants PVC, Job de migrations, CronJob de backup de base de données).
  * **Laravel :** CRUD Voyages (validation, formulaires, vues), Inscription des participants, API REST (Sanctum, contrôleur API et tests Bruno).
