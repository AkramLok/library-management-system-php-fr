<?php 
	$conn = mysqli_connect("localhost", "root", "", "biblio");
	session_start();

	if(isset($_SESSION['id']))
		header('location: dashboard2.php');
	if(isset($_POST['signup']))
	{
		$email = $_POST['emailSign'];
		$password = $_POST['passwordSign'];
		$passwordC = $_POST['passwordCSign'];
		$sql0 = "SELECT email FROM admins;";
		$result0 = mysqli_query($conn, $sql0);
		$count = 0;
		while($row = mysqli_fetch_assoc($result0)){
			if(strcmp($email,$row['email'])==0){
				$count++;
				break;
			}
		}
		if(strcmp($password,$passwordC)!=0)
		{
			$whatError=1;
		}
		else if($count == 0)
		{
			$sql = "INSERT INTO admins(email, password)
			VALUES ('$email','$password');";
			$result = mysqli_query($conn, $sql);
			header('location: index.php');
		}
		else
		{	
			$whatError=2;
		}
	} 
	else if(isset($_POST['login']))
	{
		$email = ($_POST['email']);
		$password = ($_POST['password']);
		$sql = "SELECT id, email, password FROM admins WHERE email = '$email' and password = '$password';";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($result);
		if($row != 0)
		{
			$id = mysqli_fetch_array($result)[0];
			$_SESSION['id'] = $id;
			header("location: dashboard2.php");
		}
		else
		{
			$whatError=3;
		}
	}
	?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Librio : Sign</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<?php include('headLogin.php') ?>
	</head>
	<body>
		<?php
		if(isset($whatError))
		{
			switch($whatError)
			{
				case 1:
					echo '<div class="alert alert-danger" role="alert">Password pas confirmé</div>';
					break;
				case 2:
					echo '<div class="alert alert-danger" role="alert">Account already Exist</div>';
					break;
				case 3:
					echo '<div class="alert alert-danger" role="alert">Account not Exist</div>';
					break;
			}
		}
		?>
		<div class="container" id="container">
			<div class="form-container sign-up-container">
				<form action="" method="POST">
					<h1>Créer un compte</h1>
					<span>Utilisez votre adresse e-mail pour vous inscrire</span>
					<input type="email" placeholder="E-mail" name="emailSign"/>
					<input type="password" placeholder="Mot de passe" name="passwordSign"/>
					<input type="password" placeholder="Confirmer le mot de passe" name="passwordCSign"/>

					<button type="submit" name="signup">S'inscrire</button>
				</form>
			</div>
			<div class="form-container sign-in-container">
				<form action="" method="POST">
					<h1>Se connecter</h1>
					<span>Utilisez votre compte</span>
					<input type="email" placeholder="E-mail" name="email"/>
					<input type="password" placeholder="Mot de passe" name="password"/>
					<a href="#" onclick="showPopup(); return false;">Mot de passe oublié ?</a>
					<button type="submit" name="login">Se connecter</button>
				</form>
			</div>
			<div class="overlay-container">
				<div class="overlay">
					<div class="overlay-panel overlay-left">
						<h1>Bienvenue !</h1>
						<p>Pour rester connecté avec nous, veuillez vous connecter avec vos informations personnelles.</p>
						<button class="ghost" id="signIn">Se connecter</button>
					</div>
					<div class="overlay-panel overlay-right">
						<h1>Bonjour, ami(e) !</h1>
						<p>Entrez vos coordonnées personnelles et commencez votre voyage avec nous.</p>
						<button class="ghost" id="signUp">S'inscrire</button>
					</div>
				</div>
			</div>
		</div>

		<script>
			function showPopup() {
				alert("Veuillez essayer de vous rappeler votre mot de passe.");
			}
			const signUpButton = document.getElementById('signUp');
			const signInButton = document.getElementById('signIn');
			const container = document.getElementById('container');

			signUpButton.addEventListener('click', () => {
				container.classList.add("right-panel-active");
			});

			signInButton.addEventListener('click', () => {
				container.classList.remove("right-panel-active");
			});
		</script>
    </body>
</html>
