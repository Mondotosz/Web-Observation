# Web-Observation

Projet Web

## Installation

### conditions requises

-   php v. 7+
    -   extensions
        -   gd
        -   fileinfo
-   node/npm (uniquement si vous n'utilisez pas la release)
-   composer (uniquement si vous n'utilisez pas la release)

### Installation depuis la dernière release

Toutes les librairies sont deja dans le dossier .zip

1. Décompresser l'archive
2. Modifier les credentials du serveur d'email dans model/sendmail.php
3. Lancer le serveur php à la racine du projet `php -S ip:port`

### Installation via git

```bash
# Téléchargement du repertoire
git clone https://github.com/Mondotosz/Web-Observation.git

cd Web-Observation
# téléchargement des dépendances
npm install
composer install
# (optionnel) importer les données par défaut
cp ./data/example.users.json ./data/users.json
cp ./data/example.posts.json ./data/posts.json
# modification des identifiants pour le serveur de mails
# $mail->Host       = 'mail.domain.com';   //Set the SMTP server to send through
# $mail->Username   = 'example@domain.com';//SMTP username
# $mail->Password   = 'password';          //SMTP password
vim ./model/sendmail.php
# lancer le serveur php (remplacer localhost et 8000 par les valeurs nécessaires)
php -S localhost:8000
```
