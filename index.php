<?php session_start(); ?>

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

  <div style = "margin-top:50px; border:1px solid black; height:350px; width:300px" class="container" id="connexion_se_connecter">
    <form name="connexion" action="discussion.php?action=connexion" method="POST">

      <div> <h4>Connexion</h4> </div>
      <img src="image/tchat.jpg" id="logoTchatConnexion" alt="tchat"  height="42" width="auto">
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
            <input name="password" type="password" class="form-control" id="pwd" placeholder="Password">
          </div>

        <hr/>

      </div>

      <a href="inscription.php"><input style ="text-align:center" type="button" class="btn btn-success" value="S'enregistrer"> </a> <!-- s'inscrire -->

      <input style ="text-align:center" type="submit" class="btn btn-primary" value="Se connecter">

    </form>  
  </div>

</body>


</html>




<!--
<div class="container">
  <a style="text-align:center" name="lien" data-toggle="modal" href="#myModal">Connexion</a>


  
  <form action="" method="POST"> enctype="multipart/form-data"  permet d'autre format que les int et les chaînes de caractére faire un moveupload file

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Connexion</h4>
        </div>
        <div class="modal-body">

			<label for="login">Login:</label>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
				<input name="login" type="text" class="form-control" id="usr" placeholder="Login">
			</div>

			<label for="password">Password:</label>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
				<input name="password" type="password" class="form-control" id="pwd" placeholder="Password">
			</div>

			<label for="avatar">Avatar:</label>
			<input type="file" name="avatar"><br>

     
			<div class="input-group"><br>
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<input type="submit" class="btn btn-default" value="Nouveau utilisateur?">
						</div>				
					</div>
				</div>
			</div> 

        </div>

		    <div class="modal-footer">
          <a href=""> <input type="submit" class="btn btn-success" value="Se connecter"></a> 
          <a href="discussion.php"><input style ="text-align:center" type="submit" class="btn btn-primary" value="S'enregistrer"></a>
        </div>



       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> 


      </div>

    </div>
  </div>

</form>

</div>
-->
