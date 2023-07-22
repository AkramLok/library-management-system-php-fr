<?php include 'db.php'; ?>
<!doctype html>
<html>
    <head>
        <title>Librio : Rendre livre</title>
        <?php include('head.php') ?>
    </head>
    <body>
        <?php
            if(isset($_POST['Save'])){
                $user_id = $_POST['User_id'];
                $livre_id = $_POST['Livre_id'];
                $date_retour = $_POST['Date_retour'];
                $date_retour_max = date('Y-m-d H:i:s', strtotime('+30 days'));
                $sql = "SELECT user_id,livre_id
                    FROM emprunt 
                    WHERE user_id = '$user_id' AND livre_id = '$livre_id'";
                $result = mysqli_query($conn, $sql);
                $nb_emprunt = mysqli_fetch_array($result)[0];
                $sql = "SELECT user_id
                    FROM emprunt 
                    WHERE user_id = '$user_id' and livre_id = '$livre_id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);
                if($row == 0) {
                    $_SESSION['ErrorMessage'] = "Erreur dans user id ou livre id.";
                } else {
                    $_SESSION['SuccessMessage']="Vous avez des emprunts à rendre. Voir emprunts ci-dessous.";
                } 
            }
        ?>
        <?php include('navbar.php') ?>
        <h1>Rendre emprunt</h1>
        <hr>
        <form action="" method="POST" class="col-12 col-md-12" enctype="multipart/form-data" id="emprunt-form">
            <div class="mb-4">
                <label for="user_id">User</label>
                <select class="form-control" name="User_id" id="user_id" required>
                    <option selected disabled>Select User</option>
                    <?php
                        $sql = "SELECT User_id, Nom, Prenom FROM users";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            $selected = '';
                            if(isset($_POST['User_id']) && $_POST['User_id'] == $row['User_id']) {
                                $selected = 'selected';
                            }
                            $user_id = $row['User_id'];
                            $nom = $row['Nom'];
                            $prenom = $row['Prenom'];
                            echo "<option value='$user_id' $selected>$nom $prenom</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="livre_id">Livre</label>
                <select class="form-control" name="Livre_id" id="livre_id" required>
                    <option selected disabled>Select Livre</option>
                    <?php
                        if(isset($_POST['User_id'])) {
                            $selected_user_id = $_POST['User_id'];
                            $sql = "SELECT livre_id, Titre_livre FROM livre WHERE livre_id IN (
                                SELECT livre_id FROM emprunt WHERE user_id = '$selected_user_id'
                                AND date_retour IS NULL
                            )";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                                $livre_id = $row['livre_id'];
                                $titre_livre = $row['Titre_livre'];
                                echo "<option value='$livre_id'>$livre_id - $titre_livre</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="date_routeur">Date routeur</label>
                <input type="datetime-local" class="form-control" name="Date_retour" id="date_retour" required>
            </div>
            <button type="submit" class="col-md-2 mb-2 btn btn-info text-white" name="Save">Ajouter emprunt</button>
        </form> 
        
        <div id="table-container">
                <?php
                echo "<hr>";
                    if(isset($_POST['Save'])){
                        $user_id = $_POST['User_id'];
                        $livre_id = $_POST['Livre_id'];
                        $sql ="SELECT * FROM emprunt WHERE user_id = '$user_id' AND livre_id = '$livre_id';";
                        $result = mysqli_query($conn, $sql);
                        $check = mysqli_num_rows($result);
                        $row=mysqli_fetch_assoc($result);
                        if($check != 0)
                        {
                            $table_html = '<table class="table table-bordered border-dark">';
                            $table_html .= '<thead><tr><th scope="col">Emprunt id</th><th scope="col">User id</th><th scope="col">Livre_id</th><th scope="col">Date emprunt</th><th scope="col">Date retour</th><th scope="col">Actions</th></tr></thead>';                           
                            $table_html .= '<tbody>';
                            $table_html .= '<tr>';
                            $table_html .= '<td>' . $row['Emprunt_id'] . '</td>';
                            $table_html .= '<td>' . $row['User_id'] . '</td>';
                            $table_html .= '<td>' . $row['Livre_id'] . '</td>';
                            $table_html .= '<td>' . $row['date_emprunt'] . '</td>';
                            $table_html .= '<td>' . $_POST['Date_retour'] . '</td>';
                            $table_html .= '<td><a href="rendreEmprunt.php?Emprunt_id=' . $row['Emprunt_id'] . '&date_retour=' . $_POST['Date_retour'] . '"><button class="mb-2 btn btn-success text-white fw-bold">Rendre</button></a></td>';
                            $table_html .= '</tr>';
                            $table_html .= '</tbody></table>';
                            echo $table_html;
                        }
                    }
                ?>
            </div>

        <?php include('script.php') ?>
        <script>
            // Détecter le changement de sélection dans le dropdown des utilisateurs
            document.getElementById('user_id').addEventListener('change', function() {
                document.getElementById('emprunt-form').submit(); // Soumettre le formulaire automatiquement
            });
        </script>
    </body>
</html>
