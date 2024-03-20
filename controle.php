<?php
require_once("connexion.php");

function supprimerJoueur($nom) {
    global $connect;
    $query = $connect->prepare("DELETE FROM joueur WHERE nom = ?");
    $query->execute([$nom]);
    return $query;
}

function masquerJoueur($nom) {
    global $connect;
    $query = $connect->prepare("UPDATE joueur SET masque = 1 WHERE nom = ?");
    $query->execute([$id]);
    return $query;
}
?>
