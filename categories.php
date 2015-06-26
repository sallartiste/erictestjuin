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

if(isset($_GET['idrubriques']) && ctype_digit($_GET['idrubriques']))
{

   #on choisi une rubrique
	$tech_pitz = "INNER JOIN photo_has_rubriques h ON p.id = h.photo_id
				  INNER JOIN rubriques r ON r.id = h.rubriques_id 
				  WHERE r.id = ".$_GET['idrubriques'];
}
else
{
	$tech_pitz = "";
}

	
	$sql = "SELECT p.lenom,p.lextension,p.letitre,p.ladesc, u.lelogin
			FROM photo p
			INNER JOIN utilisateur u ON u.id = p.utilisateur_id
			$tech_pitz
			ORDER BY p.id DESC LIMIT 0,24; 
			";
			
	$recup_sql = $bdd->prepare($sql) or die (print_r(errorInfo()));	
	$recup_sql->execute();

?>

<!doctype html>
<html>
    <?php
      include "includes/head.php";
    ?>

    <body>
       <div class="wrap">
         <header>
          
          <div class="connect">
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
                        echo "<span>Bonjour ".$_SESSION['lenom']. "| </span>";
						echo "<span><a href='deconnect.php'>Déconnexion</a></span><br />";
                        echo "<span>Vous êtes connecté en tant que <span>".$_SESSION['nom_perm']."</span></span><br />";
                        
                        
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
					     
                    ?>
                </div>
          <br /><br />
          <nav>
              <?php
			       include "includes/menu.php";
			  ?>
              <div class="clear"></div>
          </nav>
        </header>
        <div class="content">
            <h2>Vous êtes dans la section :</h2>
           
            <?php
            while($ligne = $recup_sql->fetch())
			{
                 echo "<div class='miniatures'>";
                 echo "<h4>".$ligne['letitre']."</h4>";
                 echo "<a href='".CHEMIN_RACINE.$dossier_gd.$ligne['lenom'].".".$ligne['lextension']."' target='_blank'><img src='".CHEMIN_RACINE.$dossier_mini.$ligne['lenom'].".".$ligne['lextension']."' alt='' /></a>";
                 echo "<p>".$ligne['ladesc']."<br /> by <strong>".$ligne['lelogin']."</strong></p>";
                 echo "</div>";
               }                
               ?> 
        </div>
       
        <?php
			include 'includes/footer.php';
		 ?>
         </div>
    </body>
</html>