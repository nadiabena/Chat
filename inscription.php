<?php
//session_start();

/*try{
  // On se connecte à MySQL
  $bdd = new PDO('mysql:host=localhost;dbname=tchat;charset=utf8', 'root', 'user');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
  // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}*/

//Insertion d'un nouveau user
/*if(isset($_GET['login']) && isset($_GET['password']) && isset($_GET['avatar'])){
  $login = $GET['login'];
  $password = $_GET['password'];
  $avatar_user = $_GET['avatar_user'];

  $bdd->prepare('INSERT INTO user(login_user, password_user, avatar_user)
           VALUES ('.$bdd->quote($login).', '.$bdd->quote($password).', '.$bdd->quote($avatar).')')->execute();


  $_SESSION['login'] = $_GET['login'];
          $_SESSION['password'] = $_GET['password'];
          $_SESSION['avatar_user'] = $_GET['avatar_user'];
} */

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Tchat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="style.css">
  
</head>
<body>

  <div style = "margin-top:50px; border:1px solid black; height:450px; width:350px" class="container" id="connexion_s_enregistrer">
    <form name="inscription" action="discussion.php?action=inscription" method="POST">

      <h4>Inscription </h4>  
      <img src="image/tchat.jpg" id="logoTchat" alt="tchat"  height="42" width="auto">
      
      <div>
        <hr/>
        
        <label for="login">Login:</label>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
          <input name="login" type="text" class="form-control" id="usr" placeholder="Login">
        </div>

        <label for="password">Password:</label>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
            <input id="password" name="password" type="password" class="form-control" id="pwd" placeholder="Password">
          </div>

        <label for="password">Confirm password:</label>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
            <input id="confirm_password" name="confirm_password" type="password" class="form-control" id="pwd" placeholder="Confirm password">
          </div>


        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar"><br>

        <hr/>

      </div>

      <input id="enregistrer" style ="text-align:center" type="submit" class="btn btn-success" value="S'enregistrer"> <!-- s'inscrire -->

    </form>  
  </div>

</body>



 <script type="text/javascript" src="jquery-2.2.4.js">
      $(document).ready(function(){
        
        $('#enregistrer').click(function(){
          if( $('#password').text() != $('#confirm_password').text() ){
            $('#password').css("color","red");
            $('#password').val('Erreur');  
          }  
        });

      });//ready
    </script>

</html>