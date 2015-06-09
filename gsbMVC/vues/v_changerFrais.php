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
          /*foreach (  $lesFraisForfait as $unFraisForfait  ) 
		  {
				$quantite = $unFraisForfait['quantite'];*/
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
  </div>
 













