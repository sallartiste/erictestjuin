<?php
session_start();

require_once 'includes/config.php';
require_once 'includes/connect.php';
require_once 'includes/fonctions.php';


if(isset($_POST['lelogin']) && isset($_POST['lepass']))
{
	//définition des variables local
	$monlogin = traite_chaine($_POST['lelogin']);
	$monpswd = traite_chaine($_POST['lepass']);
	
	//Vérification dans la table administrator si le login et mot de pass correspondent à un administrator...
	$req_admin = "SELECT  u.id, u.lemail, u.lenom, 
		d.lenom AS nom_perm, d.laperm 
	FROM utilisateur u
		INNER JOIN droit d ON u.droit_id = d.id
    WHERE u.lelogin='$monlogin' AND u.lepass = '$monpswd';";
	$recup_admin = $bdd->query($req_admin) or die (print_r($bdd->erroInfo()));
	
	if($recup_admin->rowCount())
	{
		$recup_tab = $recup_admin->fetch();
		$_SESSION = $recup_tab;
		
		#creation des variables de session
		$_SESSION['sid'] = session_id();
		
		#Variables venant de l'administrator
        $_SESSION['lelogin'] = $monlogin;
        header('location: ' . CHEMIN_RACINE);
	}
	else
	{
		echo '<body onLoad="alert(\'Mauvais login ou le mot de passe incorrect...\')">';
		// puis on le redirige vers la page d'accueil
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
		$error_connect = "Mauvais login ou le mot de passe incorrect";
	}
}
?>

<!doctype html>
<html>
    <?php
      include "includes/head.php";
    ?>

    <body>
       <div class="wrap">
         <header>
          <h1>Bienvenue sur Telepro-photo.fr</h1>
          <div id="connect">
                    <?php
                    // si on est pas (ou plus) connecté
                    if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id()) {
                        ?>
                        <form action="" name="connection" method="POST">
                            <input type="text" name="lelogin" required />
                            <input type="password" name="lepass" required />
                            <input type="submit" value="Connexion" />
                        </form>
                        <?php
                        // sinon on est connecté
                    }else{
                        
                        // texte d'accueil
                        echo "<h3>Bonjour ".$_SESSION['lenom'].'</h3>';
                        echo "<p>Vous êtes connecté en tant que <span>".$_SESSION['nom_perm']."</span></p>";
                        echo "<h5><a href='deconnect.php'>Déconnexion</a></h5>";
                        
                        // liens  suivant la permission utilisateur
                        switch($_SESSION['laperm']){
                            // si on est l'admin
                            case 0 :
                               echo "<a href='admin.php'>Administrer le site</a> - <a href='membre.php'>Espace membre</a>";
                                break;
                            // si on est modérateur
                            case 1:
                                echo "<a href='modere.php'>Modérer le site</a> - <a href='membre.php'>Espace membre</a>";
                                break;
                            // si autre droit (ici simple utilisateur)
                            default :
                                echo "<a href='membre.php'>Espace membre</a>";
                        }
                    }
					
					// récupérations des images dans la table photo
					$sql = "SELECT p.lenom,p.letitre,p.ladesc, u.lelogin, 
						GROUP_CONCAT(r.id) AS rubid, 
						GROUP_CONCAT(r.lintitule SEPARATOR '~~') AS lintitule 
						FROM photo p
						INNER JOIN utilisateur u ON u.id = p.utilisateur_id
						LEFT JOIN photo_has_rubrique h ON h.photo_id = p.id
						LEFT JOIN rubrique r ON h.rubriques_id = r.id
						GROUP BY p.id
						ORDER BY p.id DESC; 
						";
					     
                    ?>
                </div>
          <br /><br />
          <nav>
              <ul>
                 <li><a href="">Accueil</a></li>
                <li><a href="">Catégories</a>
                  <ul>
                       <li><a href="">Animaux</a></li>
                       <li><a href="">Architectures</a></li>
                       <li><a href="">Artistiques</a></li>
                       <li><a href="">Personnes</a></li>
                       <li><a href="">Paysages</a></li>
                       <li><a href="">Sports</a></li>
                       <li><a href="">technologies</a></li>
                       <li><a href="">Transports</a></li>
                       <li><a href="">Divers</a></li>
                   </ul>
                 </li>
                 <li><a href="contact.php">Nous Contacter</a></li>
                 <li><a href="">Espaces Clients</a></li>
              </ul>
              <div class="clear"></div>
          </nav>
        </header>
        
       </div>
    </body>
</html>