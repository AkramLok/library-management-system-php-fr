<div class="wrapper" >
<nav id="sidebar">	
    <div class="sidebar-header">
    <a href="dashboard2.php"><img src="./assets/img/logo1.png" width="250px"></a>
        <hr>
    </div>
    <ul class="list-unstyled components">
        <p>MENUS</p>
        <li>
        <a href="dashboard2.php">&nbsp;<i class="fa-solid fa-house"></i>&ensp;  Home</a>
        </li>
        <li >
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">&nbsp;<i class="fa-solid fa-book"></i>&emsp; Livres</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="addBook2.php">Ajouter livre</a>
                </li>
                <li>
                    <a href="modifyBook.php">Modifier livre</a>
                </li>
                <li>
                    <a href="booksList2.php">Supprimer livre</a>
                </li>
                <li>
                    <a href="searchBook.php">Rechercher livre</a>
                </li>
                <li>
                    <a href="addExemplaire.php">Ajouter exemplaire</a>
                </li>
                <li>
                    <a href="deleteExemplaire.php">Supprimer exemplaire</a>
                </li>
                <li>
                    <a href="booksList2.php">Afficher liste des livres</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">&nbsp;<i class="fa-solid fa-user"></i>&emsp; Utilisateurs</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="addUser.php">Ajouter utilisateur</a>
                </li>
                <li>
                    <a href="modifyUser.php">Modifier utilisateur</a>
                </li>
                <li>
                    <a href="usersList.php">Supprimer utilisateur</a>
                </li>
                <li>
                    <a href="searchUser.php">Rechercher utilisateur</a>
                </li>
                <li>
                    <a href="usersList.php">Afficher liste des utilisateurs</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#empruntSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">&nbsp;<i class="fa-solid fa-receipt"></i>&emsp; Emprunts</a>
            <ul class="collapse list-unstyled" id="empruntSubmenu">
                <li>
                    <a href="addEmprunt.php">Faire emprunt</a>
                </li>
                <li>
                    <a href="rendreLivre.php">Rendre livre</a>
                </li>
                <li>
                    <a href="empruntEnCoursListe.php">Emprunt en cours</a>
                </li>
                <li>
                    <a href="empruntHistoryListe.php">Historique des emprunts</a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="list-unstyled CTAs">
        <li>
            <a href="logout.php" class="download"><i class="fa-solid fa-right-from-bracket"></i>&emsp; Log out</a>
        </li>
    </ul>
</nav>

<div id="content" class="app-content mt-3">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fa fa-align-justify"></i>
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto"> 
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard2.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="booksList2.php">Livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usersList.php">Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#emprunt2Submenu" data-toggle="collapse" aria-expanded="false" style="background:#f8f9fA;">Emprunts</a>
                    <ul class="collapse list-unstyled" id="emprunt2Submenu"> 
                        <li>
                            <a href="empruntEnCoursListe.php" class="dropdown-item">En cours</a>
                        </li>
                        <li>
                            <a href="empruntHistoryListe.php" class="dropdown-item">Retournés</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="About.php">About</a>
                </li>
            </ul>
        </div>
    </nav>
     
    <?php if (isset($_SESSION['ErrorMessage'])) : ?> 
        <div class="alert alert-danger">
        <?php 
            echo $_SESSION['ErrorMessage'];
            unset($_SESSION['ErrorMessage']);             
        ?>             
        </div>     
    <?php endif ?>

    <?php if (isset($_SESSION['SuccessMessage'])) : ?>         
        <div class="alert alert-success">
        <?php 
            echo $_SESSION['SuccessMessage'];
            unset($_SESSION['SuccessMessage']);             
        ?>             
        </div>     
    <?php endif ?>