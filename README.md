# voyages-scolaires-justine-maudeva
# projet fil rouge

## stack
Laravel · MariaDB · Docker · GitHub Actions (CI/CD) · Kubernetes (k3d)

## lancer en dev local
docker compose up -d -> http://localhost:8080

## déployer sur le cluster
k3d cluster create tp-devops --servers 1 --agents 2 --port "8080:80@loadbalancer"
cp k8s/secret.example.yaml k8s/secret.yaml (puis renseigner les valeurs)
kubectl apply -f k8s/

## architecture
voir le fichier `CONTRIBUTIONS.md` pour le détail de tout ce qu'on a fait

## équipe & rôles

>Justine
Laravel (phase 2) : Authentification & rôles (partie A) + Modèles (partie B)
DevOps (phase 3) : CI/CD et Image Docker (partie A) + Kubernetes stateless et Sessions (partie B)
Maudeva
Laravel (phase 2) : CRUD Voyages (partie C) + Participants (partie D) + API REST (partie E)
DevOps (phase 3) : StatefulSet MariaDB, Backup, Monitoring (partie C)