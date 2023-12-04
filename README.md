# FFBA-DIAZ


### Technologies utilisées 

*XAMPP (Apache, PHP, MySQL, phpMyAdmin) 

*LARAVEL 

*Eloquent (ORM) 

 
### Installation du projet 

Pour installer le projet, suivez les étapes suivantes : 

1.- Installer XAMP 

Pour installer XAMPP, rendez-vous sur la page:  

https://www.apachefriends.org/fr/download.html

Suivez les instructions d'installation. 

 
2.- Installer composer 

Pour installer composer, exécutez les commandes suivantes dans le terminal: 

   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" 

   php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" 

   php composer-setup.php 

   php -r "unlink('composer-setup.php');" 

   sudo mv composer.phar /usr/local/bin/composer 


3.- Installer Laravel  

Vous pouvez utiliser composer, qui est désormais installé, pour installer Laravel globalement sur votre système. Pour ce faire, dans le terminal exécutez la commande suivante : 

   composer create-project laravel/laravel “app-name” 

Cela téléchargera automatiquement tous les fichiers Laravel pertinents et créera un nouveau projet. 

 

4.- Installation de dépendances du projet 

À la racine du projet, exécutez la commande suivante: 

   composer install 


### Configuration de l’API dans le projet  

Pour récupérer des informations de l'API externe The Movie Database (TMDb) il faut faire ce qui suit: 

Tout d'abord, vous devez vous inscrire sur le site web de TMDb et obtenir une clé API. Vous pouvez le faire en créant un compte sur TMDb, puis en générant une clé API à partir des paramètres de votre compte.  

Pour disposer de l'autorisation d'accéder aux informations de l'API, une configuration spécifique devra être effectuée. 

En premier lieu, il faudra créer une variable d'environnement correspondante à la clé d'autorisation de l'API dans le fichier "env". À des fins pratiques, vous pouvez réutiliser la clé suivante déjà existante. 

   TMDB_API_KEY="da30e671936115ccc8bb59d618f91d8d" 

Et en deuxième lieu, dans le fichier "service.php", il faudra ajouter la configuration suivante: 

   'tmdb' => [ 

   'api_key' => env('TMDB_API_KEY'), 

   ], 

### Lancement du projet 

À la racine du projet, exécutez la commande suivante pour lancer le projet. 

   php artisan serve 

Une fois que le projet est en cours d'exécution, Il sera nécessaire de créer la base de données. Pour ce faire, exécutez la commande : 

   php artisan migrate 
 
Lors de l'exécution de la commande, un message indiquera que la base de données n'existe pas et vous demandera si vous souhaitez la créer. Indiquez "oui". Si la base de données n'est pas créée lors de la première tentative, répétez l'opération 

Une fois la base de données créée, récupérez les informations de l'API externe et enregistrez-les dans la base de données en utilisant la commande suivante : 

   php artisan app:fetch-store-films 
 
Enfin, pour que la génération de requêtes fonctionne correctement, il est nécessaire d'installer le client HTTP Guzzle en exécutant la commande suivante à la racine du projet. 

   composer require guzzlehttp/guzzle 

Maintenant, vous pouvez naviguer entre les différentes pages de l'application en utilisant comme base l'adresse du serveur + les routes définies dans le projet. Par exemple : 

"Adresse du serveur" + “/index” 
 
Pour accéder à toutes les pages, utilisez les routes suivantes : 

 
"/index" pour la page principale qui affiche une liste de films 

"/film/{id}" pour la page qui montre les détails d'un film sélectionné 

"/admin/films/index" pour accéder à la page principale du côté administratif 