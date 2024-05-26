<div class="Center">
    <section class='Edit'>
        <a href='' class='button'>Modifier mes informations</a>
        <a href='index.php?url=utilisateur/showUserReservation' class='button'>Voir mes réservations</a>
    </section>
    <table>
        <thead class = 'ColumsHead'>
            <tr>
                <th colspan="2">Vos informations</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nom :</td>
                <td><?= htmlspecialchars($utilisateur->getNom()) ?></td>
            </tr>
            <tr>
                <td>Prénom :</td>
                <td><?= htmlspecialchars($utilisateur->getPrenom()) ?></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><?= htmlspecialchars($utilisateur->getEmail()) ?></td>
            </tr>
            <tr>
                <td>Téléphone :</td>
                <td><?= htmlspecialchars($utilisateur->getPhone()) ?></td>
            </tr>
        </tbody>
    </table>
    <section class='PwdRight'>
        <a href='' class='button'>Modifier le mot de passe</a>
    </section>
    <br>
</div>