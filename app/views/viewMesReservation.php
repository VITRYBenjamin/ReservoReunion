
<?php 
    echo "<div class = 'Center'>";

    foreach ($reservations as $reservation){
        echo "<h1>Réservation n°".$reservation[0][0] ." du " .$reservation[0][1]. " de " .$reservation[0][2]. " à " .$reservation[0][3]. "</h1> <br>";

        if (!empty($reservation[1])) {
            
            echo "<h2>Listes des équipements réserver</h2>
            <table>
                <thead>
                    <tr class='ColumsHead'>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>";
            
            foreach ($reservation[1] as $equipement) {
                echo "<tr><td>".$equipement[0]."</td>";
                echo "<td>".$equipement[1]."</td>";
                echo "<td>".$equipement[2]."</td></tr>";
            }
            echo "
                </tbody>
            </table>";
        }

        if (!empty($reservation[2])) {
            echo "<h2>Listes des lieux réserver</h2>
            <table>
                <thead>
                    <tr class='ColumsHead'>
                        <th>Nom</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>";
            
            foreach ($reservation[2] as $lieu) {
                echo "<tr><td>".$lieu['nom']."</td>";
                echo "<td>".$lieu['descr']."</td></tr>";
            }
            echo "
                </tbody>
            </table>";
        }

        if (!empty($reservation[3])) {
            
            echo "<h2>Listes des services réserver</h2>
            <table>
                <thead>
                    <tr class='ColumsHead'>
                        <th>Nom</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>";
            
            foreach ($reservation[3] as $service) {
                echo "<tr><td>".$service['nom']."</td>";
                echo "<td>".$service['descr']."</td></tr>";
            }
            echo "
                </tbody>
            </table> <br>";
        }

    }
?>

