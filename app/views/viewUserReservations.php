

<div>
    <h1>Réservation du <?= $date_reservation ."de". $Debut ."à". $Fin ; ?></h1>

    <h2>Lieux réserver</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $lieu->getNom() ?></td>
                <td><?= $lieu->getDescr() ?></td>
            </tr>
        </tbody>
    </table>

    <h2>Equipement réserver</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Quantité </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $equipement->getNom() ?></td>
                <td><?= $equipement->getDescr() ?></td>
                <th><?= $equipement->getNombre() ?></th>
            </tr>
        </tbody>
    </table>

    <h2>Service réserver</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $service->getNom() ?></td>
                <td><?= $service->getDescr() ?></td>
            </tr>
        </tbody>
    </table>
</div>