<?php
    include 'db.php';
?>

<!doctype html>
<html>
    <head>
        <title>Librio : Modifier utilisateur</title>
        <?php include('head.php') ?>
    </head>
    <body>
        <?php
            if(isset($_GET['User_id']))
            {
                $sql = "SELECT User_id, Nom, Prenom, Statut, Adresse, Email, Nb_emprunt
                FROM users
                WHERE User_id = $_GET[User_id];";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            }
            if(isset($_POST['Save'])){
                $nom = $_POST['Nom'];
                $prenom = $_POST['Prenom'];
                $statut = $_POST['Statut'];
                $adresse = $_POST['Adresse'];
                $email = $_POST['Email'];

                $sql = "SELECT User_id
                FROM users 
                WHERE Nom = '$nom' AND Prenom = '$prenom'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                if($row) {
                    $user_id = $row['User_id'];
                    $sql =  "UPDATE users 
                    SET Nom = '$nom', Prenom = '$prenom', Statut = '$statut', Adresse = '$adresse', Email = '$email'
                    WHERE User_id = '$user_id';";
                    $result = mysqli_query($conn, $sql);

                    $_SESSION['SuccessMessage']="Vous avez mis à jour un utilisateur avec succès";
                } else {
                    $_SESSION['ErrorMessage'] = "Utilisateur non trouvé";
                }
            }
        ?>
        
        <?php include('navbar.php') ?>
        
        <h1>Modifier utilisateur</h1>
        <hr>
        
        <form action="" method="POST" class= "col-12 col-md-12" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="nom">Nom</label>
                <select class="form-control" name="Nom" id="nom" required>
                    <option selected disabled>Choisir Nom</option>
                    <?php
                        $sql = "SELECT DISTINCT Nom FROM users";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            $selected = '';
                            if(isset($_POST['Nom']) && $_POST['Nom'] == $row['Nom']) {
                                $selected = 'selected';
                            }
                            $nom = $row['Nom'];
                            echo "<option value='$nom' $selected>$nom</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="prenom">Prenom</label>
                <select class="form-control" name="Prenom" id="prenom" required>
                    <option selected disabled>Choisir Prenom</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="statut">Statut</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Statut" value="Etudiant" id="statut-etudiant" checked>
                    <label class="form-check-label" for="statut-etudiant">Etudiant</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Statut" value="Enseignant" id="statut-enseignant">
                    <label class="form-check-label" for="statut-enseignant">Enseignant</label>
                </div>
            </div>

            <div class="mb-4">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="Adresse" id="adresse" value="<?= isset($row['Adresse']) ? $row['Adresse'] : '' ?>" required>
            </div>

            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="Email" id="email" value="<?= isset($row['Email']) ? $row['Email'] : '' ?>" required>
            </div>

            <button type="submit" class="col-md-2 mb-2 btn btn-info text-white" name="Save">Modifier utilisateur</button>   
        </form>
        
        <?php include('script.php') ?>
        
        <script>
            // Fonction pour charger les prénoms en fonction du nom sélectionné
            function loadPrenoms() {
                var nom = document.getElementById('nom').value;
                var prenomSelect = document.getElementById('prenom');

                // Réinitialiser les options des prénoms
                prenomSelect.innerHTML = '<option selected disabled>Choisir Prenom</option>';

                // Effectuer une requête AJAX pour récupérer les prénoms correspondants
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        prenomSelect.innerHTML += this.responseText;

                        // Charger les détails de l'utilisateur sélectionné
                        loadUserDetails();
                    }
                };
                xhttp.open("GET", "load_users.php?nom=" + nom, true);
                xhttp.send();
            }

            // Fonction pour charger les détails de l'utilisateur sélectionné
            function loadUserDetails() {
                var nom = document.getElementById('nom').value;
                var prenom = document.getElementById('prenom').value;

                // Effectuer une requête AJAX pour récupérer les détails de l'utilisateur
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var userDetails = JSON.parse(this.responseText);
                        if (userDetails) {
                            document.getElementById('statut-etudiant').checked = userDetails.Statut === 'Etudiant';
                            document.getElementById('statut-enseignant').checked = userDetails.Statut === 'Enseignant';
                            document.getElementById('adresse').value = userDetails.Adresse;
                            document.getElementById('email').value = userDetails.Email;
                        }
                    }
                };
                xhttp.open("GET", "load_user_details.php?nom=" + nom + "&prenom=" + prenom, true);
                xhttp.send();
            }

            // Écouter les changements dans le dropdown du nom
            document.getElementById('nom').addEventListener('change', function() {
                loadPrenoms();
            });

            // Écouter les changements dans le dropdown du prénom
            document.getElementById('prenom').addEventListener('change', function() {
                loadUserDetails();
            });

            // Charger les prénoms et les détails au chargement de la page
            loadPrenoms();
            loadUserDetails();
        </script>
    </body>
</html>
