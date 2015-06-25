<?php
session_start();

require_once 'includes/config.php';
require_once 'includes/connect.php';
require_once 'includes/fonctions.php';

# si on est pas (ou plus) connecté
if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id()) 
{
    header("location: deconnect.php");
}



// si on confirme la suppression
if(isset($_GET['delete'])&& ctype_digit($_GET['delete'])){
    $idphoto = $_GET['delete'];
    $idutil = $_SESSION['id'];
    
    // récupération du nom de la photo
    $sql_10="SELECT lenom, lextension FROM photo WHERE id=$idphoto;";
	$sql1 = $bdd->prepare($sql_10) or die (print_r($bdd->erroInfo()));
	$sql1->execute();
	$nom_photo = $sql1->fetch();
	
    #suppression de la clef etrangere
    $sql_20="DELETE FROM photo_has_rubriques WHERE photo_id = $idphoto;";
	$sql2 = $bdd->prepare($sql_20) or die (print_r(errorInfo()));
	$sql2->execute();
	
	// puis suppression dans la table photo
    $sql_30="DELETE FROM photo WHERE id = $idphoto AND utilisateur_id = $idutil;";
	$sql3 = $bdd->prepare($sql_30) or die (print_r(errorInfo()));
	$sql3->execute();
	
	#echo $dossier_ori.$nom_photo['lenom'].".".$nom_photo['lextension'];
    
    // supression physique des fichiers
    unlink($dossier_ori.$nom_photo['lenom'].".".$nom_photo['lextension']);
    unlink($dossier_gd.$nom_photo['lenom'].".jpg");
    unlink($dossier_mini.$nom_photo['lenom'].".jpg");
}

#recuperation des images de l'utilisateurs
$sql = "SELECT p.*, GROUP_CONCAT(r.id) AS idrub, GROUP_CONCAT(r.lintitule SEPARATOR '|||' ) AS lintitule
    FROM photo p
	LEFT JOIN photo_has_rubriques h ON h.photo_id = p.id
    LEFT JOIN rubriques r ON h.rubriques_id = r.id 
	GROUP BY p.id
	ORDER BY p.id DESC;
    ";
$recup_sql = $bdd->query($sql) or die (print_r($bdd->erroInfo()));


?>
<!DOCTYPE html>
<html>
    <?php
      include "includes/head.php";
    ?>
    <body>
         <div class="wrap">
             <header>
                <div class="connect">
				<?php // texte d'accueil
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
                        }?>
                </div>
                 <br /><br />
          <nav>
              <ul>
                 <li><a href="index.php">Accueil</a></li>
                <li><a href="">Catégories</a>
                  <ul>
                    <?php
					   $req = "SELECT * FROM rubriques ORDER BY id";
					   $rub_pics =$bdd->prepare($req) or die (print_r(errorInfo()));
					   $rub_pics->execute();
					   
					   while($rubriques = $rub_pics->fetch())
					   {
					       $sous_categories = $rubriques['lintitule'];
						   echo"<li><a href=''>$sous_categories</a></li>";
					   }
					?>
                   </ul>
                 </li>
                 <li><a href="contact.php">Nous Contacter</a></li>
                 <li><a href="">Espaces Clients</a></li>
              </ul>
              <div class="clear"></div>
          </nav>
             </header>
          
             <div class="content">
                 Vous êtes connecté en tant que <span><?php echo $_SESSION['nom_perm']?></span>
                 <h2>Bienvenu cher Modérateur</h2> 
                 
                 <div id="lesphotos">
                     <?php
                     while($ligne = $recup_sql->fetch()){
                 echo "<div class='miniatures'>";
                 echo "<h4>".$ligne['letitre']."</h4>";
                 echo "<a href='".CHEMIN_RACINE.$dossier_gd.$ligne['lenom'].".".$ligne['lextension']."' target='_blank'>
				 <img src='".   CHEMIN_RACINE.$dossier_mini.$ligne['lenom'].".jpg' alt='' /></a>";
                 echo "<p>".$ligne['ladesc']."<br /><br />
				 
                 <a href=''><img src='img/modifier.png' alt='modifier' /></a> 
                     </p>";
					 $sections = explode('|||',$ligne['lintitule']);
                 //$idsections = explode(',',$ligne['idrub']);
                 foreach($sections AS $key => $valeur){
                     echo " $valeur<br/>";
                 }
			     
                 echo "</div>";
               }
               ?>
                 </div>
             </div>
            <div id="bas"></div>
         </div>

    </body>
</html>