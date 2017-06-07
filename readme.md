# Créez un blog pour un écrivain

Framework [Silex](https://silex.sensiolabs.org).

## Présentation

Vous venez de décrocher un contrat avec Jean Forteroche, acteur et écrivain. Il travaille actuellement sur son prochain roman, "Billet simple pour l'Alaska". Il souhaite innover et le publier par épisode en ligne sur son propre site.

Seul problème : Jean n'aime pas WordPress et souhaite avoir son propre outil de blog, offrant des fonctionnalités plus simples. Vous allez donc devoir développer un moteur de blog en PHP et MySQL.

## Architecture 

Voici les principales caractéristiques de l'architecture :

* séparation des responsabilités selon le principe Modèle-Vue-Contrôleur ;
* intégration du micro-framework [Silex](http://silex.sensiolabs.org/) ;
* modélisation objet du domaine et de l'accès aux données ;
* utilisation des espaces de noms et chargement automatique des classes grâce à [Composer](https://getcomposer.org/) ;
* intégration du moteur de templates [Twig](http://twig.sensiolabs.org/) pour faciliter l'écriture des vues ;
* présentation moderne et adaptée au terminal utilisé (*responsive design*) grâce au framework Web [Bootstrap](http://getbootstrap.com/) ;
* gstion avancée de la sécurité et des formulaires grâce aux composants du framework [Symfony](http://symfony.com) ;
* back-office d'administration ;
* tests fonctionnels automatisés utilisant [PHPUnit](https://phpunit.de/) ;
* journalisation avec [Monolog](https://github.com/Seldaek/monolog) et gestion des erreurs ;
* API utilisant le format JSON.

## Instructions

Vous développerez une application de blog simple en PHP et avec une base de données MySQL. Elle doit fournir une interface frontend (lecture des billets) et une interface backend (administration des billets pour l'écriture). On doit y retrouver tous les éléments d'un CRUD :

Create : création de billets
Read : lecture de billets
Update : mise à jour de billets
Delete : suppression de billets
Chaque billet doit permettre l'ajout de commentaires, qui pourront être modérés dans l'interface d'administration au besoin.

L'interface d'administration sera protégée par mot de passe. La rédaction de billets se fera dans une interface WYSIWYG basée sur TinyMCE, pour que Jean n'ait pas besoin de rédiger son histoire en HTML (on comprend qu'il n'ait pas très envie !).

Le code sera construit sur une architecture MVC. Vous développerez autant que possible en orienté objet. Au minimum, le modèle doit être construit sous forme d'objet.

Installer les dépendances avec [composer](https://getcomposer.org/).

```bash
composer install
```

Créer la BDD et migrer les données accessibles dans le repertoire db.
