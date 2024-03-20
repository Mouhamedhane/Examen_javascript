<?php
require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['libelle'], $_POST['nbre_point'])) {
        $libelle = $_POST['libelle']; 
        $nbre_point = $_POST['nbre_point']; 
        
        $query = $connect->prepare("INSERT INTO question (libelle, nbre_point) VALUES (?, ?)"); 
        $testquery = $query->execute([$libelle, $nbre_point]); 
        if ($testquery) {
            echo "Bien inséré";
        } else {
            echo "Erreur lors de l'insertion";
        }
    } else {
        echo "Les données nécessaires ne sont pas définies";
    }
}

$query = $connect->query("SELECT * FROM question");
$list = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
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
        <h1>creer votre question</h1>
        <form method="POST" action="">
            <input class="libelle" type="text" placeholder="libellé" name="libelle" required /> 
            <input class="nbre_point" type="text" placeholder="nombre de point" name="nbre_point" required />
            <input class="reponse" type="text" placeholder="reponse" name="reponse" required />
            <button type="submit">valider</button>
        </form>
    </div>
</body>
</html>
