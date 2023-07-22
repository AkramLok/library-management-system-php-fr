<?php include 'db.php'; ?>
<!doctype html>
<html>
<head>
    <title>Librio : Liste des emprunts en cours</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Liste des emprunts en cours</h1>
    <div class="table-responsive py-3 px-3">
        <table class="table table-bordered border-dark">
            <thead>
                <tr>
                    <th scope="col">Emprunt id</th>
                    <th scope="col">User id</th>
                    <th scope="col">User</th>
                    <th scope="col">Nombre emprunt actuel</th>
                    <th scope="col">Livre id</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Titre livre</th>
                    <th scope="col">Date emprunt</th>
                    <th scope="col">Date retour max</th>
                    <th scope="col">Etat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * 
                        FROM emprunt
                        WHERE date_retour IS NULL;";
                $result = mysqli_query($conn, $sql);
                ?>

                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <?php
                    $current_date = date('Y-m-d H:i:s');
                    $date_retour_max = date('Y-m-d H:i:s', strtotime($row['date_emprunt'] . ' + 30 days'));
                    $isPassMax = $date_retour_max < $current_date;
                    if ($isPassMax) {
                        $etat = "Dépassé";
                    } else {
                        $etat = "En cours";
                    }

                    $sql2 = "SELECT * 
                             FROM Livre
                             WHERE Livre_id = " . $row['Livre_id'];
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);

                    $sql3 = "SELECT * 
                             FROM users
                             WHERE User_id=" . $row['User_id'];
                    $result3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);
                    ?>
                    <tr>
                        <td><?php echo $row['Emprunt_id']; ?></td>
                        <td><?php echo $row['User_id']; ?></td>
                        <td><?php echo $row3['Prenom'] . ' ' . $row3['Nom']; ?></td>
                        <td><?php echo $row3['Nb_emprunt']; ?></td>
                        <td><?php echo $row['Livre_id']; ?></td>
                        <td><?php echo $row2['ISBN']; ?></td>
                        <td><?php echo $row2['titre_livre']; ?></td>
                        <td><?php echo $row['date_emprunt']; ?></td>
                        <td><?php echo $date_retour_max; ?></td>
                        <td><?php echo $etat; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php include 'script.php'; ?>
</body>
</html>
