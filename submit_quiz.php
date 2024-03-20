<?php
require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scoreTotal = 0;

    try {
        $query = $connect->query("
            SELECT id_question, libelle AS reponse_correcte
            FROM reponse
            WHERE choix = 'vrai'
        ");

        $reponsesCorrectes = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question_') !== false) {
                $questionId = substr($key, strpos($key, '_') + 1); 
                foreach ($reponsesCorrectes as $reponseCorrecte) {
                    if ($questionId == $reponseCorrecte['id_question'] && $value == $reponseCorrecte['reponse_correcte']) {
                        $scoreTotal += 5;
                        break; 
                    }
                }
            }
        }

        echo "Votre score final est de : $scoreTotal";
    } catch (PDOException $e) {
        echo "Une erreur est survenue : " . $e->getMessage();
    }
}
?>
