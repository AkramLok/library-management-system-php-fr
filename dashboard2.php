<?php include 'db.php';?>
<!doctype html>
<html>
    <head>
        <title>Librio : Home</title>
        <?php include('head.php') ?>
    </head>
    <body>
            <?php 
                $sql = "SELECT * FROM `users`";
                $result = mysqli_query($conn, $sql);
                $numofUsers = mysqli_num_rows($result);

                $sql1 = "SELECT * FROM `livre`;";
                $result1 = mysqli_query($conn, $sql1);
                $numofBooks = mysqli_num_rows($result1);

                $sql = "SELECT * 
                FROM emprunt
                WHERE date_retour IS NULL;";
                $result2 = mysqli_query($conn, $sql);
                $numofEmpruntsEC = mysqli_num_rows($result2);

                $sql = "SELECT * 
                FROM emprunt
                WHERE date_retour IS NOT NULL;";
                $result3 = mysqli_query($conn, $sql);
                $numofEmpruntsR = mysqli_num_rows($result3);

            ?>
            <?php include('navbar.php') ?>  
            <div id="content" class="app-content mt-3">
                <h2><?php echo "Dashboard :";?></h2>
                <div class="row pt-2 justify-content-around">	
                    <div class="card col-xl-5 col-lg-5 mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Total livres</h3>
                            <h3 class="text-end card-text fw-bold"><?=$numofBooks;?></h3>
                        </div>
                    </div>

                    <div class="card col-xl-5 col-lg-5 mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Total utilisateurs</h3>
                            <h3 class="text-end card-text fw-bolder"><?=$numofUsers;?></h3>
                        </div>
                    </div>

                    <div class="card col-xl-5 col-lg-5 mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Total emprunts en cours</h3>
                            <h3 class="text-end card-text fw-bolder"><?=$numofEmpruntsEC;?></h3>
                        </div>
                    </div>

                    <div class="card col-xl-5 col-lg-5 mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Total emprunts retournés</h3>
                            <h3 class="text-end card-text fw-bolder"><?=$numofEmpruntsR;?></h3>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <?php include('script.php') ?>
        </body>
    </html>