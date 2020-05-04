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





