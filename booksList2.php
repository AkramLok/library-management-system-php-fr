<?php include 'db.php'; ?>
<!doctype html>
<html>
    <head>
        <title>Librio : Liste des livres</title>
        <?php include('head.php') ?>
    </head>
    <body>
        <?php 
        if(isset($_POST['confirm_delete'])){
            $Livre_id = $_POST['id_to_delete'];
            $sql = "DELETE FROM livre WHERE livre_id='$Livre_id';";
            $result = mysqli_query($conn, $sql);
            header("Location:booksList2.php");
        }
        ?>
                <?php include('navbar.php') ?>
                <h1>Liste de livres</h1>
                <div class="table-responsive py-3 px-3">
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr>
                                <th scope="col">Livre id</th>
                                <th scope="col">Isbn</th>
                                <th scope="col">Titre livre</th>
                                <th scope="col">Maison edition</th>
                                <th scope="col">Auteur</th>
                                <th scope="col">Nombre des pages</th>
                                <th scope="col">Nombre des exemplaires</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql ="SELECT * FROM livre;";
                                $result = mysqli_query($conn, $sql);
                            ?>

                            <?php while($row=mysqli_fetch_assoc($result)):?>
                                <tr>
                                    <td><?php echo $row['Livre_id']?></td>
                                    <td><?php echo $row['ISBN']?></td>
                                    <td><?php echo $row['titre_livre']?></td>
                                    <td><?php echo $row['maison_edition']?></td>
                                    <td><?php echo $row['Auteur']?></td>
                                    <td><?php echo $row['Nb_des_pages']?></td>
                                    <td><?php echo $row['Nb_des_exemplaires']?></td>
                                    <td><a href="modifyBook.php?Livre_id=<?=$row['Livre_id']?>"><button class="mb-2 btn btn-success text-white fw-bold">Modifier</button></a>&nbsp;
                                        &nbsp;<button onclick="func(<?=$row['Livre_id']?>)" data-bs-toggle="modal" data-bs-target="#confirmodal" class="mb-2 btn btn-danger text-white fw-bold">Supprimer</td>
                                </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    <small>**Si livre a des exemplaires, delete ne fonctionne pas.**</small>
                </div>
            </div>
        </div>
            
        <?php include('deleteModal.php') ?>
        <?php include('script.php') ?>
    </body>
</html>