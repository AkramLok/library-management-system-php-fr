<?php
    include 'db.php';
    if(isset($_GET['Emprunt_id']))
    {
        $emprunt_id = $_GET['Emprunt_id'];
        $date_retour = $_GET['date_retour'];
        $emprunt_id = mysqli_real_escape_string($conn, $emprunt_id);
        $date_retour = mysqli_real_escape_string($conn, $date_retour);

        $sql ="SELECT * 
                FROM emprunt
                WHERE Emprunt_id = '$emprunt_id' AND date_retour IS NULL;";
        $result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);

        $livre_id=$row['Livre_id'];
        $user_id=$row['User_id'];

        $check = mysqli_num_rows($result);
        
        if($check != 0)
        {
            $sql = "UPDATE emprunt 
                    SET date_retour = '$date_retour'
                    WHERE Emprunt_id = '$emprunt_id';";
            $result = mysqli_query($conn, $sql);
            if (!$result) 
                die("Error updating emprunt: " . mysqli_error($conn));
            $sql = "UPDATE livre 
                    SET Nb_des_exemplaires = Nb_des_exemplaires + 1 
                    WHERE livre_id = '$livre_id';";
            $result = mysqli_query($conn, $sql);
            if (!$result) 
                die("Error updating emprunt: " . mysqli_error($conn));
            $sql = "UPDATE users 
                    SET Nb_emprunt = Nb_emprunt - 1 
                    WHERE User_id = '$user_id';";
            $result = mysqli_query($conn, $sql);
            if(!$result) 
                die("Error updating emprunt: " . mysqli_error($conn));
            header("Location:dashboard2.php");
            $_SESSION['SuccessMessage'] = "Emprunt rendu";
        }
        else
        {
            header("Location:dashboard2.php");
            $_SESSION['ErrorMessage'] = "Rendement pas fait car deja rendu";
        }
    }
?>