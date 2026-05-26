# Contributions — Phase 2

| Bloc | Responsable | Statut | Commits clés |
|------|-------------|--------|--------------|
| A — Auth + Rôles | Justine | Terminé | 266943d, 5485c6f, 7e7f74f |
| B — Modèles | Justine | En cours | — |
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