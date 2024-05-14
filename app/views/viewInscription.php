
<h1>Inscription</h1>
<form action="inscription.php" method="post">
    <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
    </div>
    <div>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Doit contenir au moins 8 caractères dont 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial">
    </div>
    <div>
        <label for="password_confirm">Confirmer le mot de passe :</label>
        <input type="password" id="password_confirm" name="password_confirm" required>
    </div>
    <button type="submit">S'inscrire</button>
</form>
