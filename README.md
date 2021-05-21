# Projet OpenclassRooms : Améliorez une application existante de ToDo & Co

## Description du projet

Dans le cadre de la formation Développeur d'application - PHP / Symfony d'OpenClassRooms, voici le projet n°8 : Améliorez une application existante.

## Contexte
Vous venez d’intégrer une startup dont le cœur de métier est une application permettant de gérer ses tâches quotidiennes. L’entreprise vient tout juste d’être montée, et l’application a dû être développée à toute vitesse pour permettre de montrer à de potentiels investisseurs que le concept est viable (on parle de Minimum Viable Product ou MVP).

Votre rôle ici est donc d’améliorer la qualité de l’application. 

Ainsi, pour ce dernier projet de spécialisation, vous êtes dans la peau d’un développeur expérimenté en charge des tâches suivantes :

- l’implémentation de nouvelles fonctionnalités ;
- la correction de quelques anomalies ;
- et l’implémentation de tests automatisés.

Il vous est également demandé d’analyser le projet grâce à des outils vous permettant d’avoir une vision d’ensemble de la qualité du code et des différents axes de performance de l’application.

Il ne vous est pas demandé de corriger les points remontés par l’audit de qualité de code et de performance. Cela dit, si le temps vous le permet, ToDo & Co sera ravi que vous réduisiez la dette technique de cette application.

## Besoin client
### Corrections d'anomalies

- Une tâche doit être attachée à un utilisateur

- Choisir un rôle pour un utilisateur

### Implémentation de nouvelles fonctionnalités
- Autorisation

- Implémentation de tests automatisés

## Documentation technique
Il vous est demandé de produire une documentation expliquant comment l’implémentation de l'authentification a été faite. Cette documentation se destine aux prochains développeurs juniors qui rejoindront l’équipe dans quelques semaines

## Audit de qualité du code & performance de l'application
Les fondateurs souhaitent pérenniser le développement de l’application. Cela dit, ils souhaitent dans un premier temps faire un état des lieux de la dette technique de l’application.
Au terme de votre travail effectué sur l’application, il vous est demandé de produire un audit de code sur les deux axes suivants : la qualité de code et la performance.
Concernant l’audit de performance, l’usage de Blackfire est obligatoire.

## Compétences évaluées

- Lire et retranscrire le fonctionnement d’un morceau de code écrit par d’autres développeurs
- Proposer une série d’améliorations
- Implémenter de nouvelles fonctionnalités au sein d’une application déjà initiée en suivant un plan de collaboration clair
- Mettre en œuvre des tests unitaires et fonctionnels
- Produire un rapport de l’exécution des tests
- Analyser la qualité de code et la performance d’une application
- Établir un plan pour réduire la dette technique d’une application
- Fournir des patchs correctifs lorsque les tests le suggèrent

## Pour commencer

### Prérequis

- Php 7.4
- Composer 2.0
- Une base de données mySQL 5.7
- Git

### Installation

- Cloner le projet en local
- Exécuter la commande composer :
```bash
composer install
```
- Intégrer les données de démo : Exécuter la commande composer : 
```bash
composer run-script prepare-db --dev
```
- Identifiants de test :
pseudo : BobDoe 
mot de passe : passpass


### Paramétrage

Modifier les informations de connexion dans un fichier /.env.local à mettre à la racine du projet.
- Base de données : doctrine/doctrine-bundle

Renseigner les informations de connexion à la base de données de test dans le fichier .env/test à la racine du projet


## Fabriqué avec

* Symnfony 5.2
* Doctrine 
* Visual Studio Code
* WAMP
* PHP CodeSniffer
* PHP Intelephense
* PHP MessDetector
* PHPStan
* PHPpcpd
* CodeClimate
* twigCS
* composerUnused
* Google LightHouse
* BlackFire

## Versions
- V1.0.0 : First Version
- V1.0.1 : Customize error pages


## CodeClimate
<a href="https://codeclimate.com/github/Toasted201/OpenClassroom_P08/maintainability"><img src="https://api.codeclimate.com/v1/badges/b04f64f1746fdfaabee2/maintainability" /></a>

