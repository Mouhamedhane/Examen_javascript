<?php
require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scoreTotal = 0;

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question_') !== false) {
            if ($value == 'correct') { 
                $scoreTotal += 5; 
            } else {
                $scoreTotal += 0; 
            }
        }
    }

    echo json_encode(array('score' => $scoreTotal));
} else {
    $questionsPerPage = 3;

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $startIndex = ($currentPage - 1) * $questionsPerPage;

    $query = $connect->prepare("
        SELECT q.id_question, q.libelle AS question, GROUP_CONCAT(r.libelle SEPARATOR ', ') AS reponses
        FROM question q
        LEFT JOIN reponse r ON q.id_question = r.id_question
        GROUP BY q.id_question
        LIMIT :startIndex, :questionsPerPage
    ");

    $query->bindParam(':startIndex', $startIndex, PDO::PARAM_INT);
    $query->bindParam(':questionsPerPage', $questionsPerPage, PDO::PARAM_INT);
    $query->execute();

    $questionsToShow = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($questionsToShow as $row) {
        echo "<div class='question-container'>";
        echo "<div class='question-text'>" . $row['question'] . "</div>";
        $reponses = explode(", ", $row['reponses']);
        foreach ($reponses as $reponse) {
            echo '<div class="answer-option"><label><input type="radio" name="question_' . $row['id_question'] . '" value="' . ($reponse == 'vrai' ? 'correct' : 'incorrect') . '"> ' . $reponse . '</label></div>';
        }
        echo "</div>"; 
    }
}
?>
