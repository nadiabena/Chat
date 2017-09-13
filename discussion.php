<?php

include 'connexion.php';

//$bdd->prepare('INSERT INTO user(login_user, password_user, avatar_user)
//           VALUES ('.$bdd->quote($login).', '.$bdd->quote($password).', '.$bdd->quote($avatar).')')->execute();



// Je récupére l'id de la personne qui est dans la session
$query_id_user = $bdd->query('SELECT id_user
                              FROM user
                              WHERE login_user ='.$bdd->quote($_SESSION['login']));

$donnees = $query_id_user->fetch();

//echo "donnees ".$donnees['id_user'];



if(isset($_POST['message'])){
  $message = $_POST['message'];
  //echo "messages".$message;
    if(strlen($message)!=0){ //Si le message n'est pas vide alors insert
      $bdd->prepare('INSERT INTO messages(contenu_message, date_message, id_user)
                     VALUES ('.$bdd->quote($message).', NOW(), '.$donnees['id_user'].')')->execute();
    }

}


$query_liste_messages = $bdd->query('SELECT contenu_message, date_message
                                     FROM messages
                                     ORDER BY date_message ASC
                                    ');
$tableau_liste_messages = [];

while($donnees = $query_liste_messages->fetch()) {
  $tableau_liste_messages[] = array('contenu_message' => $donnees['contenu_message'],
                                    'date_message' => $donnees['date_message']);
}



/*$id_user = $bdd->query('SELECT id_user
                        FROM user, messages
                        WHERE user.id_user = messages.id_user');
$res = $id_user->fetch();


$les_messages = $bdd->query('SELECT contenu_message, date_message
                             FROM messages
                             LIMIT 15');

$tableau_messages = [];

while($donnees = $les_messages->fetch()) {
  $tableau_messages[] = array('contenu_message' => $donnees['contenu_message'],
                              'date_message' => $donnees['date_message']);
}

$bdd->prepare('INSERT INTO messages(contenu_message, date_message, id_user)
               VALUES ('.$bdd->quote($message).', NOW(), '.$res['id_user
                '].')')->execute();
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
<body id="body_discussion">

<form style="text-align:right; margin-right:50px" action="index.php">
  <a style="text-align:" type="submit" href="deconnexion.php"> Se déconnecter </a>
</form>

<div class="container" style="padding-top:50px">
  <div class="row">
    <div class="col-md-offset-1 col-md-3" style="border:1px solid black; height:500px; background-color:lavenderblush;">
      <h4> Espace membre         
        <!-- Trigger the modal with a link -->
        <a name="lien" data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-cog"></span>
        </a>
      </h4>
      <hr/>
      <p> <div id="statut"> <?= $_SESSION['login']?> </div> </p>

    </div>

    <div id="id_tchat" class="col-md-8" style="border:1px solid black; height:420px; background-color:lavender;">
      <h4> Forum Tchaty Tchat</h4>
      <hr/>
      <div id="forum">
        <?php
          foreach ($tableau_liste_messages as $key => $value) {
              //  echo $value['contenu_message']."<br/>";

              //Récupérer jour et mois
              $date_envoie = substr($value['date_message'],0,10);
              $date_envoie = explode("-", $date_envoie);

              $annee = $date_envoie[0];
              $mois = $date_envoie[1];
              $jour = $date_envoie[2];

              //Récupérer heure et minute  
              $heure_envoie = substr($value['date_message'],11,18);
              $heure_envoie = explode(":", $heure_envoie);

              $heure = $heure_envoie[0];
              $minute = $heure_envoie[1];


              $date = $jour."/".$mois." à ".$heure.":".$minute;  
              echo "<div class='test'>";
              echo $_SESSION['login'].'['.$date.']'."<strong> says:</strong>".$value['contenu_message']."<br/>";
              //echo "<p id='id_message_send_at'>Message reçu le ".$date."<p><br/>";
              echo "</div>";
          }
        ?>
      </div>
    </div>
  </div>

  <div style="border:1px solid red" class="row">
    <div class="col-md-offset-1 col-md-3" style="border:1px solid black;">

    </div>

      <div class="col-md-6" style="border:1px solid black;">
        <textarea id="id_message" name="message" rows="2" cols="60">
        </textarea>
      </div>

      <div class="col-md-2" style="border:1px solid black;">
        <input style ="text-align:center" type="submit" class="btn btn-default" value="Envoyer" onclick="rafraichirTchat()">
      </div>

  </div>

</div> <!-- DIV container-->


<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Paramétre liés à votre compte</h4>
        </div>
        <div class="modal-body">
          <p>Statut:
            <select>
              <option value="disponible">Disponible</option>
              <option value="occuper">Occupé</option>
              <option value="hors_ligne">Apparaître hors ligne</option>
              <option value="absent">Absent</option>
            </select>
          </p>
          <p>Adresse email: <input type="text" name="email" placeholder="Email"><br> </p>
          <p>Mot de passe: <input type="password" name="password" placeholder="Mot de passe"><br> </p>
          <p>Confirmation mot de passe: <input type="password" name="password" placeholder="Confirmer mot de passe"><br> </p>         
          <p>Avatar: <input type="file" name="avatar"><br></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success">Enregistrer mise à jour</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  
</div>



</body>


<script type="text/javascript">
  function rafraichirTchat(){
    var xhr;

    var input = document.getElementById("id_message").value; //Le message à rafraîchir

    xhr = getXHR();

    xhr.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        document.getElementById("forum").innerHTML = this.responseText; 
        document.getElementById("id_message").value = "";  //Je réinitialise la zone de saisie
      }
    };

    xhr.open("POST", "sendMessage.php", true);  //Méthode , UrL, base asynchro
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Cette ligne permet de tenir compte de la méthode POST
    xhr.send("message=" + input);
  }


  function getXHR(){
    var xhr = null;
    //Si les navigateurs autre que IE;
    if(window.XMLHttpRequest){
      xhr = new XMLHttpRequest();
    }else if (window.ActiveXObject){//Si c'est du IE
      //deux cas selon les versions
      try{
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
      }catch(e){
        xhr = new ActiveXObject("Microsoft.XMLHTTP"); 
      }
    }else{ //Rien ne marche
      alert("Achetez-vous une autre machine");
      xhr = null;
    }
    return xhr;
  }

</script>

    <script type="text/javascript">
      $(document).ready(function(){
        setInterval(function(){
          //alert("TEST");
          $('#forum').load('discussion.php .test'); //Je rafraîchie ma page et ma div discussion id_tchat
        }, 2000); //le temps en millisecondes --> 2secondes

      });

    </script> 




</html>
