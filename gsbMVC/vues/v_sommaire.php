﻿    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
</h2>
    
      </div>  
        <ul id="menuList">
			<li >
<<<<<<< HEAD
				  Utilisateur :<br>
				<?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?> <br> <?php echo "(".$_SESSION['type'].")"  ?> <br>
			</li>
			
			<?php if ($_SESSION['type'] == 'Visiteur medical'){ 
			
           echo '<li class="smenu">
=======
				  Visiteur :<br>
				<?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
			</li>
           <li class="smenu">
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
              <a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais ">Saisie fiche de frais</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
<<<<<<< HEAD
           </li>';
			};
			
			if ($_SESSION['type'] == 'Comptable'){
				echo '<li class="smenu">
              		<a href="index.php?uc=validerFrais&action=selectionnerVisiteur" title="Validation des fiches de frais">Validation fiches de frais</a>
           </li>';
			};
				?>
=======
           </li>
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
 	   <li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
         </ul>
        
    </div>
    