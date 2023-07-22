<?php
$conn = mysqli_connect("localhost", "root", "", "biblio");

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $sql = "SELECT titre_livre, maison_edition, Auteur, Nb_des_pages FROM Livre WHERE isbn = '$isbn'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $bookDetails = mysqli_fetch_assoc($result);
        echo json_encode($bookDetails);
    }
}
?>
