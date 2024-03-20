<?php
include 'connexion.php';


$stmt = $connect->query("SELECT * FROM ma_table");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
}
?>
