<?php
//verifier si le formulaire à bien été envoyé
if(isset($_POST['nom']) && isset($_POST['titre']) && isset($_POST['sujet']) && isset($_POST['couriel']) && isset($_POST['letexte']))
{
	$nom = strip_tags(trim($_POST['nom']));
	$titre = strip_tags(trim($_POST['titre']));
	$subject = strip_tags(trim($_POST['sujet']));
	$couriel = strip_tags(trim($_POST['couriel']));
	$message = strip_tags(trim($_POST['letexte']));
	
	//si tout va bien, on envoie le mail
	
	 $to      = 'sallartistee@yahoo.fr';
     $headers = 'From: '. $couriel. "\r\n" .
     'Reply-To: ' .$couriel. "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $titre. $nom ." : ". $message, $headers);
    
    $affiche = "Cool, Votre message a bien été envoyé, nous vous contacterons soon!!!";
}

?>
<!doctype html>
<html>
<?php
   include "includes/head.php";
?>

<body>
<div id="formulaire">
            <h5>UN PETIT MOT ?</h5>
            <p>
                Vous pouvez utiliser le formulaire de contact ci-dessous pour tout demande de renseignement, 
                ou sinon utiliser l'adresse e-mail.
            </p>
            <?php
                if(isset($affiche))
                {
                   echo $affiche;
                }else{
			?> 
            
            <form action="" method="post">
                <input type="text" name="nom" placeholder="Votre Nom" required />
                <input type="text" name="prenom" placeholder="Votre Prénom" />
                <input type="radio" name="titre" value="Mme" id="mme" required /><label for="mme">Mme</label>
                <input type="radio" name="titre" value="Mme" id="mme" /><label for="mme">Mme</label>
                <input type="radio" name="titre" value="M" id="mon" /><label for="mon">M</label>
                <input type="email" name="couriel" placeholder="Entrez votre e-mail" required /><br/><br />
                <input type="text" name="sujet" placeholder="Sujet de votre mail" required /><br/><br />
                <textarea maxlength="500" placeholder="Entrez votre message" name="letexte" required rows="6" cols="90" ></textarea><br>
                <input type="submit" value="ENVOYEZ" >
            </form>
            <?php
            }
			?>

        </div><!--fin #formulaire-->
</body>
</html>