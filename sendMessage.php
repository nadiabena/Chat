<?php

include 'connexion.php';

// Je récupére l'id de la personne qui est dans la session
$query_id_user = $bdd->query('SELECT id_user
                              FROM user
                              WHERE login_user ='.$bdd->quote($_SESSION['login']));

$donnees = $query_id_user->fetch();


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

?>


      
<?php
	foreach ($tableau_liste_messages as $key => $value) {

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

     

