<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de contrôle des joueurs</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        #conteneur {
            text-align: center;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .blocked {
            background-color: #f44336; 
        }

        .deleted {
            background-color: #bdbdbd; 
        }
    </style>
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
        <h1>Menu des joueurs </h1>
        <div class="img_admin"><img src="image/admin.webp" alt=""></div>
    </div>

    <div id="conteneur">
        <h2>Liste des joueurs</h2>
        <table border="2px">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Login</th>
                <th>Action</th>
            </tr>
            <?php 
            require_once("connexion.php");
            $query = $connect->query("SELECT nom_joueur, prenom_joueur, login_joueur FROM joueur");
            $joueurs = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($joueurs as $joueur): ?>
                <tr id="joueur_<?php echo $joueur['nom_joueur']; ?>">
                    <td><?php echo $joueur['nom_joueur']; ?></td>
                    <td><?php echo $joueur['prenom_joueur']; ?></td>
                    <td><?php echo $joueur['login_joueur']; ?></td>
                    <td>
                        <button id="btn_supprimer_<?php echo $joueur['nom_joueur']; ?>" onclick="supprimerJoueur('<?php echo $joueur['nom_joueur']; ?>')" style="background-color: red" >Supprimer</button>
                        <button id="btn_bloquer_<?php echo $joueur['nom_joueur']; ?>" onclick="bloquerJoueur('<?php echo $joueur['nom_joueur']; ?>')" style="background-color: blue" >Bloquer</button>
                        <button id="btn_debloquer_<?php echo $joueur['nom_joueur']; ?>" onclick="debloquerJoueur('<?php echo $joueur['nom_joueur']; ?>')" style="background-color: green">Débloquer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script>
        function supprimerJoueur(id) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce joueur ?")) {
                envoyerRequete("supprimer.php", "id=" + id, function(response) {
                    if (response === "success") {
                        document.getElementById("id_joueur" + id).style.display = "none";
                    } else {
                        alert("Erreur lors de la suppression du joueur.");
                    }
                });
            }
        }

        function bloquerJoueur(id) {
            if (confirm("Êtes-vous sûr de vouloir bloquer ce joueur ?")) {
                envoyerRequete("bloquer.php", "id=" + id, function(response) {
                    if (response === "success") {
                        document.getElementById("joueur_" + id).classList.add('blocked');
                    } else {
                        alert("Erreur lors du blocage du joueur.");
                    }
                });
            }
        }

        function debloquerJoueur(id) {
            envoyerRequete("debloquer.php", "id=" + id, function(response) {
                if (response === "success") {
                    document.getElementById("joueur_" + id).classList.remove('blocked');
                    document.getElementById("joueur_" + id).classList.remove('deleted');
                } else {
                    alert("Erreur lors du déblocage du joueur.");
                }
            });
        }

        function envoyerRequete(url, data, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        callback(xhr.responseText);
                    } else {
                        callback(null);
                    }
                }
            };
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(data);
        }
    </script>
</body>
</html>
