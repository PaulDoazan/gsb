<?php

include("vues/v_sommaire.php");
$idUtilisateur = $_SESSION['idUtilisateur'];

$visiteurs = $pdo->getLesVisiteurs();
$lesDerniersMois = array();
$lesFraisForfait = array();
$tarifs = $pdo->getLesMontants();
for ($i = 0; $i < count($visiteurs); $i++){
    $lesDerniersMois[] = $pdo->dernierMoisSaisi($visiteurs[$i]['id']);
    $lesFraisForfait[] = $pdo->getLesFraisForfait($visiteurs[$i]['id'], $lesDerniersMois[$i]);
}
$totalForfait = array();
$tot = 0;
for ($j = 0; $j < count($visiteurs); $j++){
    for ($k = 0; $k < 4; $k++){
        $tot += ($lesFraisForfait[$j][$k]['quantite'])*($tarifs[$k]['montant']);
    }
    $totalForfait[$j] = $tot;
    $tot = 0;
}

include("vues/v_suiviPaiement.php");

?>