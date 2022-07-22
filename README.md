[![CI-CD-Dev](https://github.com/PACMS/PA-CMS-Restaurant/actions/workflows/CI-CD-Dev.yml/badge.svg?branch=develop)](https://github.com/PACMS/PA-CMS-Restaurant/actions/workflows/CI-CD-Dev.yml)
[![CI-CD-Dev](https://github.com/PACMS/PA-CMS-Restaurant/actions/workflows/CI-CD-Prod.yml/badge.svg?branch=main)](https://github.com/PACMS/PA-CMS-Restaurant/actions/workflows/CI-CD-Prod.yml)

# PA-CMS-Restaurant

## Sommaire

- [Design Patterns](#design-patterns)
- [Observer](#observer-vivian-ruhlmann-lucas-ramis)
- [Singleton](#singleton)

## Design Patterns

### [Observer](https://refactoring.guru/design-patterns/observer) ([Vivian Ruhlmann](https://github.com/Loviflo), [Lucas Ramis](https://github.com/RamisL))

L’Observateur est un patron de conception comportemental qui permet de mettre en place un mécanisme de souscription pour envoyer des notifications à plusieurs objets, au sujet d’événements concernant les objets qu’ils observent.

#### Utilisation

Ce design pattern permet dans notre application d'enregistrer les connexions, les déconnexions et les tentatives de connexion des utilisateurs pour par la suite les enregistrer dans la base de données.

#### Emplacement dans le code

Voici dans un premier lieu l'emplacement de [l'interface](./www/Core/Auth.class.php#L5-L8) pour obliger les observer implémentant cette interface à implémenter la méthode `callback()`.

Voici l'emplacement du [subject](www/Core/Auth.class.php#L10-L50), c'est la classe principale, elle permet d'appeler les méthodes `update()` des observers.

Voici l'emplacement de l'observer, le [LoggerObserver](www/Core/LoggerObserver.class.php). Cette observer permet, en fonction de l'évenement reçu, d'insérer en base données l'évenement dans une table logs.

##### Voici maintenant les emplacements des appels des méthodes `notify()` :

###### Login event :

- [Connexion classique](www/Core/Sql.class.php#L283-L287)
- [Connexion avec Google connect](www/Controller/User.class.php#L237-L241)
- [Connexion avec Facebook connect](www/Controller/User.class.php#L295-L299)

###### Logout event :

- [Déconnexion](www/Controller/User.class.php#L414-L418)

###### Login attempt event :

- [Tentative de connexion](www/Core/Sql.class.php#L300-L304)

### [Singleton](https://refactoring.guru/design-patterns/singleton)

L’Observateur est un design pattern qui sert à garder une unicité lors d'un appel de classe. Il est utilisé généralement pour faire des connexions à une base de données. Il va créer une instance en stockant l'object construit. Si lors d'un appel dans notre code nous aimerions encore une fois appellé ce même objet, au lieu de le reconstruire il nous suffit de récupérer celui déjà créée grâce au singleton.

#### Utilisation

Le singleton ici sert à l'appel de notre classe PDO pour permettre une connexion à une base de données.

#### Emplacement dans le code

Le singleton ce situe dans notre classe [PDO](./www/Core/Pdo.class.php).
On définie une variable static instance avec la valeur null [instance](./www/Core/Pdo.class.php#L8).

Pour appeler le constructeur de notre pdo, nous n'avous plus qu'à faire appel au [`getInstance()`](./www/Core/Pdo.class.php#L29-L35)

##### Voici maintenant les emplacements des appels des méthodes `getInstance()` :

###### SQL class :

- [Connexion à la database](./www/Core/Sql.class.php#L32)

###### MysqlBuilder :

- [`fetch()`](www/Core/MysqlBuilder.php#L160)
- [`fetchAll()`](www/Core/MysqlBuilder.php#L168)
- [`execute()`](www/Core/MysqlBuilder.php#L182)

### [MysqlBuilder](https://refactoring.guru/design-patterns/singleton)

Pour le MysqlBuilder on s'est inspiré du QueryBuilder qui est un design patern ayant pour but de retourner les requêtes SQL afin de les executer par la suite.

#### Utilisation

Nous l'avons adapté pour qu'il puisse aussi exécuter les requètes et nous les retourner en objet de classe.

#### Emplacement dans le code

Le MysqlBuilder se situe dans notre classe [MysqlBuilder](./www/Core/MysqlBuilder.php)

Voici quelques exemples de la où nous utilisons notre MysqlBuilder dans le code.

- [updateMeal](./www/Controller/Meal.class.php#L180-L226)
- [getFoodStatsByMeal](./www/Controller/Food.class.php#L122-L159)

Globalement, dans le dossier [Controller](./www/Controller) nous utilisons un peu partout le MysqlBuilder.

