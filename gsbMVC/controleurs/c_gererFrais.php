<?php
include("vues/v_sommaire.php");
<<<<<<< HEAD
$idUtilisateur = $_SESSION['idUtilisateur'];
=======
$idVisiteur = $_SESSION['idVisiteur'];
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);
$action = $_REQUEST['action'];
switch($action){
	case 'saisirFrais':{
<<<<<<< HEAD
		if($pdo->estPremierFraisMois($idUtilisateur,$mois)){
			$pdo->creeNouvellesLignesFrais($idUtilisateur,$mois);
=======
		if($pdo->estPremierFraisMois($idVisiteur,$mois)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$mois);
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		}
		break;
	}
	case 'validerMajFraisForfait':{
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
<<<<<<< HEAD
	  	 	$pdo->majFraisForfait($idUtilisateur,$mois,$lesFrais);
=======
	  	 	$pdo->majFraisForfait($idVisiteur,$mois,$lesFrais);
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
	  break;
	}
	case 'validerCreationFrais':{
		$dateFrais = $_REQUEST['dateFrais'];
		$libelle = $_REQUEST['libelle'];
		$montant = $_REQUEST['montant'];
		valideInfosFrais($dateFrais,$libelle,$montant);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
<<<<<<< HEAD
			$pdo->creeNouveauFraisHorsForfait($idUtilisateur,$mois,$libelle,$dateFrais,$montant);
=======
			$pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$dateFrais,$montant);
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_REQUEST['idFrais'];
	    $pdo->supprimerFraisHorsForfait($idFrais);
		break;
	}
}
<<<<<<< HEAD
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idUtilisateur,$mois);
$lesFraisForfait= $pdo->getLesFraisForfait($idUtilisateur,$mois);
=======
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
include("vues/v_listeFraisForfait.php");
include("vues/v_listeFraisHorsForfait.php");

?>