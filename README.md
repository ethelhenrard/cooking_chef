# Si vous récupérez mon projet

Installer les dépendances :
```shell script
composer install
```

Démarrer le serveur :
```shell script
symfony server:start
```

# Installation d'un projet Symfony

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
# Pour qu'il reste connecté en background et libere le terminal
symfony server:start -d 
```
Installation de Maker (pour générer des fichiers PHP) :
```shell script
composer require maker --dev

Installation du moteur de template Twig :
```shell script
composer req twig
```

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



