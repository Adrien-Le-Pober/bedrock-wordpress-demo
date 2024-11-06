## Étapes de mise en place du dépôt wordpress-develop
### 1. Cloner le dépôt wordpress-develop

À la racine du projet, clonez le dépôt `wordpress-develop` dans un dossier tests. Ce dépôt contient tout le nécessaire pour les tests automatisés sur WordPress.
```bash
git clone https://github.com/WordPress/wordpress-develop.git tests/wordpress-develop
```

### 2. Installer les dépendances

Une fois le dépôt cloné, vous devrez installer les dépendances via Composer. Ce processus récupère tous les fichiers nécessaires pour exécuter les tests de manière fiable.
```bash
cd tests/wordpress-develop
composer update -W
```

### 3. Créer la base de données de test depuis phpmyadmin ou via les commandes MySQL (nom_base`_tests`)

### 4. Créer le fichier de configuration
Dans le dossier `tests/wordpress-develop`, copiez le fichier de configuration `wp-tests-config-sample.php` en `wp-tests-config.php`.
Puis, renseignez les informations de la base de données de test (nom, utilisateur, mot de passe), et le thème à tester.

```php
define( 'WP_DEFAULT_THEME', 'custom' );

define( 'DB_NAME', 'wordpress_tests' );
define( 'DB_USER', 'votre_utilisateur' );
define( 'DB_PASSWORD', 'votre_mot_de_passe' );
define( 'DB_HOST', 'localhost' );
```

### 5. Mettre à jour la configuration de PHPUnit
Dans wordpress-develop/phpunit.xml.dist , faire pointer <directory> sur le répertoire de tests du thème
```xml
...
		<testsuite name="default">
			<directory suffix=".php">../../web/app/themes/custom/tests</directory>
			<exclude>tests/phpunit/tests/rest-api/rest-autosaves-controller.php</exclude>
		</testsuite>
...
```

Pour lancer les tests, placez vous dans le répertoire du Makefile (à la racine du projet), et exécutez :
```bash
make tests
```