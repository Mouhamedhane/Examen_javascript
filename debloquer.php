<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
