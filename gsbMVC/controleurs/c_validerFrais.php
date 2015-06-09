<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idUtilisateur = $_SESSION['idUtilisateur'];
switch($action){
	
	case 'selectionnerVisiteur':{
		$lesVisiteurs=$pdo->getLesVisiteurs();
		//$lesCles = array_keys( $lesVisiteurs );
		//echo $pdo->getLesVisiteurs();
		include("vues/v_listeVisiteurs.php");
		break;
	}
	
	case 'selectionnerMois':{
		$_SESSION['idVisiteur']=$_REQUEST['lstVisiteur'];
		$lesVisiteurs=$pdo->getLesVisiteurs();
		include("vues/v_listeVisiteurs.php");
		//$idVisiteurSelection
		$lesMois=$pdo->getLesMoisDisponibles($_SESSION['idVisiteur']);
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMoisVisiteur.php");
		break;
	}
	
	case 'voirEtatFrais':{
		$lesVisiteurs=$pdo->getLesVisiteurs();
		include("vues/v_listeVisiteurs.php");
		$_SESSION['leMois'] = $_REQUEST['lstMois'];
		$leMois = $_SESSION['leMois'];
		$lesMois=$pdo->getLesMoisDisponibles($_SESSION['idVisiteur']);
		$moisASelectionner = $leMois;
		include("vues/v_listeMoisVisiteur.php");
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($_SESSION['idVisiteur'],$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($_SESSION['idVisiteur'],$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($_SESSION['idVisiteur'],$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_changerFrais.php");
		break;
	}
	
	case 'validerFraisForfait':{
		$lesVisiteurs=$pdo->getLesVisiteurs();
		include("vues/v_listeVisiteurs.php");
		$leMois = $_SESSION['leMois'];
		$lesMois=$pdo->getLesMoisDisponibles($_SESSION['idVisiteur']);
		$moisASelectionner = $leMois;
		include("vues/v_listeMoisVisiteur.php");
		
		$nvMontant = $pdo->calculMontantvalide($_SESSION['idVisiteur'],$leMois);
		$pdo->majMontantvalide($_SESSION['idVisiteur'],$leMois,$nvMontant);
		
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($_SESSION['idVisiteur'],$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($_SESSION['idVisiteur'],$leMois);
		$lesQuantites = array();
		for ($i = 0; $i < 4; $i++){
			if ($lesFraisForfait[$i]['quantite'] != $_POST['valeurChangee'.$i]){
				$lesFraisForfait[$i]['quantite'] = $_POST['valeurChangee'.$i];
			}		
			array_push($lesQuantites, $lesFraisForfait[$i]['quantite']);
		}
		
		$lesFrais = array();
		$keys = array();
		$lesIdFrais = array();
		$lesIdFrais = $pdo->getLesIdFrais();
		for ($i = 0; $i < 4; $i++){
			array_push($keys, $lesIdFrais[$i]['idfrais']);
		}
		$lesFrais = array_combine($keys, $lesQuantites);
		$pdo->majFraisForfait($_SESSION['idVisiteur'], $_SESSION['leMois'], $lesFrais);
		$pdo->majEtatFicheFrais($_SESSION['idVisiteur'], $_SESSION['leMois'], 'VA');
		
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($_SESSION['idVisiteur'],$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_changerFrais.php");
		break;	
	}
}
?>