<div class="Center">
    <h1> Tableau récapitulatif des services</h1>

    <section class="cta">
        <a href="ajoutService.php" class="button">Ajouter un service</a>
    </section>
    <table>
        <tr class="ColumsHead">
            <th>Service</th>
            <th>Description</th>
            <th>Prix prestation</th>
            <th colspan=2>Actions</th>
        </tr>
        <?php foreach ($services as $service){
            echo "
            <tr>
                <td>".$service->getNom()."</td>
                <td>".$service->getDescr()."</td>
                <td>".$service->getPrix()."</td>
                <td> Modifier </td> 
                <td> Supprimer </td>
            </tr>";
            }
        ?>
    </table>
    <br>    
</div>