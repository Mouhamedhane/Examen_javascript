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
            if(isset($_GET['delete']) && !empty($_GET['delete'])) {
                $id_question = $_GET['delete'];

                $delete_question_query = $connect->prepare("DELETE FROM question WHERE id_question = ?");
                $delete_question_query->execute([$id_question]);

                $delete_answers_query = $connect->prepare("DELETE FROM reponse WHERE id_question = ?");
                $delete_answers_query->execute([$id_question]);

                header("Location: admin.php");
                exit(); 
            }

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
                echo '<form action="" method="GET">';
                echo '<input type="hidden" name="delete" value="' . $row['id_question'] . '">';
                echo '<input type="submit" value="Supprimer">';
                echo '</form>';
                echo "<br>";
            }
        } catch (PDOException $e) {
            echo "Une erreur est survenue : " . $e->getMessage();
        }
        ?>
        <div class="img_admin"><img src="image/admin.webp" alt=""></div>
    </div>
</body>
</html>
