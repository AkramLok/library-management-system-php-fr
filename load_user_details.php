<?php
    include 'db.php';

    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];

    $sql = "SELECT Statut, Adresse, Email
            FROM users
            WHERE Nom = '$nom' AND Prenom = '$prenom'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    echo json_encode($row);
?>
