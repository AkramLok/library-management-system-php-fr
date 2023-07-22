<?php include 'db.php'; ?>
<!doctype html>
<html>
    <head>
        <?php include('head.php') ?>
    </head>
    <body>
        <?php
            if(isset($_POST['Save'])){
                $isbn = $_POST['Isbn'];
                $sql ="SELECT * FROM livre WHERE isbn = '$isbn';";
                $result = mysqli_query($conn, $sql);
                $check = mysqli_num_rows($result);
                if($check == 0)
                    $_SESSION['ErrorMessage'] = "Livre d'isbn Not Found";
            }
        ?>
        <?php include('navbar.php') ?>
            <h1>Rehercher livre 📖</h1>
            <hr>
            <form action="" method="POST" class= "col-12 col-md-12" enctype="multipart/form-data" id="book-form">
                <div class="mb-4">
                    <label for="isbn">ISBN</label>
                    <input type="text" class="form-control" name="Isbn" id="isbn" required>
                </div>
                <button type="submit" class="col-md-2 mb-2 btn btn-info text-white" name="Save">Chercher</button>
            </form>

            <div id="table-container">
                <?php
                echo "<hr>";
                    if(isset($_POST['Save'])){
                        $isbn = $_POST['Isbn'];
                        $sql ="SELECT * FROM livre WHERE isbn = '$isbn';";
                        $result = mysqli_query($conn, $sql);
                        $check = mysqli_num_rows($result);
                        $row=mysqli_fetch_assoc($result);
                        if($check != 0)
                        {
                            $table_html = '<table class="table table-bordered border-dark">';
                            $table_html .= '<thead><tr><th scope="col">Livre id</th><th scope="col">Isbn</th><th scope="col">Titre livre</th><th scope="col">Maison edition</th><th scope="col">Auteur</th><th scope="col">Nombre des pages</th><th scope="col">Nombre des exemplaires</th></tr></thead>';                           
                            $table_html .= '<tbody>';
                            $table_html .= '<tr>';
                            $table_html .= '<td>' . $row['Livre_id'] . '</td>';
                            $table_html .= '<td>' . $row['ISBN'] . '</td>';
                            $table_html .= '<td>' . $row['titre_livre'] . '</td>';
                            $table_html .= '<td>' . $row['maison_edition'] . '</td>';
                            $table_html .= '<td>' . $row['Auteur'] . '</td>';
                            $table_html .= '<td>' . $row['Nb_des_pages'] . '</td>';
                            $table_html .= '<td>' . $row['Nb_des_exemplaires'] . '</td>';
                            $table_html .= '</tr>';
                            $table_html .= '</tbody></table>';
                            echo $table_html;
                        }
                    }
                ?>
            </div>
		</div>
        <?php include('script.php') ?>
        </body>
    </html>