<div class="Center">
    <h1>Connexion</h1>
    <form action="index.php?url=utilisateur/connection" method="post">
        <div>
            <div>
                <label for="email">Email :</label><br>
                <input type="email" id="email" name="email" required>
            </div>
            <br>
            <div>
                <label for="password">Mot de passe :</label><br>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
            <div>
                <?php 
                if (isset($message)) {
                    echo $message . "<br/><br/>";
                }
                ?>
                <button type="submit">Se connecter</button>
            </div>
            <br>
        </div>
    </form>
    
    <section class="">
    <h2>Vous n'avez pas de compte ? Inscrivez-vous !</h2>
    <a href="index.php?url=utilisateur/register" class="button">Inscrivez-vous maintenant</a>
</section>
</div>
