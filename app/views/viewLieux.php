<div class="Center">
    <h1> Tableau récapitulatif des lieux</h1>

    <section class="cta">
        <a href="ajoutLieu.php" class="button">Ajouter un lieu</a>
    </section>
    <table>
        <tr class="ColumsHead">
            <th>Lieu</th>
            <th>Description</th>
            <th>Prix</th>
            <th colspan=2>Actions</th>
        </tr>
        <?php foreach ($lieux as $lieu){
            echo "
            <tr>
                <td>".$lieu->getNom()."</td>
                <td>".$lieu->getDescr()."</td>
                <td>".$lieu->getPrix()."</td>
                <td> Modifier </td> 
                <td> Supprimer </td>
            </tr>";
            }
        ?>
    </table>
    <br>    
</div>