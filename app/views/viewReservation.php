<form action="index.php?url=attenteReservation" method="post">
    
    <div class="Center">
        <h1> Tableau récapitulatif des lieux</h1>

        <table>
            <tr class="ColumsHead">
                <th>Lieu</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Location</th>
            </tr>
            <?php foreach ($lieux as $lieu){
                echo "
                <tr>
                    <td>".$lieu->getNom()."</td>
                    <td>".$lieu->getDescr()."</td>
                    <td>".$lieu->getPrix()."</td>
                    <td><input type='checkbox' id='".$lieu->getAlias()."' name='".$lieu->getAlias()."'></td>
                </tr>";
                }
            ?>
        </table>
        <br>    
    </div>

    <div class="Center">
        <h1> Tableau récapitulatif des équipements</h1>

        <table>
            <tr class="ColumsHead">
                <th>Équipement</th>
                <th>Description</th>
                <th>Prix unitaire</th>
                <th>Quantité souhaité(s)</th>
            </tr>
            <?php 
            foreach ($equipements as $equipement){
                echo "
                <tr>
                    <td>".$equipement->getNom()."</td>
                    <td>".$equipement->getDescr()."</td>
                    <td>".$equipement->getPrix()."</td>
                    <td><input type='number' id='".$equipement->getAlias()."' name='".$equipement->getAlias()."' max=4 min=0 value=0></td>
                </tr>";
                }
            ?>
        </table>
        <br>
    </div>

    <div class="Center">
        <h1> Tableau récapitulatif des services</h1>

        <table>
            <tr class="ColumsHead">
                <th>Service</th>
                <th>Description</th>
                <th>Prix prestation</th>
                <th>Prestation voulue</th>
            </tr>
            <?php foreach ($services as $service){
                echo "
                <tr>
                    <td>".$service->getNom()."</td>
                    <td>".$service->getDescr()."</td>
                    <td>".$service->getPrix()."</td>
                    <td><input type='checkbox' id='".$service->getAlias()."' name='".$service->getAlias()."'></td>
                </tr>";
                }
            ?>
        </table>
        <br>    
    </div>

    <br><br>

    <div class="Center">

        <h3>Nous aurons besoin de quelques informations pour pouvsuivre votre réservation.</h3>

        <table>
            <thead>
                <tr class="ColumsHead">
                    <th>Information nécessaire</th>
                    <th>Vos informations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for='DayRes'>Date de réservation*</label></td>
                    <td><input type='date'  id='DayRes' name='DayRes' required></td>
                </tr>
                <tr>
                    <td><label for='StartRes'>Heure de début*</label></td>
                    <td><input type='time'  id='StartRes' name='StartRes' required></td>
                </tr>
                <tr>
                    <td><label for='EndRes'>Heure de Fin*</label></td>
                    <td><input type='time'  id='EndRes' name='EndRes' required></td>
                </tr>
                <tr>
                    <td><label for='Remarque'>Remarque</label></td>
                    <td><textarea id='Remarque' name='Remarque' rows='4' cols='30' maxlength='1500'></textarea><br></td>
                </tr>
            </tbody>
        </table>
        <p>* Champs obligatoires.</p>

        <br><br>
        <input class='button-like' type='submit' value='Vérifier votre matériel'>
        <br><br>
    </div>
</form>
