<h1>Inscription</h1>
<div class="CenterI">
    <form action="index.php?url=utilisateur/registration" method="post">
        <div>
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>
        </div>
        <br>
        <div>
            <label for="firstName">Prénom :</label>
            <input type="text" id="firstName" name="firstName" required>
        </div>
        <br>
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <br>
        <div>
            <label for="phone">Téléphone :</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <br>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%_*?&])[A-Za-z\d@$!%*?_#&]{8,}$" title="Doit contenir au moins 8 caractères dont 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial" required>
        </div>
        <br>

        <div>
            <label for="passwordConfirm">Confirmer le mot de passe :</label>
            <input type="password" id="passwordConfirm" name="passwordConfirm" required>
        </div>
        <br>
        <button type="submit">S'inscrire</button>

        <br>
        <section class="">
        <h2>Vous avez un compte ? inscrivez-vous</h2>
        <a href="index.php?url=utilisateur/login" class="button">Se connecter</a>
    </form>
</div>
