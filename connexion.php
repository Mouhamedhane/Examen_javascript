<?php
$dbhost = 'mysql-mouha11.alwaysdata.net';
$dbname = 'mouha11_bd';
$dbuser = 'mouha11_bd';
$dbpswd = 'Azerty11*';

try {
    $connect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpswd, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ));
} catch (PDOException $e) {
    die("Une erreur est survenue lors de la connexion à la Base de données  !");
}
?>