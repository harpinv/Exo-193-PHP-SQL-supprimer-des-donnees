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
$db = 'bdd_cours';

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
    return $data;
}

try {

    $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);
    $maConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user = "DELETE FROM user WHERE id = 2";

    $result = $maConnexion->exec($user);
    echo $result;

    $user = "TRUNCATE TABLE user";

    $result = $maConnexion->exec($user);
    echo $result;

    $nom = sanitize('Scotte');
    $prenom = sanitize('Vimme');
    $rue = sanitize('Rue du rubban');
    $numero = sanitize('7');
    $code_postal = sanitize('59610');
    $ville = sanitize('Fourmies');
    $pays = sanitize('France');
    $mail = sanitize('s.vimme@gmail.com');


    $user = $maConnexion->prepare("
         INSERT INTO utilisateur (nom, prenom, rue, numero, code_postal, ville, pays, mail)
         VALUES (:Scotte, :Vimme, :Rue du rubban, :7, :59610, :Fourmies, :France, :s.vimme@gmail.com)
    ");

    $user->bindParam(':Scotte', $nom);
    $user->bindParam(':Vimme', $prenom);
    $user->bindParam(':Rue du rubban', $rue);
    $user->bindParam(':7', $numero);
    $user->bindParam(':59610', $code_postal,PDO::PARAM_INT);
    $user->bindParam(':Fourmies', $vlle);
    $user->bindParam(':France', $pays);
    $user->bindParam(':s.vimme@gmail.com', $mail);

    $user = "DROP TABLE user";

    $result = $maConnexion->exec($user);
    echo $result;

    $user = "DROP DATABASE $db";

    $result = $maConnexion->exec($user);
    echo $result;
}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();
}