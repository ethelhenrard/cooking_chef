# Si vous récupérez mon projet

(supprimer éventuellement les fichiers *.lock pour éviter des problèmes par rapport à la version de PHP)

Installer les dépendances :
```shell script
composer install
npm install
```

Créer le fichier .env.local (et modifier son contenu) :
```dotenv
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
```

Créer la base de données :
```shell script
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

Charger les données de test :
```shell script
php bin/console doctrine:fixtures:load
```

Démarrer la compilation des assets :
```shell script
npm run watch
```

Démarrer le serveur :
```shell script
symfony server:start
```

# Installation d'un projet Symfony

## Télécharger Symfony
Télécharger Symfony via le CLI. Ajouter le flag --full pour installation complète (twig, doctrine...) :
```shell script
symfony new cookingchef
symfony new cookingchef --full
```

Vérifier que PHP est correctement configuré :
```shell script
symfony check:requirements
```

Démarrer le serveur interne de PHP :
```shell script
symfony server:start
```

## Maker
Installation de Maker (pour générer des fichiers PHP) :
```shell script
composer require maker --dev
```

Installation de doctrine/annotation :
```shell script
composer require doctrine/annotations
```

## Créer un controller
Création d'un Controller avec Maker :
```shell script
php bin/console make:controller
```

## Twig
Installation du moteur de template Twig :
```shell script
composer req twig
```

## WebPack Encore
Installation de WebPack Encore (pour la gestion des JS / CSS) :
```shell script
composer req encore
npm install
```

Générer les balises link et script dans les blocs stylesheets et javascripts :
```twig
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}
            {{ encore_entry_link_tags('app') }}
        {% endblock %}
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}
            {{ encore_entry_script_tags('app') }}
        {% endblock %}
    </body>
</html>
```

Démarrer la compilation des assets :
```shell script
npm run watch
```

Activer la compilation du SCSS :
- Renommer le fichier assets/css/app.css --> assets/css/app.scss
- Modifier l'import dans le fichier assets/js/app.js --> ```import '../css/app.scss';```
- Dans le fichier webpack.config.js, décommenter la ligne --> ```//.enableSassLoader()```
```shell script
npm install sass-loader@^7.0.1 node-sass --save-dev
```
Relancer la commande ```npm run watch```

## Doctrine

Installation de Doctrine :
```shell script
composer req orm
```

Créer le fichier .env.local (et modifier son contenu) :
```dotenv
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
```

Créer la base de données :
```shell script
php bin/console doctrine:database:create
```

Créer des entités :
```shell script
php bin/console make:entity
```

Pour l'entité gérant les utilisateurs :
```shell script
php bin/console make:user
```

Créer le fichier de migration et exécuter les migrations :
```shell script
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

En cas de problème avec les migrations, supprimer les fichiers PHP dans le dossier src/Migrations :
```shell script
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

### Fixtures

Installer Doctrine Fixtures :
```shell script
composer require --dev orm-fixtures
```

Générer un fichier de Fixtures :
```shell script
php bin/console make:fixtures
```

Ecrire le code PHP pour créer des données puis :
```shell script
php bin/console doctrine:fixtures:load
```

## Profiler

Installation du profiler pour avoir la debug bar :
```shell script
composer req profiler
```