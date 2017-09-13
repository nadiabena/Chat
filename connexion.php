<?php

//Démarre la session
session_start ();

try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=tchat;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}



	//Connexion
/*
	if(isset($_POST['login']) && isset($_POST['password'])){
		$login = $_POST['login'];
		$password = $_POST['password'];
		//$avatar_user = $_GET['avatar_user'];

		echo "if";
		$query_user = $bdd->query('SELECT login_user, password_user
						 	 	   FROM user
						 	 	   WHERE login_user ='.$bdd->quote($login). ' AND password_user ='. $bdd->quote($password));
			if($query_user->rowcount() !=0 ){

				$_SESSION['login'] = $_POST['login'];
				$_SESSION['password'] = $_POST['password'];
				//$_SESSION['avatar_user'] = $_POST['avatar_user'];
				echo "OK";
			}else{
				echo "KO";
				
				header('location: index.php'); // On reste sur la page connexion tant que le user n'entre pas les bonnes données
				include 'error.php';
			}
	} */

	//Inscription
	
	if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['avatar'])){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		$avatar_user = $_POST['avatar'];

		//Si le login existe déjà on reste sur la page
		$query_user = $bdd->query('SELECT login_user
						 	 	   FROM user
						 	 	   WHERE login_user ='.$bdd->quote($login) );
		if($query_user->rowcount() !=0 ){
			echo "KO, le login existe déjà";
			//require_once 'error.php';
			header('location: inscription.php'); 
		}else{
			//Vérifier si le mot de passe est identique à la confirmation du mot de passe
			if($password === $confirm_password){		
				$bdd->prepare('INSERT INTO user(login_user, password_user, avatar_user)
						   	   VALUES ('.$bdd->quote($login).', '.$bdd->quote($password).', '.$bdd->quote($avatar_user).')')->execute();
				echo "OK";
			}else{
				echo "Le password entré ne correspond pas à la confirmation du password";
				header('location: inscription.php');
			}	
		}
	}

/*
if (isset($_GET['connexion'])){  //inscription
	$type_connexion = $_GET['connexion'];
	echo "tttttttttest";



	if(isset($_GET['login']) && isset($_GET['password'])){		//&& isset($_GET['avatar'])
		$login = $GET['login'];
		$password = $_GET['password'];
		//$avatar_user = $_GET['avatar_user'];

		echo "if";
		$query_user = $bdd->query('SELECT login_user, password_user
						 	 	   FROM user
						 	 	   WHERE login_user ='.$login.'AND password_user ='.$password_user);
			if($donnees->rowcount() !=0 ){
				$_SESSION['login'] = $_GET['login'];
				$_SESSION['password'] = $_GET['password'];
				$_SESSION['avatar_user'] = $_GET['avatar_user'];
				echo "OK";
			}else{
				echo "KO";
			}


	}
}*/ /*elseif (condition) {
	# code...
}else{


} */



/*


if(isset($_GET['login']) && isset($_GET['password']) && isset($_GET['avatar'])){
	$login = $GET['login'];
	$password = $_GET['password'];
	$avatar_user = $_GET['avatar_user'];

	if(isset($_POST['inscription'])){
		//Insertion d'un nouveau user
		$bdd->prepare('INSERT INTO user(login_user, password_user, avatar_user)
					   VALUES ('.$bdd->quote($login).', '.$bdd->quote($password).', '.$bdd->quote($avatar).')')->execute();
	}elseif (isset($_POST['connexion'])) {
		//Connexion du user

		//Vérifie si le login existe
		$query_user = $bdd->query('SELECT *
						 	 	   FROM user
						 	 	   WHERE login_user ='.$login);
		$donnees = $query_user->fetch();

		if($donnees->rowcount() !=0 ){
			//le user existe donc connexion
			//Enregistre les paramètres du user comme variables de session ($login et $password (et avatar???) )
			
			$_SESSION['login'] = $_GET['login'];
			$_SESSION['password'] = $_GET['password'];
			$_SESSION['avatar_user'] = $_GET['avatar_user'];
		} else{
			//Vérifie si le login et le mot de passe sont corrects
			$query_user = $bdd->query('SELECT login_user, password_user
						 	 	   	   FROM user
						 	 	   	   WHERE login_user ='.$login.'AND password_user ='.$password_user);
				if($donnees->rowcount() !=0 ){
					//identifiants corrects	
					$_SESSION['login'] = $_GET['login'];
					$_SESSION['password'] = $_GET['password'];
					$_SESSION['avatar_user'] = $_GET['avatar_user'];	
				}else{
					header('location: index.php');
					echo "ERREUR!";
				}
		}
	}else{
		echo "Erreur d'actions!";
	}

}//IF isset

	

*/





?>

