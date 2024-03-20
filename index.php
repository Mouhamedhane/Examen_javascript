<?php
require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"]) && isset($_POST["passwd"])) {
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];

        try {
            $sql_joueur = "SELECT * FROM joueur WHERE login_joueur = ? AND password_joueur = ?";
            $query_joueur = $connect->prepare($sql_joueur);
            $query_joueur->execute([$login, $passwd]);

            $sql_admin = "SELECT * FROM admin WHERE login_admin = ? AND password_admin = ?";
            $query_admin = $connect->prepare($sql_admin);
            $query_admin->execute([$login, $passwd]);

            if ($query_joueur->rowCount() === 1 || $query_admin->rowCount() === 1) {
                $user = ($query_joueur->rowCount() === 1) ? $query_joueur->fetch(PDO::FETCH_ASSOC) : $query_admin->fetch(PDO::FETCH_ASSOC);

                if ($user['role'] == 'admin') {
                    header("Location: ./admin.php");
                    exit();
                } else {
                    header("Location: ./joueur.php");
                    exit();
                }
            } else {
                echo "Erreur de connexion";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #eceff1;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            font-style: normal;
        }

        body button:focus {
            outline: 0;
        }

        .signInCard {
            width: 90%; 
            max-width: 400px; 
            background: #ffffff;
            box-shadow: 2px 2px 8px 2px #e0e0e0, -2px -2px 8px 2px #e0e0e0;
            border-radius: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 64px 50px;
        }

        .signInCard h1 {
            font-weight: 900;
            color: #7e57c2;
            text-align: center;
            margin: 0 auto 64px;
        }

        .signInCard form {
            display: block;
            margin: 0 auto;
        }

        .signInCard form input {
            width: 100%;
            height: 38px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #c0c0c0;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 1rem;
        }

        .signInCard a {
            font-size: 1rem;
            color: #7e57c2;
            cursor: pointer;
            display: block;
            margin-bottom: 64px;
            text-align: right;
            text-decoration: none;
        }

        .signInCard a:hover {
            color: #4d2c90;
        }

        .signInCard button {
            display: block;
            margin: 0 auto 64px;
            background-color: #7e57c2;
            width: 100%; 
            padding: 6px;
            border: 1px solid #7e57c2;
            border-radius: 8px;
            font-family: 'Roboto', sans-serif;
            font-style: normal;
            font-weight: bold;
            font-size: 20px;
            color: #ffffff;
            cursor: pointer;
        }

        .signInCard button:hover {
            background-color: #4d2c90;
            border: 1px solid #4d2c90;
        }

        .signInCard span {
            display: block;
            margin: 10px auto;
            text-align: center;
        }

        #error {
            color: red;
            font-weight: bold;
        }

        @keyframes changeColor {
            0% { color: #7e57c2; }
            50% { color: #ff5722; }
            100% { color: #7e57c2; }
        }

        h1 {
            animation: changeColor 5s infinite; 
        }

        @media (max-width: 600px) {
            .signInCard {
                width: 90%;
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
<div class="signInCard">
    <h1>BIENVENUE DANS QUIZZ IAM</h1>
    <form id="loginForm" method="POST" action="">
        <input type="email" name="login" id="login" placeholder="EMAIL OU TELEPHONE"> <br>
        <input type="password" name="passwd" id="passwd" placeholder="MOT DE PASSE"><br>
        <button type="submit">Connecter</button>
    </form>
    <span>Avez-vous un compte ?</span>
    <a class="sign-up" href="inscription.php">Créer un compte !</a>
    <div id="error"></div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById("loginForm");

            form.addEventListener("submit", function(event) {
                event.preventDefault();

                var login = document.getElementById("login").value;
                var passwd = document.getElementById("passwd").value;
                var errorMessage = "";

                if (login.trim() === "") {
                    errorMessage += "<br> Veuillez saisir votre login.";
                }
                if (passwd.trim() === "") {
                    errorMessage += "<br> Veuillez saisir votre mot de passe.";
                }

                var errorElement = document.getElementById('error');
                errorElement.innerHTML = errorMessage; 

                if (errorMessage === "") {
                    this.submit();
                }
            });
        });

</script>
</body>
</html>
