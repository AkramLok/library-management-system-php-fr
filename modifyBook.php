<?php
$conn = mysqli_connect("localhost", "root", "", "biblio");
session_start();

$id = $_SESSION['id'];
$sql = "SELECT email FROM admins WHERE id = '$id';";
$result = mysqli_query($conn, $sql);
$name = mysqli_fetch_array($result)[0];

if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit;
}

// Fetch valid ISBNs from the Livre table
$isbnQuery = "SELECT isbn, titre_livre, maison_edition, Auteur, Nb_des_pages FROM Livre";
$isbnResult = mysqli_query($conn, $isbnQuery);
$isbnOptions = '';

if ($isbnResult && mysqli_num_rows($isbnResult) > 0) {
    while ($isbnRow = mysqli_fetch_assoc($isbnResult)) {
        $isbnOptions .= "<option value='" . $isbnRow['isbn'] . "'>" . $isbnRow['isbn'] . "</option>";
    }
}

if (isset($_POST['Save'])) {
    $isbn = $_POST['Isbn'];
    $titre_livre = $_POST['Titre_livre'];
    $maison_edition = $_POST['Maison_edition'];
    $auteur = $_POST['Auteur'];
    $nb_des_pages = $_POST['Nb_des_pages'];

    $sql = "SELECT Livre_id, titre_livre, maison_edition, Auteur, Nb_des_pages
            FROM Livre
            WHERE isbn = '$isbn';";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $livre_id = $row['Livre_id'];

        $sql = "UPDATE Livre 
                SET isbn = '$isbn', titre_livre = '$titre_livre', maison_edition = '$maison_edition', Auteur = '$auteur',
                Nb_des_pages = '$nb_des_pages' 
                WHERE Livre_id = '$livre_id';";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['SuccessMessage'] = "Vous avez mis à jour un livre avec succès";
        } else {
            $_SESSION['ErrorMessage'] = "Une erreur s'est produite lors de la mise à jour du livre";
        }
    } else {
        $_SESSION['ErrorMessage'] = "Livre non trouvé";
    }
}
?>

<!doctype html>
<html>

<head>
    <?php include('head.php') ?>
    <script>
        function populateFields() {
            var isbn = document.getElementById('isbn').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_book_details.php?isbn=' + isbn, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var bookDetails = JSON.parse(xhr.responseText);
                    document.getElementById('titre_livre').value = bookDetails.titre_livre;
                    document.getElementById('maison_edition').value = bookDetails.maison_edition;
                    document.getElementById('auteur').value = bookDetails.Auteur;
                    document.getElementById('nb_des_pages').value = bookDetails.Nb_des_pages;
                }
            };
            xhr.send();
        }
    </script>
</head>

<body>
    <?php include('navbar.php') ?>
    <div>
        <h1>Modifier livre</h1>
        <hr>
        <form action="" method="POST" class="col-12 col-md-12" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="isbn">ISBN</label>
                <select class="form-control" name="Isbn" id="isbn" onchange="populateFields()" required>
                    <option value="">Sélectionnez un ISBN</option>
                    <?php echo $isbnOptions; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="titre_livre">Titre livre</label>
                <input type="text" class="form-control" name="Titre_livre" id="titre_livre" required>
            </div>
            <div class="mb-4">
                <label for="maison_edition">Maison edition</label>
                <input type="text" class="form-control" name="Maison_edition" id="maison_edition" required>
            </div>
            <div class="mb-4">
                <label for="auteur">Auteur</label>
                <input type="text" class="form-control" name="Auteur" id="auteur" required>
            </div>
            <div class="mb-4">
                <label for="nb_des_pages">Nombre des pages</label>
                <input type="text" class="form-control" name="Nb_des_pages" id="nb_des_pages" required>
            </div>
            <button type="submit" class="col-md-2 mb-2 btn btn-info text-white" name="Save">Save changes</button>
        </form>
    </div>
    <?php include('script.php') ?>
</body>

</html>
