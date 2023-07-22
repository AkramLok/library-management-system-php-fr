<?php include 'db.php'; ?>
<!doctype html>
<html>
    <head>
        <title>Librio : Ajouter livre</title>
        <?php include('head.php') ?>
    </head>
    <body>
    <?php
        if(isset($_POST['Save'])){
            $isbn = $_POST['Isbn'];
            $titre_livre = $_POST['Titre_livre'];
            $maison_edition = $_POST['Maison_edition'];
            $auteur = $_POST['Auteur'];
            $nb_des_pages = $_POST['Nb_des_pages'];
        
            // Prepare the statement
            $stmt = $conn->prepare("SELECT Isbn, titre_livre, auteur FROM livre WHERE Isbn = ? OR (titre_livre = ? AND auteur = ?)");
            
            // Bind the parameters
            $stmt->bind_param("sss", $isbn, $titre_livre, $auteur);
            
            // Execute the statement
            $stmt->execute();
            
            // Get the result
            $result = $stmt->get_result();
            
            // Check if a row exists
            if($result->num_rows != 0){
                $_SESSION['ErrorMessage'] = "Already Exist";
            } else {
                // Prepare the INSERT statement
                $insertStmt = $conn->prepare("INSERT INTO livre(isbn, titre_livre, maison_edition, auteur, nb_des_pages, nb_des_exemplaires) VALUES (?, ?, ?, ?, ?, '0')");
                
                // Bind the parameters
                $insertStmt->bind_param("sssss", $isbn, $titre_livre, $maison_edition, $auteur, $nb_des_pages);
                
                // Execute the INSERT statement
                if($insertStmt->execute()){
                    $_SESSION['SuccessMessage'] = "You added a book successfully";
                } else {
                    $_SESSION['ErrorMessage'] = "Error while adding the book";
                }
                
                // Close the INSERT statement
                $insertStmt->close();
            }
            
            // Close the SELECT statement
            $stmt->close();
        }
    ?>
    <?php include('navbar.php') ?>
    <h1>Ajouter livre 📖</h1>
    <hr>
    <form action="" method="POST" class="col-12 col-md-12" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="isbn">Isbn</label>
            <input type="text" class="form-control" name="Isbn" id="isbn" required pattern="^\d{10,13}$" title="Should be 10-13 digits">
            <small class="d-block">Should be 10-13 digits</small>
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
        <button type="submit" class="col-md-1 btn-lg mb-2 btn btn-info text-white" name="Save">Ajouter</button>
    </form>
    <?php include('script.php') ?>
    </body>
</html>
