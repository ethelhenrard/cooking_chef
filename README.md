# Si vous récupérez mon projet

Installer les dépendances :
```shell script
composer install
npm install
```

Créer le fichier .env.local (et modifier son contenu) :
```dotenv
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
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