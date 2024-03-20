<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Quiz</title>
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
        <h1>Quiz</h1>
        <div id="quizContainer">
            <form id="quizForm">
                <?php
                require_once("connexion.php");

                try {
                    $query = $connect->query("
                        SELECT q.id_question, q.libelle AS question, GROUP_CONCAT(r.libelle SEPARATOR ',') AS reponses
                        FROM question q
                        LEFT JOIN reponse r ON q.id_question = r.id_question
                        GROUP BY q.id_question
                    ");

                    $questions = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($questions as $question) {
                        echo "<h3>" . $question['question'] . "</h3>";
                        $reponses = explode(',', $question['reponses']);
                        foreach ($reponses as $reponse) {
                            echo '<label><input type="radio" name="question_' . $question['id_question'] . '" value="' . $reponse . '">' . $reponse . '</label><br>';
                        }
                    }
                } catch (PDOException $e) {
                    echo "Une erreur est survenue : " . $e->getMessage();
                }
                ?>
                <input type="submit" value="Terminer le quiz">
            </form>
        </div>
        <div id="scoreContainer" class="score" style="display:none;">
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#quizForm', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'submit_quiz.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#scoreContainer').html(response).show();
                    }
                });
            });
        });
    </script>
    <style>
        #quizContainer {
    margin-bottom: 20px;
}

#quizContainer form {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
}

#quizContainer h3 {
    margin-bottom: 10px;
}

#quizContainer label {
    display: block;
    margin-bottom: 5px;
}

#quizContainer input[type="radio"] {
    margin-right: 5px;
}

#quizContainer input[type="submit"] {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
#scoreContainer {
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    color: #007bff;
}
    </style>
</body>
</html>
