<?php
    $conn = mysqli_connect("localhost", "root", "", "biblio");
    session_start();
    
    $id = $_SESSION['id'];
    $sql = "SELECT email FROM admins WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $name = mysqli_fetch_array($result)[0];

    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }     
?>