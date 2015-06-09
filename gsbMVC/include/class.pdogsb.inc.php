<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsb_frais';   		
      	private static $user='userGsb' ;    		
      	private static $mdp='secret' ;	
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
<<<<<<< HEAD
 * Retourne les informations d'un utilisateur 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom, le prénom et le type sous la forme d'un tableau associatif 
*/
	public function getInfosUtilisateur($login, $mdp){
		$req = "select utilisateur.idUtilisateur as id, utilisateur.nom as nom, utilisateur.prenom as prenom, libelleType as type from utilisateur join type on utilisateur.idType=type.id
		where utilisateur.login='$login' and utilisateur.mdp='$mdp'";
=======
 * Retourne les informations d'un visiteur
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosVisiteur($login, $mdp){
		$req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom from visiteur 
		where visiteur.login='$login' and visiteur.mdp='$mdp'";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}

/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
<<<<<<< HEAD
 * @param $idUtilisateur 
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
*/
	public function getLesFraisHorsForfait($idUtilisateur,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idUtilisateur ='$idUtilisateur' 
=======
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		and lignefraishorsforfait.mois = '$mois' ";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes; 
	}
/**
<<<<<<< HEAD
 * Retourne le nombre de justificatif d'un utilisateur pour un mois donné
 
 * @param $idUtilisateur 
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs 
*/
	public function getNbjustificatifs($idUtilisateur, $mois){
		$req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idUtilisateur ='$idUtilisateur' and fichefrais.mois = '$mois'";
=======
 * Retourne le nombre de justificatif d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs 
*/
	public function getNbjustificatifs($idVisiteur, $mois){
		$req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
<<<<<<< HEAD
 * @param $idUtilisateur 
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
*/
	public function getLesFraisForfait($idUtilisateur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idUtilisateur ='$idUtilisateur' and lignefraisforfait.mois='$mois' 
=======
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur ='$idVisiteur' and lignefraisforfait.mois='$mois' 
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		order by lignefraisforfait.idfraisforfait";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne tous les id de la table FraisForfait
 
 * @return un tableau associatif 
*/
	public function getLesIdFrais(){
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait
 
<<<<<<< HEAD
 * Met à jour la table ligneFraisForfait pour un utilisateur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idUtilisateur 
=======
 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idVisiteur 
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif 
*/
<<<<<<< HEAD
	public function majFraisForfait($idUtilisateur, $mois, $lesFrais){
=======
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
<<<<<<< HEAD
			where lignefraisforfait.idUtilisateur = '$idUtilisateur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idFraisForfait = '$unIdFrais'";
=======
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
			PdoGsb::$monPdo->exec($req);
		}
		
	}
/**
 * met à jour le nombre de justificatifs de la table ficheFrais
<<<<<<< HEAD
 * pour le mois et l'utilisateur concerné
 
 * @param $idUtilisateur 
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idUtilisateur, $mois, $nbJustificatifs){
		$req = "update fichefrais set nbjustificatifs = $nbJustificatifs 
		where fichefrais.idUtilisateur = '$idUtilisateur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);	
	}
/**
 * Teste si un utilisateur possède une fiche de frais pour le mois passé en argument
=======
 * pour le mois et le visiteur concerné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		$req = "update fichefrais set nbjustificatifs = $nbJustificatifs 
		where fichefrais.idvisiteur = '$idVisiteur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);	
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
<<<<<<< HEAD
	public function estPremierFraisMois($idUtilisateur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idUtilisateur = '$idUtilisateur'";
=======
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}
/**
<<<<<<< HEAD
 * Retourne le dernier mois en cours d'un utilisateur
 
 * @param $idUtilisateur 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idUtilisateur){
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idUtilisateur = '$idUtilisateur'";
=======
 * Retourne le dernier mois en cours d'un visiteur
 
 * @param $idVisiteur 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idVisiteur){
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}
	
/**
<<<<<<< HEAD
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un utilisateur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idUtilisateur 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idUtilisateur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idUtilisateur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idUtilisateur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idUtilisateur, $dernierMois,'CL');
				
		}
		$req = "insert into fichefrais(idUtilisateur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values('$idUtilisateur','$mois',0,0,now(),'CR')";
=======
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');
				
		}
		$req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values('$idVisiteur','$mois',0,0,now(),'CR')";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais['idfrais'];
<<<<<<< HEAD
			$req = "insert into lignefraisforfait(idUtilisateur,mois,idFraisForfait,quantite) 
			values('$idUtilisateur','$mois','$unIdFrais',0)";
=======
			$req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
			values('$idVisiteur','$mois','$unIdFrais',0)";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
			PdoGsb::$monPdo->exec($req);
		 }
	}
/**
<<<<<<< HEAD
 * Crée un nouveau frais hors forfait pour un utilisateur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idUtilisateur 
=======
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idVisiteur 
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
<<<<<<< HEAD
	public function creeNouveauFraisHorsForfait($idUtilisateur,$mois,$libelle,$date,$montant){
		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into lignefraishorsforfait 
		values('','$idUtilisateur','$mois','$libelle','$dateFr','$montant')";
=======
	public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into lignefraishorsforfait 
		values('','$idVisiteur','$mois','$libelle','$dateFr','$montant')";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 
 * @param $idFrais 
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais ";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Retourne les mois pour lesquel un visiteur a une fiche de frais
 
<<<<<<< HEAD
 * @param $idUtilisateur 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/
	public function getLesMoisDisponibles($idUtilisateur){
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idUtilisateur ='$idUtilisateur' 
=======
 * @param $idVisiteur 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/
	public function getLesMoisDisponibles($idVisiteur){
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' 
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		order by fichefrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}
/**
<<<<<<< HEAD
 * Retourne les informations d'une fiche de frais d'un utilisateur pour un mois donné
 
 * @param $idUtilisateur 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
	public function getLesInfosFicheFrais($idUtilisateur,$mois){
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idUtilisateur ='$idUtilisateur' and fichefrais.mois = '$mois'";
=======
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
<<<<<<< HEAD
 * @param $idUtilisateur 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idUtilisateur,$mois,$etat){
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idUtilisateur ='$idUtilisateur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
	
	/**
	 * Retourne tous les id, noms et prenoms des visiteurs de la table utilisateur
	
	 * @return un tableau associatif
	 */
	public function getLesVisiteurs(){
		$req = "select utilisateur.idUtilisateur as id, utilisateur.nom as nom, utilisateur.prenom as prenom from utilisateur where idType = 'V'";
		//$req = "select * from utilisateur where idType = 'V'";
		
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	public function getLesMontants(){
		$req = "select fraisforfait.montant from fraisforfait";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	/**
	 * retourne les quantités de frais pour un utilisateur et un mois donné
	 * 
	 * @param $idUtilisateur
	 * @param $mois
	 * @return un tableau associatif
	*/
	public function getLesQuantites($idUtilisateur, $mois){
		$req = "select lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idUtilisateur ='$idUtilisateur' and lignefraisforfait.mois='$mois'
		order by lignefraisforfait.idfraisforfait";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	/**
	 * retourne le montant valide en fonction d'un utilisateur et d'un mois
	 * 
	 * @param unknown $idUtilisateur
	 * @param unknown $mois
	 * @return number
	*/
	public function calculMontantValide($idUtilisateur, $mois){
		$montants = $this->getLesMontants();
		$quantites = $this->getLesQuantites($idUtilisateur, $mois);
		$montantValide = 0;
		for ($i = 0; $i <4; $i++){
			$montantValide += $montants[$i]['montant']*$quantites[$i]['quantite'];
		}		
		
		$montantsHorsForfait = $this->getLesFraisHorsForfait($idUtilisateur,$mois);
		
		if (isset($montantsHorsForfait)){
			foreach ($montantsHorsForfait as $unMontant){
				$montantValide += $unMontant['montant'];
			}
		}
		
		return $montantValide;
	}
	
	/**
	 * Modifie le montantValide de la table fichefrais
	 * 
	 * @param unknown $idUtilisateur
	 * @param unknown $mois
	 */
	
	public function majMontantValide($idUtilisateur, $mois, $montant){
		$req = "update ficheFrais set montantValide = '$montant'
		where fichefrais.idUtilisateur ='$idUtilisateur' and fichefrais.mois = '$mois'";
=======
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idVisiteur,$mois,$etat){
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
>>>>>>> faabb130581447cb7ea69737b9189e08f30035e1
		PdoGsb::$monPdo->exec($req);
	}
}
?>