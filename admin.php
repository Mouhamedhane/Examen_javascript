<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil de l'administrateur</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body> 
    <div class="logo">
        <img src="logo.png">
        <ul>
            <li><a href="#">Menu</a></li>
            <li><a href="#">Paramètres</a></li>
            <li><a href="profil_admin.php">Profil</a></li>
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect" >Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="group">
        <h1>Bienvenue sur la page d'acceuil <br> ADMINISTRATEUR</h1>
        <ul class="nav-links">
            <li><a href="question.php">Liste des Questions</a></li>
            <li><a href="controler_joueur.php">Controler  les Joueurs</a></li>
            <li><a href="enregistrer_admin.php">Enregistrement d'un Admin</a></li>
            <li><a href="creer_question.php">Créer une Question</a></li>
        </ul>
        <div class="img_admin"><img src="image/admin.webp" alt=""></div>
    </div>
</body>
</html>
