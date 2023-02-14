<?php

/**
 * 1. Importez la table user dans une base de données que vous aurez créée au préalable via PhpMyAdmin
 * 2. En utilisant l'objet de connexion qui a déjà été défini =>
 *    --> Remplacez les informations de connexion ( nom de la base et vérifiez les paramètres d'accès ).
 *    --> Supprimez le dernier utilisateur de la liste, faites une capture d'écran dans PhpMyAdmin pour me montrer que vous avez supprimé l'entrée et pushez la avec votre code.
 *    --> Faites un truncate de la base de données, les auto incréments présents seront remis à 0
 *    --> Insérez un nouvel utilisateur dans la table ( faites un screenshot et ajoutez le au repo )
 *    --> Finalement, vous décidez de supprimer complètement la table
 *    --> Et pour finir, comme vous n'avez plus de table dans la base de données, vous décidez de supprimer aussi la base de données.
 */

$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'base_exercice';



try {

    $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);
    $maConnexion->beginTransaction();

    $user = "DELETE FROM user WHERE id = 2";

    $maConnexion->exec($user);

    $user = "TRUNCATE TABLE user";

    $maConnexion->exec($user);

    $user = "
         INSERT INTO user (nom, prenom, rue, numero, code_postal, ville, pays, mail)
         VALUES ('Scotte', 'Vimme', 'Rue du rubban', '7', '59610', 'Fourmies', 'France', 's.vimme@gmail.com')
    ";

    $maConnexion->exec($user);

    $user = "DROP TABLE user";

    $maConnexion->exec($user);

    $user = "DROP DATABASE $db";

    $maConnexion->exec($user);

    $maConnexion->commit();
}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();
}