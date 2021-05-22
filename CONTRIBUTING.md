# Contribution
Veuillez prendre un moment pour prendre connaissance de ce document afin de suivre facilement le processus de contribution.

## Issues
Issues est le canal idéal pour les rapports de bug, les nouvelles fonctionnalités ou pour soumètre une pull requests, cependant veuillez a bien respecter les restrictions suivantes :

- N'utiliser par ce canal pour vos demandes d'aide personnelles.
- Il est interdit d'insulter ou d'offenser d'une quelconque manière en commentaire d'un issue. Respectez les opinions des autres, et rester concentré sur la discussion principale.

## Rapport de bug
Un bug est une erreur concrète, causée par le code présent dans ce repository.

Guide :

- Assurez-vous de ne pas créer un rapport déjà existant, pensez à utiliser le système de recherche.
- Vérifiez si le bug est corrigé, en essayant sur la dernière version du code sur la branche production ou develop.
- Isoler le problème permet de créer un scénario de test simple et identifiable.

## Nouvelle fonctionnalité
Il est toujours apprécié de proposer de nouvelles fonctionnalités. Cependant, prenez le temps de réfléchir, assurez-vous que cette fonctionnalité correspond bien aux objectifs du projet.

C'est à vous de présenter des arguments solides pour convaincre les développeurs du projet des bienfaits de cette fonctionnalité.

## Pull request
De bonnes pull requests sont d'une grande aide. 
Elles doivent rester dans le cadre du projet, ne doivent pas contenir de commits non lié au projet.

Veuillez demander avant de poster votre pull request, autrement vous risquez de passer gaspiller du temps de travail car l'équipe projet ne souhaite pas intégrer votre travail.

Suivez ce processus afin de proposer une pull request qui respecte les bonnes pratiques :

- Installez le projet en suivant le Readme.md

- Si vous avez cloné le projet il y a quelques temps, pensez à récupérer les dernières modifications:

```bash
git checkout main
git pull

git checkout dev
git pull
```

- Créez une nouvelle branche qui contiendra votre fonctionnalité, modification ou correction :

Pour une nouvelle fonctionnalité ou modification :
```bash
git checkout dev
git checkout -b feature/<feature-name>
```

Pour une nouvelle correction :
```bash
git checkout main
git checkout -b hotfix/<feature-name>
```
- Tester vos changements pour vous assurer qu'ils ne génèrent pas de régression
Exécuter la commande composer : 
```bash
composer run-script phpunit-start-test --dev
```
Elle créera la base de test, y ajoute un lot de données, puis lance les tests PhpUnit.
Ils doivent tous être OK avant le commit.

- Commit vos changements:  veuillez à respecter la convention de nommage de vos commits de la manière suivante :

<type>: <subject>
<BLANK LINE>
<body>
<BLANK LINE>
<footer>
L'en-tête est obligatoire.

Types :

build: Changements qui ont un effet sur le système (installation de nouvelles dépendances, composer, npm, environnements, ...)
ci: Configuration de l'intégration continue
cd: Configuration du déploiement continu
docs: Modifications de la documentation
feat: Nouvelle fonctionnalité
fix: Correction (hotfix)
perf: Modification du code qui optimise les performances
refactor: Toute modification du code dans le cadre d'un refactoring
style: Corrections propres au coding style (PSR-12)
test: Ajout d'un nouveau test ou correction d'un test existant

- Poussez votre branche sur votre repository :

```bash
git push origin <branch-name>
``` 
Ouvrez une nouvelle pull request avec un titre et une description précises.

## Versionnement
Les numéros de version respectent Semantic Versionning 2 :

Given a version number MAJOR.MINOR.PATCH, increment the:

- MAJOR version when you make incompatible API changes,
- MINOR version when you add functionality in a backwards-compatible manner, and
- PATCH version when you make backwards-compatible bug fixes.

## Bonnes pratiques de développement

Les bonnes pratiques de développement courantes s'appliquent au projet:
- Le [PSR-12](https://www.php-fig.org/psr/psr-12/)
- Les [bonnes pratiques de Symfony](https://symfony.com/doc/current/best_practices.html)
- Les principes SOLID