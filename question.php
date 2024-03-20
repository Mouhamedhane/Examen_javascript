<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Question</title>
</head>
<body>
    <div class="logo">
        <img src="logo.png">
        <ul>
            <li><a href="admin.php">Menu</a></li>
            <li><a href="#">Paramètres</a></li>
            <li><a href="profil_admin.php">Profil</a></li>
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="group">
        <h1>Liste des questions <br> ADMIN PAGE</h1>
        <?php
        require_once("connexion.php");

        try {
            $query = $connect->query("
                SELECT q.id_question, q.libelle AS question, GROUP_CONCAT(r.libelle SEPARATOR ', ') AS reponses
                FROM question q
                LEFT JOIN reponse r ON q.id_question = r.id_question
                GROUP BY q.id_question
            ");

            $donnees = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($donnees as $row) {
                echo "<h3> " . $row['question'] . "</h3>";
                $reponses = explode(", ", $row['reponses']);
                foreach ($reponses as $reponse) {
                    echo '<input type="radio" name="question_' . $row['id_question'] . '" value="' . $reponse . '"> ' . $reponse . '<br>';
                }
                echo '<form action="modifier_question.php" method="GET">';
                echo '<input type="hidden" name="id_question" value="' . $row['id_question'] . '">';
                echo '<input type="submit" value="Modifier">';
                echo '</form>';
                echo "<br>";
            }
        } catch (PDOException $e) {
            echo "Une erreur est survenue : " . $e->getMessage();
        }
        ?>
        <div class="add-question-form">
            <h2>Ajouter une nouvelle question</h2>
            <form action="ajouter_question.php" method="POST">
                <label for="nouvelle_question">Question:</label><br>
                <input type="text" id="nouvelle_question" name="nouvelle_question" required><br>
                <label for="reponses">Réponses (séparées par des virgules):</label><br>
                <input type="text" id="reponses" name="reponses" required><br>
                <input type="submit" value="Ajouter">
            </form>
        </div>
    </div>
</body>
</html>
