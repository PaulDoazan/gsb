<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : 
    </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>
              
                     
    </p>
    
    <form action="index.php?uc=validerFrais&action=validerFraisForfait" method="post">
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
         foreach ( $lesFraisForfait as $unFraisForfait ) 
		 {
			$libelle = $unFraisForfait['libelle'];
		?>	
			<th> <?php echo $libelle?></th>
		 <?php
        }
		?>
			<th>Etat</th>
		</tr>
        <tr>
        <?php
        	for ($i = 0; $i < count($lesFraisForfait); $i++)
        	{
        		$quantite = $lesFraisForfait[$i]['quantite'];
		?>
                <td class="qteForfait"><input name="valeurChangee<?php echo $i?>" class="valeurChangee" type='text' value="<?php echo $quantite?>"/> </td>
		 <?php
          }
		?>
				<td> <?php echo $libEtat?></td>
		</tr>
    </table>
    <input id="etat" class="inputCache" name="etat" value="<?php echo $lesInfosFicheFrais['idEtat']?>"/>
    <input class="btsend" type="submit" name="btsend" value="Valider"/>
    </form>    
    
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>                
             </tr>
        <?php      
          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
		?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
             </tr>
        <?php 
          }
		?>
    </table>
  </div>
  	<form action="pdf.php" method="post" target="_blank">
  		<input name="id" class="inputCache" type='text' value="<?php echo $id?>"/>
  		<input name="prenom" class="inputCache" type='text' value="<?php echo $prenom?>"/>
  		<input name="nom" class="inputCache" type='text' value="<?php echo $nom?>"/>
  		<input name="mois" class="inputCache" type='text' value="<?php echo $numMois?>"/>
  		<input name="annee" class="inputCache" type='text' value="<?php echo $numAnnee?>"/>
  		<input name="lesFraisForfait" class="inputCache" type='text' value="<?php echo rawurlencode(serialize($lesFraisForfait))?>"/>
  		<input name="lesTarifs" class="inputCache" type='text' value="<?php echo rawurlencode(serialize($lesTarifs))?>"/>
  		<input name="lesFraisHF" class="inputCache" type='text' value="<?php echo rawurlencode(serialize($lesFraisHorsForfait))?>"/>
  		<input name="montantV" class="inputCache" type='text' value="<?php echo $montantValide?>"/>
  		<input name="dateModif" class="inputCache" type='text' value="<?php echo $dateModif?>"/>
  		<input class="btsend2" type="submit" name="btsend" value="Générer PDF"/>
  	</form>
  </div>
 













