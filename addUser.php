<?php include 'db.php'; ?>
<!doctype html>
<html>
    <head>
        <title>Librio : Ajouter utilisateur</title>
        <?php include('head.php') ?>
    </head>
    <body>
        <?php
            if(isset($_POST['Save'])){
                $nom = $_POST['Nom'];
                $prenom = $_POST['Prenom'];
                $statut = $_POST['Statut'];
                $adresse = $_POST['Adresse'];
                $email = $_POST['Email'];

                $sql = "SELECT nom
                FROM users 
                WHERE nom = '$nom' and prenom = '$prenom' ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);

                if($row != 0){
                    $_SESSION['ErrorMessage'] = "Utilisateur déjà entré";
                }else{
                    $sql =  "INSERT INTO users(nom, prenom,statut, adresse, email)
                    VALUES ('$nom','$prenom','$statut','$adresse','$email')";
                    $result = mysqli_query($conn, $sql);

                    $_SESSION['SuccessMessage']="Vous avez ajouté un utilisateur avec succès";
                }
            }
        ?>
        <?php include('navbar.php') ?>
        <h1>Ajouter utilisateur</h1>
        <hr>
        <form action="" method="POST" class= "col-12 col-md-12" enctype="multipart/form-data">

            <div class="mb-4">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="Nom" id="nom" required>
            </div>

            <div class="mb-4">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" name="Prenom" id="prenom" required>
            </div>

            <div class="mb-4">
                <label for="statut">Statut</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Statut" value="Etudiant" checked>
                    <label class="form-check-label" for="statut">Etudiant</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Statut" value="Enseignant">
                    <label class="form-check-label" for="statut">Enseignant</label>
                </div>
            </div>

            <div class="mb-4">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="Adresse" id="adresse" required>
            </div>

            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="Email" id="email" required>
            </div>
            <button type="submit" class="col-md-1 mb-2 btn btn-info text-white" name="Save">Ajouter utilisateur</button>
        </form>
        </div>
        </div>
        
        <?php include('script.php') ?>
        </body>
    </html>