<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
	function createTable(){
		// Logo header
		$this->Image('images/logo.jpg',85,6,30);
		$this->Ln(30);
		
		// titre
		$this->SetFont('','B');
		$this->Cell(190,9,'Remboursement des frais engagés',1,1,'C');
		$this->Ln(10);
		
		// data
		$this->SetFont('','B',14);
		$this->Cell(40,10,'Visiteur:');
		$this->SetFont('','',14);
		$this->Cell(60,10,$_POST['id']);
		$this->Cell(30,10,$_POST['prenom']);
		$this->Cell(30,10,$_POST['nom']);
		$this->Ln(20);
		
		$this->SetFont('','B',14);
		$this->Cell(40,10,'Mois:');
		$this->SetFont('','',14);
		$this->Cell(6,10,$_POST['mois']);
		$this->Cell(2,10,'/ ');
		$this->Cell(60,10,$_POST['annee']);
		$this->Ln(20);
		
		$this->SetFont('','I',13);
		$this->Cell(70,10,'Frais forfaitaires',1,0,'C');
		$this->Cell(40,10,'Quantité',1,0,'C');
		$this->Cell(40,10,'Montant Unitaire',1,0,'C');
		$this->Cell(40,10,'Total',1,1,'C');
		$this->SetFont('','',13);
		$lesFraisForfait = unserialize(rawurldecode($_POST['lesFraisForfait']));
		$lesTarifs = unserialize(rawurldecode($_POST['lesTarifs']));
		for ($i = 0; $i < 4; $i++){
			$libelle = $lesFraisForfait[$i]['libelle'];
			$quantite = $lesFraisForfait[$i]['quantite'];
			$montant = $lesTarifs[$i]['montant'];
			$this->Cell(70,10, $libelle,1,0,'R');
			$this->Cell(40,10,$quantite,1,0,'R');
			$this->Cell(40,10,$montant,1,0,'R');
			$this->Cell(40,10,$quantite*$montant,1,1,'R');
		}	
		
		$this->Ln(10);
		$this->SetFont('','I',13);
		$this->Cell(190,9,'Autres frais:',0,1,'C');
		$lesFraisHF = unserialize(rawurldecode($_POST['lesFraisHF']));
		$this->Cell(70,10,'Date',1,0,'C');
		$this->Cell(80,10,'Libellé',1,0,'C');
		$this->Cell(40,10,'Montant',1,1,'C');
		$this->SetFont('','',13);
		foreach ($lesFraisHF as $unFraisHF){
			$this->Cell(70,10,$unFraisHF['date'],1,0,'L');
			$this->Cell(80,10,$unFraisHF['libelle'],1,0,'L');
			$this->Cell(40,10,$unFraisHF['montant'],1,1,'R');
		}
		$this->Ln(10);
		$this->Cell(110,10);
		$this->SetFont('','I',13);
		$this->Cell(40,10,'Total',1,0,'C');
		$this->SetFont('','',13);
		$this->Cell(40,10,$_POST['montantV'],1,1,'R');
		
		$this->Ln(10);
		$this->Cell(190,10,('A Paris, le '.$_POST['dateModif']),0,1,'R');
		$this->Cell(190,10,('Vu l\'agent comptable'),0,1,'R');
	}
}	



$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);
$pdf->createTable();
$pdf->Output();

?>