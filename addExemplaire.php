<?php include 'db.php'; ?>
<!doctype html>
<html>
  <head>
    <title>Librio : Ajouter exemplaire</title>
    <?php include('head.php') ?>
  </head>
  <body>
    <?php
      if (isset($_POST['Save'])) {
        $isbn = $_POST['Isbn'];
        $nb_ex = $_POST['Nb_ex'];
        $sql ="SELECT * FROM livre WHERE isbn = '$isbn';";
        $result = mysqli_query($conn, $sql);
        $check = mysqli_num_rows($result);
        if ($check == 0)
          $_SESSION['ErrorMessage'] = "Livre d'isbn Not Found";
        else if ($nb_ex <= 0)
          $_SESSION['ErrorMessage'] = "Nombre d'exemplaires nulle ou négatif";
      }
    ?>

    <?php include('navbar.php') ?>
    <h1>Ajouter exemplaire <?= isset($row['isbn']) ? $row['isbn'] : '' ?> :</h1>
    <hr>
    <form action="" method="POST" class="col-12 col-md-12" enctype="multipart/form-data" id="book-form">
      <div class="mb-4">
        <label for="isbn">Livre</label>
        <select class="form-control" name="Isbn" id="isbn" required>
          <?php
            $sql = "SELECT DISTINCT isbn,titre_livre FROM livre";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['isbn'] . "'>" . $row['isbn'] . ' - ' . $row['titre_livre'] . "</option>";
            }
          ?>
        </select>
      </div>
      <div class="mb-4">
        <label for="nb_ex">Nombre d'exemplaires ajouté</label>
        <input type="text" class="form-control" name="Nb_ex" id="nb_ex" required>
      </div>
      <button type="submit" class="col-md-1 btn-lg mb-2 btn btn-info text-white" name="Save">Ajouter</button>
    </form>
    <div id="table-container">
      <?php
        echo "<hr>";
        if (isset($_POST['Save'])) {
          $isbn = $_POST['Isbn'];
          $nb_ex = $_POST['Nb_ex'];
          $sql ="SELECT * FROM livre WHERE isbn = '$isbn';";
          $result = mysqli_query($conn, $sql);
          $check = mysqli_num_rows($result);
          $row = mysqli_fetch_assoc($result);
          if ($check != 0 && $nb_ex > 0) {
            for ($x = 0; $x < $nb_ex; $x++) {
              $sql =  "INSERT INTO exemplaire(Livre_id)
              VALUES ('". $row['Livre_id'] ."')";
              $result = mysqli_query($conn, $sql);
            }
            $sql =  "UPDATE livre 
            SET Nb_des_exemplaires = Nb_des_exemplaires + '$nb_ex' 
            WHERE isbn = '$isbn';";
            $result = mysqli_query($conn, $sql);
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
            $nb_actuel = $row['Nb_des_exemplaires'] + $nb_ex;
            $table_html .= '<td>' . $nb_actuel . '</td>';
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
