<?php include 'db.php';?>
<!doctype html>
<html>
    <head>
        <title>Librio : Rechercher utilisateur</title>
        <?php include('head.php') ?>
    </head>
    <body>
        <?php
            if(isset($_POST['Save'])){
                $nom = $_POST['Nom'];
                $prenom = $_POST['Prenom'];
                $sql ="SELECT * FROM users WHERE nom = '$nom' AND prenom = '$prenom';";
                $result = mysqli_query($conn, $sql);
                $check = mysqli_num_rows($result);
                if($check == 0)
                    $_SESSION['ErrorMessage'] = "Utilisateur de nom: $nom et de prenom: $prenom n'est pas trouvé.";
            }
        ?>
        <?php include('navbar.php') ?>
        <h1>Rehercher utilisateur</h1>
        <hr>
        <form action="" method="POST" class= "col-12 col-md-12" enctype="multipart/form-data" id="book-form">
            <div class="mb-4">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="Nom" id="nom" required>
            </div>
            <div class="mb-4">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" name="Prenom" id="prenom" required>
            </div>
            <button type="submit" class="col-md-1 btn-lg mb-2 btn btn-info text-white" name="Save">Save</button>
            
        </form>
        <div id="table-container">
            <?php
            echo "<hr>";
                if(isset($_POST['Save'])){
                    $nom = $_POST['Nom'];
                    $prenom = $_POST['Prenom'];
                    $sql ="SELECT * FROM users WHERE nom = '$nom' AND prenom = '$prenom';";
                    $result = mysqli_query($conn, $sql);
                    $check = mysqli_num_rows($result);
                    $row=mysqli_fetch_assoc($result);
                    if($check != 0)
                    {
                        $table_html = '<table class="table table-bordered border-dark">';
                        $table_html .= '<thead><tr><th scope="col">User id</th><th scope="col">Nom</th><th scope="col">Prenom</th><th scope="col">Statut</th><th scope="col">Adresse</th><th scope="col">Email</th><th scope="col">Nombre d\'emprunts faits</th></tr></thead>';                           
                        $table_html .= '<tbody>';
                        $table_html .= '<tr>';
                        $table_html .= '<td>' . $row['User_id'] . '</td>';
                        $table_html .= '<td>' . $row['Nom'] . '</td>';
                        $table_html .= '<td>' . $row['Prenom'] . '</td>';
                        $table_html .= '<td>' . $row['Statut'] . '</td>';
                        $table_html .= '<td>' . $row['Adresse'] . '</td>';
                        $table_html .= '<td>' . $row['Email'] . '</td>';
                        $table_html .= '<td>' . $row['Nb_emprunt'] . '</td>';
                        $table_html .= '</tr>';
                        $table_html .= '</tbody></table>';
                        echo $table_html;
                    }
                }
            ?>
        </div>
		</div>
		</div>
        <?php include('script.php') ?>
        </body>
    </html>