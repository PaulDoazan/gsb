<div id="contenu">
    <h2>Suivi des paiements</h2>
    <table>
        <tr>
          <th>Visiteur médical</th>
          <th>Mois</th> 
          <th>Forfait</th>
          <th>Hors-Forfait</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
        
        <?php for ($i = 0; $i < count($visiteurs); $i++){?>       
            <tr>
              <td><?php echo $visiteurs[$i]['prenom']?> <?php echo $visiteurs[$i]['nom']?></td>
              <td><?php echo $lesDerniersMois[$i]?></td> 
              <td><?php echo $totalForfait[$i]?></td>
            </tr>
        <?php }?>
    </table>
</div>