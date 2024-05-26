<form action="index.php?url=reservation/insertReservation" method="post">
    
    <?php 
        $total = 0;
        if (count($lieuxR) > 0) {
            echo"
            <div class='Center'>
                <h1> Tableau récapitulatif des lieux</h1>

                <table>
                    <tr class='ColumsHead'>
                        <th>Lieu</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Location</th>
                    </tr> ";
                    $i = 0;
                    foreach ($lieuxR as $lieu){
                        echo '
                        <tr>
                            <td>'.$lieu->getNom().'</td>
                            <td>'.$lieu->getDescr().'</td>
                            <td>'.$lieu->getPrix().'</td>
                            <td> oui </td>
                        </tr>';
                        $total += $lieu->getPrix()*1;
                        $i++;
                    }
                        echo "
                </table>
                <br>
            </div>";
        }

        if (count($equipementsR) > 0) {
            echo "
            <div class='Center'>
                <h1> Tableau récapitulatif des équipements</h1>
        
                <table>
                    <tr class='ColumsHead'>
                        <th>Équipement</th>
                        <th>Description</th>
                        <th>Prix unitaire</th>
                        <th>Quantité souhaité(s)</th>
                    </tr>";
                    $i = 0;
                    foreach ($equipementsR as $equipement){
                        echo '
                        <tr>
                            <td>'.$equipement->getNom().'</td>
                            <td>'.$equipement->getDescr().'</td>
                            <td>'.$equipement->getPrix().'</td>
                            <td>'.$equipementsQ[$i].'</td>
                        </tr>';
                        $total += $equipement->getPrix()*$equipementsQ[$i];
                        $i++;
                        }
                        echo "
                </table>
                <br>
            </div>";
        }

        if (count($servicesR) > 0) {
            echo "<div class='Center'>
            <h1> Tableau récapitulatif des services</h1>
    
            <table>
                <tr class='ColumsHead'>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Prix prestation</th>
                    <th>Prestation voulue</th>
                </tr>"; 
                $i = 0;
                foreach ($servicesR as $service){
                    echo '
                    <tr>
                        <td>'.$service->getNom().'</td>
                        <td>'.$service->getDescr().'</td>
                        <td>'.$service->getPrix().'</td>
                        <td> oui </td>
                    </tr>';
                    $total += $service->getPrix()*1;
                    $i++;
                    }
                    echo"
            </table>
            <br>    
        </div>";
        }
    ?>

    <br><br>

    <div class="Center">

        <h3>Votre commande coût au total : <?= $total ?></h3>

        <table>
            <thead>
                <tr class="ColumsHead">
                    <th colspan=2>Vos informations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Date de réservation</td>
                    <td> <?= $_SESSION['DayRes']  ?> </td>
                </tr>
                <tr>
                    <td>Heure de début*</td>
                    <td> <?= $_SESSION['StartRes'] ?> </td>
                </tr>
                <tr>
                    <td>Heure de Fin</td>
                    <td> <?= $_SESSION['EndRes'] ?> </td>
                </tr>
                <tr>
                    <td>Remarque</td>
                    <td> <?= $_SESSION['Remarque'] ?> </td>
                </tr>
            </tbody>
        </table>

        <br><br>
        <a href='index.php?url=reservation/newReservation' class='button'>Revenir en arrière.</a>
        <input class='button' type='submit' value='Validez ma commande'>
        <br><br>
    </div>
</form>
