<?php include 'db.php';?>
<!doctype html>
<html>
    <head>
        <title>Librio : Liste des utilisateurs</title>
        <?php include('head.php') ?>
    </head>

    <body>
        <?php 
        if(isset($_POST['confirm_delete'])){
            $User_id = $_POST['id_to_delete'];
            $sql = "DELETE FROM users 
                    WHERE User_id=$User_id;";
            $result = mysqli_query($conn, $sql);
            header("Location:usersList.php");
        }
        ?>
        <?php include('navbar.php') ?>
        <h1>Liste d'utilisateurs</h1>
        <div class="table-responsive py-3 px-3">
            <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th scope="col">User id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nombre d'emprunt</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql ="SELECT * FROM users;";
                        $result = mysqli_query($conn, $sql);
                    ?>

                    <?php while($row=mysqli_fetch_assoc($result)):?>
                        <tr>
                            <td><?php echo $row['User_id']?></td>
                            <td><?php echo $row['Nom']?></td>
                            <td><?php echo $row['Prenom']?></td>
                            <td><?php echo $row['Statut']?></td>
                            <td><?php echo $row['Adresse']?></td>
                            <td><?php echo $row['Email']?></td>
                            <td><?php echo $row['Nb_emprunt']?></td>
                            <td><a href="modifyUser.php?User_id=<?=$row['User_id']?>"><button class="mb-2 btn btn-success text-white fw-bold">Modifier</button></a>&nbsp;
                                &nbsp;<button onclick="func(<?=$row['User_id']?>)" data-bs-toggle="modal" data-bs-target="#confirmodal" class="mb-2 btn btn-danger text-white fw-bold">Supprimer</></td>
                        </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
            <small>**Si client a des empruntes, delete ne fonctionne pas.**</small>
        </div>
        <?php include('deleteModal.php') ?>
        <?php include('script.php') ?>
    </body>
</html>