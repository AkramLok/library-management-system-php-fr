## Description:
Librio est une application web de gestion de bibliothèque pour administrateurs, développée en HTML, CSS, JS, AJAX, PHP et Bootstrap.
Avec Librio, les administrateurs peuvent profiter d'une expérience conviviale et intuitive. L'application offre des fonctionnalités avancées telles que la recherche de livres, la gestion des emprunts et la gestion complète de la bibliothèque. Que vous souhaitiez consulter l'état des stocks, ajouter de nouveaux livres à la collection ou suivre les emprunts, Librio permet aux administrateurs de gérer les utilisateurs, d'ajouter de nouvelles entrées et de générer des rapports détaillés sur les activités de la bibliothèque.

## Database
La base de données comporte cinq tables principales (users, admins, exemplaire, emprunt et livre).

## Technologies
* HTML
* CSS
* JavaScript
* JQuery
* AJAX
* PHP
* Bootstrap
* WAMP
* MySQL
## Fonctionnalités
Ce projet propose un système de gestion de bibliothèque avec les fonctionnalités classiques que l'on retrouve dans une bibliothèque traditionnelle :

### Gestion des livres
Affichage de la liste complète des livres disponibles dans la bibliothèque.
Recherche facile d'un livre en utilisant des critères tels que le titre, l'auteur ou l'ISBN.
Possibilité d'ajouter, de supprimer et de modifier les informations relatives à un livre.
Gestion des exemplaires : ajout et suppression d'exemplaires pour chaque livre.

### Gestion des usagers
Consultation de la liste complète des usagers inscrits auprès de la bibliothèque.
Recherche rapide d'un usager en utilisant des filtres tels que le nom, l'identifiant ou le numéro de membre.
Ajout, suppression et modification des informations relatives aux usagers, y compris leur nom, leur adresse, etc.

### Gestion des emprunts
Possibilité pour les usagers d'emprunter des livres, en enregistrant la date d'emprunt et la date de retour prévue.
Processus de retour des livres empruntés à la bibliothèque.
Consultation facile de la liste des emprunts en cours, affichant les livres empruntés par chaque usager et leurs dates d'emprunt.
Accès à un historique complet des emprunts passés, avec les dates d'emprunt et de retour pour chaque exemplaire emprunté.

## Setup
1. Installer WAMP :
   Téléchargez et installez WAMP à partir du site officiel. Assurez-vous de choisir la version appropriée pour votre système d'exploitation (WAMP 64 bits ou 32 bits).

2. Cloner ou télécharger le dépôt "librio" :
   Récupérez les fichiers du projet "librio" en clonant le dépôt depuis un système de contrôle de version comme Git ou en téléchargeant le fichier ZIP du projet depuis sa source.

3. Déplacer le projet dans le dossier approprié :
   Placez le dossier du projet "librio" à l'intérieur du répertoire "www" de votre installation WAMP. L'emplacement peut être "C:\wamp64\www\" ou "C:\wamp\www\" en fonction de la version de WAMP que vous avez installée.

4. Démarrer WAMP ou XAMPP :
   Lancez le panneau de contrôle de WAMP ou XAMPP et démarrez les services Apache et MySQL (double-click wamp et vérifie que les services sont démarrés).

5. Importer la base de données :
   Accédez à phpMyAdmin en entrant "localhost/phpmyadmin/" dans votre navigateur web. Connectez-vous en utilisant le nom d'utilisateur "root" (sans mot de passe). Ensuite, créez une nouvelle base de données nommée "biblio". Une fois la base de données créée, rendez-vous dans l'onglet "Importation" et importez la dernière version du fichier de base de données "biblio.sql" situé dans le dossier "db" du projet "librio".

6. Accéder à l'application web :
   Ouvrez votre navigateur web (par exemple, Chrome) et saisissez "localhost/librio/" dans la barre d'adresse. Vous devriez être redirigé vers la page de connexion de l'application web "librio".

7. Se connecter au tableau de bord :
   Utilisez les identifiants de connexion trouvés dans la base de données importée pour vous connecter au tableau de bord de "librio". Comme vous avez mentionné que le tableau de bord est en français, vous devrez peut-être utiliser les informations de connexion appropriées en français.

Si tout a été configuré correctement, vous devriez maintenant avoir accès au tableau de bord de "librio" et vous pouvez commencer à utiliser l'application. Si vous rencontrez des problèmes lors du processus de configuration, vérifiez à nouveau les étapes.
