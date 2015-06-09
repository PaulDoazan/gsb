<div id="contenu">
<h2>Les visiteurs</h2>
<h3>Choix du visiteur : </h3>
<form action="index.php?uc=validerFrais&action=selectionnerMois" method="post">
<div class="corpsForm">
 
<p>

<label for="lstVisiteur" accesskey="n">Visiteur : </label>
<select id="lstVisiteur" name="lstVisiteur">
<?php
foreach ($lesVisiteurs as $unVisiteur)
{
	$nom = $unVisiteur['nom'];
	$prenom = $unVisiteur['prenom'];
	$id = $unVisiteur['id'];
	if($id == $_SESSION['idVisiteur']){
		?>
				<option selected value="<?php echo $id ?>"><?php echo  $prenom." ".$nom ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $id ?>"><?php echo $prenom." ".$nom ?> </option>
				<?php 
				}
			}
		 ?>    
            
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>