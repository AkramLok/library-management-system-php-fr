<?php
include 'db.php';

if(isset($_GET['nom'])) {
    $nom = $_GET['nom'];

    $sql = "SELECT Prenom FROM users WHERE Nom = '$nom'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $prenom = $row['Prenom'];
            echo "<option value='$prenom'>$prenom</option>";
        }
    } else {
        echo "<option>Aucun prénom trouvé</option>";
    }
} else {
    echo "<option>Erreur de requête</option>";
}
?>
