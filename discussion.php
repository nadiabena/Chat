<?php

include 'connexion.php';


//$bdd->prepare('INSERT INTO user(login_user, password_user, avatar_user)
//           VALUES ('.$bdd->quote($login).', '.$bdd->quote($password).', '.$bdd->quote($avatar).')')->execute();



// Je récupére l'id de la personne qui est dans la session
$query_id_user = $bdd->query('SELECT id_user
                              FROM user
                              WHERE login_user ='.$bdd->quote($_SESSION['login']));

$donnees = $query_id_user->fetch();

echo "donnees ".$donnees['id_user'];



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

<div class="container" style="border:1px solid red; padding-top:50px">
  <div class="row">
    <div class="col-md-offset-1 col-md-3" style="border:1px solid black; height:500px; background-color:lavenderblush;">
      <h4> Espace membre</h4>
      <hr/>
      <p> <div id="statut"> <?= $_SESSION['login']?> </div> </p>

    </div>

    <div class="col-md-8" style="border:1px solid black; height:500px; background-color:lavender;">
      <h4> Forum Tchaty Tchat</h4>
      <hr/>
      <div id="forum">
      <?php
        foreach ($tableau_liste_messages as $key => $value) {
            echo $value['contenu_message']."<br/>";

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

            echo "<p id='id_message_send_at'>Message reçu le ".$date."<p><br/>";
        }



      ?>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-offset-1 col-md-3" style="border:1px solid black;">
      test
    </div>

    <form action="discussion.php" method="POST">

      <div class="col-md-6" style="border:1px solid black;">
        <textarea name="message" rows="2" cols="60">
        </textarea>
      </div>

      <div class="col-md-2" style="border:1px solid black;">
        <input style ="text-align:center" type="submit" class="btn btn-default" value="Envoyer">
      </div>

    </form>

  </div>

</div> <!-- DIV container-->




</body>
</html>
