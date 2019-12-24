# Projet O'coop 
## Procédure après clonage

## se placer dans le dossier "front"
**yarn** : 
yarn install

## se placer dans le dossier "back"
**composer** :
composer install

**Configuration Base de données**: 

à la racine du dossier "back", creer un fichier: .env.local.

insérer la ligne suivante dans le ".env.local" et remplacer db_user, db_password, db_name par le nom du user, le mot de passe et le nom de la base de données:

``DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7``

en ligne de commande création de la base de données:
``bin/console d:d:c``

**migrations**
``bin/console m:m`` (créer la migration)
``bin/console d:m:m`` (applique la migration, load en bdd)

**fixtures (éventuellement)**
*``bin/console d:f:l`` (pour load les fixtures en bdd)*

**paramètrage du JWT (LexikJWTAuthentificationBundle)**

``mkdir -p config/jwt`` (crée un dossier /jwt dans config/ qui contiendra les clés pub/priv)

``openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096`` (entrer une passphrase exemple: ocoop)

``openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout`` (renseigner la passphrase ex: ocoop)

``JWT_PASSPHRASE=ocoop`` (ligne à ajouter dans le fichier .env.local, avec la passphrase choisi en clair)



## Lancement des serveurs côté Front et Back :

**ouvrir un terminal pour chaque serveur**
### terminal "front" (toujours commencer par le "front")
``yarn start``

### terminal "back"
``bin/console server:start``