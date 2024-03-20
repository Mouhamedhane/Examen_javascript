<?php
require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['passwd'], $_POST['type'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
        $type = $_POST['type'];

        $query = $connect->prepare("INSERT INTO joueur (nom_joueur, prenom_joueur, login_joueur, password_joueur, role) VALUES (?, ?, ?, ?, ?)");
        $testquery = $query->execute([$nom, $prenom, $login, $passwd, $type]);

        if ($testquery) {
            echo "Bien inséré";
        } else {
            echo "Erreur lors de l'insertion";
        }
    } else {
        echo "Les données nécessaires ne sont pas définies";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inscription.css">
    <title>Quiz</title>
</head>
<body>
    <div class="signUpCard">
        <h1>Inscription</h1>
        <form id="loginForm" method="POST" action="">
            <input class="name" type="text" placeholder="Nom" id="nom" name="nom" required>
            <input class="name" type="text" placeholder="Prénom" id="prenom" name="prenom" required>
            <input class="rem_textbox" type="text" placeholder="Login" id="login" name="login" required>
            <input class="rem_textbox" type="password" placeholder="Mot de passe" id="passwd" name="passwd" required>
            <input class="rem_textbox" type="text" placeholder="Type" id="type" name="type" required>
            <button id="envoyer" type="submit" disabled>S'inscrire</button>
        </form>
        <span>Vous avez un compte ?</span>
        <a class="h-center" href="./index.php">Se connecter</a>
        <div id="error-message"></div> 
    </div>
    <script>
        var form = document.querySelector('.signUpCard'); 
        var nom = document.getElementById('nom');
        var prenom = document.getElementById('prenom');
        var login = document.getElementById('login');
        var passwd = document.getElementById('passwd');
        var type = document.getElementById('type'); 
        var errorsDiv = document.getElementById('error-message'); 
        var button = document.getElementById('envoyer');

        form.addEventListener('input', validateForm);

        function validateForm() {
            errorsDiv.innerHTML = '';
            var hasErrors = false;

            if (nom.value === '') {
                displayError('Veuillez saisir le nom.');
                hasErrors = true;
            }

            if (prenom.value === '') {
                displayError('Veuillez saisir le prénom.');
                hasErrors = true;
            }

            if (login.value === '') {
                displayError('Veuillez saisir le pseudo.');
                hasErrors = true;
            }

            if (passwd.value === '') {
                displayError('Veuillez saisir le mot de passe.');
                hasErrors = true;
            }

            if (type.value === '') {
                displayError('Veuillez saisir le type.');
                hasErrors = true;
            }

            button.disabled = hasErrors;
        }

        function displayError(errorMessage) {
            var errorPara = document.createElement('p');
            errorPara.classList.add('error');
            errorPara.textContent = errorMessage;
            errorsDiv.appendChild(errorPara);
        }
    </script>
</body>
</html>
