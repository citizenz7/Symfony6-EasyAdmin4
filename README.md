# Symfony6-EasyAdmin4

Objectif : installer Symfony 6 avec EasyAdmin4

## Prérequis
* Symfony CLI
* Composer
* PHP 8+
* MySQL server (Mariadb)

#### Pas de "front", juste l'admin pour test avec 2 entités :
* Product
* Category

#### EventSubscriber
AdminEventSubscriber.php s'occupe de createdAt et updatedAt

## Installation
```
git clone https://github.com/citizenz7/Symfony6-EasyAdmin4.git
```

```
cd Symfony6-EasyAdmin4
```

Installer tout ce qu'il faut pour Symfony :
```
composer install
```

Créer un nouveau fichier .env.local et configurer votre connexion MySQL (exemple) :
```
DATABASE_URL="mysql://root:password@127.0.0.1:3306/symfony6?serverVersion=10.3.32-MariaDB"
```

Créer la database :
```
symfony console d:d:c
```

Importer les données dans la database :
```
symfony console d:m:m
```

Installer webpack-Encore :
```
yarn install
```

```
yarn dev-server
```

Lancer le serveur Symfony :
```
symfony serve -d
```

Rendez-vous sur http://127.0.0.1:8000/admin
(à adapter selon votre adresse locale)