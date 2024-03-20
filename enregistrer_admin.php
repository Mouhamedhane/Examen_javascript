<?php
require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset( $_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['passwd'], $_POST['type'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
        $type = $_POST['type'];

        $query = $connect->prepare("INSERT INTO admin ( nom_admin, prenom_admin, login_admin, password_admin, role) VALUES ( ?, ?, ?, ?, ?)");
        $testquery = $query->execute([ $nom, $prenom, $login, $passwd, $type]);

        if ($testquery) {
            echo "Bien inséré";
        } else {
            echo "Erreur lors de l'insertion";
        }
    } else {
        echo "Les données nécessaires ne sont pas définies";
    }
}

$query = $connect->query("SELECT * FROM admin");
$list = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="inscription.css" />
    <title>Quiz</title>
</head>
<body>
    <div class="signUpCard">
        <h1>Ajout admin</h1>
        <form method="POST" action="">
            <input class="name" type="text" placeholder="Nom" name="nom" required />
            <input class="name" type="text" placeholder="Prenom" name="prenom" required />
            <input class="rem_textbox" type="text" placeholder="login" name="login" required />
            <input class="rem_textbox" type="password" placeholder="passwd" name="passwd" required />
            <input class="rem_textbox" type="text" placeholder="type" name="type" required />
            <button type="submit">ajouter</button>
        </form>
        <span></span>
    </div>
    <script src="./inscription.js"></script>
</body>
</html>
