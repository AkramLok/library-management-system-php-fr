<?php include 'db.php'; ?>
<!doctype html>
<html>
    <head>
        <title>Librio : Ajouter emprunt</title>
        <?php include('head.php') ?>
    </head>
    <body>
        <?php
            if(isset($_POST['Save'])){
                $user_id = $_POST['User_id'];
                $livre_id = $_POST['Livre_id'];
                $date_emprunt = date('Y-m-d H:i:s');
                $sql = "SELECT Nb_emprunt
                    FROM users 
                    WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $sql);
                $nb_emprunt = mysqli_fetch_array($result)[0];
                $sql = "SELECT Nb_des_exemplaires
                    FROM livre 
                    WHERE livre_id = '$livre_id'";
                $result = mysqli_query($conn, $sql);
                $nb_exemplaires = mysqli_fetch_array($result)[0];


                if($nb_emprunt >= 5)
                {
                    $_SESSION['ErrorMessage'] = "Utilisateur a dépassé la limite des empruntes";
                }
                else if($nb_exemplaires <= 0)
                {
                    $_SESSION['ErrorMessage'] = "Pas d'exemplaires pour cet livre pour maintenant";
                }
                else
                {
                    $sql = "SELECT user_id
                    FROM emprunt 
                    WHERE user_id = '$user_id' and livre_id = '$livre_id' and date_emprunt = '$date_emprunt'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($result);
                    if($row != 0)
                    {
                        $_SESSION['ErrorMessage'] = "Emprunt déjà entré";
                    }
                    else
                    {
                        $sql =  "INSERT INTO emprunt(user_id, livre_id,date_emprunt)
                        VALUES ('$user_id','$livre_id','$date_emprunt')";

                        $result = mysqli_query($conn, $sql);
                        $_SESSION['SuccessMessage']="Vous avez ajouté un emprunt avec succès";
                    }
                    $sql =  "UPDATE livre 
                            SET Nb_des_exemplaires = Nb_des_exemplaires - 1 
                            WHERE livre_id = '$livre_id';";
                    $result = mysqli_query($conn, $sql);
                    $sql =  "UPDATE users 
                            SET Nb_emprunt = Nb_emprunt + 1 
                            WHERE user_id = '$user_id';";
                    $result = mysqli_query($conn, $sql);
                }    
            }
        ?>
        <?php include('navbar.php') ?>
        <h1>Ajouter emprunt</h1>
        <hr>
        <form action="" method="POST" class="col-12 col-md-12" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="user_id">User</label>
                <select class="form-control" name="User_id" id="user_id" required>
                    <option selected disabled>Select User</option>
                    <?php
                        $sql = "SELECT User_id, Nom, Prenom FROM users";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            $user_id = $row['User_id'];
                            $nom = $row['Nom'];
                            $prenom = $row['Prenom'];
                            echo "<option value='$user_id'>$nom $prenom</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="livre_id">Livre</label>
                <select class="form-control" name="Livre_id" id="livre_id" required>
                    <option selected disabled>Select Livre</option>
                    <?php
                        $sql = "SELECT Livre_id, Titre_livre FROM livre";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            $livre_id = $row['Livre_id'];
                            $titre = $row['Titre_livre'];
                            echo "<option value='$livre_id'>$livre_id - $titre</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="col-md-2 mb-2 btn btn-info text-white" name="Save">Ajouter emprunt</button>
        </form> 
        </div>

        <?php include('script.php') ?>
    </body>
</html>
