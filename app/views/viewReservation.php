<form action="index.php?url=reservation/recapReservation" method="post" onsubmit="return validateForm()">
    <div class="Center">
        <h2> 
            <?php 
                if (isset($message)) {
                    echo $message;
                }
            ?>
        </h2>
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
                    <td><input type='checkbox' class='lieu' id='".$lieu->getAlias()."' name='".$lieu->getAlias()."'></td>
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
                    <td><input type='number' class='equipement' id='".$equipement->getAlias()."' name='".$equipement->getAlias()."' max=4 min=0></td>
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
                    <td><input type='checkbox' class='service' id='".$service->getAlias()."' name='".$service->getAlias()."'></td>
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
        <?php 
            if (isset($_SESSION['id'])) {
                echo "<input class='button' type='submit' value='Vérifier votre matériel'>";
            } else {
                echo "Vous devez vous inscrire pour utiliser notre système de réservation. <br>
                Vous pouvez le faire ici : <a href='index.php?url=utilisateur/register' class='button'>Inscrivez-vous maintenant</a>";         
            }
        ?>
        
        <br><br>
    </div>
</form>

<!-- Script JavaScript pour la validation du formulaire -->
<script>
    function validateForm() {
        var selectedDate = new Date(document.getElementById('DayRes').value);
        var currentDate = new Date();

        if (selectedDate < currentDate) {
            alert('La date de réservation doit être ultérieure ou égale à la date actuelle.');
            return false;
        }

        var startTime = document.getElementById('StartRes').value;
        var endTime = document.getElementById('EndRes').value;

        if (startTime >= endTime) {
            alert('L\'heure de début doit être antérieure à l\'heure de fin.');
            return false;
        }

        // Vérification qu'au moins un élément des services est sélectionné
        var services = document.getElementsByClassName('service');
        var serviceSelected = false;

        for (var i = 0; i < services.length; i++) {
            if (services[i].checked) {
                serviceSelected = true;
                break;
            }
        }

        // Vérification qu'au moins un élément des équipements est rempli
        var equipements = document.getElementsByClassName('equipement');
        var equipementFilled = false;

        for (var i = 0; i < equipements.length; i++) {
            if (equipements[i].value > 0) {
                equipementFilled = true;
                break;
            }
        }

        // Vérification qu'au moins un élément des lieux est sélectionné
        var lieux = document.getElementsByClassName('lieu');
        var lieuSelected = false;

        for (var i = 0; i < lieux.length; i++) {
            if (lieux[i].checked) {
                lieuSelected = true;
                break;
            }
        }

        if (!serviceSelected && !equipementFilled && !lieuSelected) {
            alert('Veuillez sélectionner au moins un élément à réserver.');
            return false;
        }

        // Si toutes les validations passent, le formulaire peut être soumis
        return true;
    }
</script>
