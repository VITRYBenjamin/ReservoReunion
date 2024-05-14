<div class="Center">
    <h1> Tableau récapitulatif des équipements</h1>

    <section class="cta">
        <a href="ajoutEquipement.php" class="button">Ajouter un équipement</a>
    </section>
    <table>
        <tr class="ColumsHead">
            <th>Équipement</th>
            <th>Description</th>
            <th>Prix unitaire</th>
            <th colspan=2>Actions</th>
        </tr>
        <?php foreach ($equipements as $equipement){
            echo "
            <tr>
                <td>".$equipement->getNom()."</td>
                <td>".$equipement->getDescr()."</td>
                <td>".$equipement->getPrix()."</td>
                <td> Modifier </td> 
                <td> Supprimer </td>
            </tr>";
            }
        ?>
    </table>
    <br>
</div>