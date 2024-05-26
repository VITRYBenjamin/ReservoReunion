<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="public/css/styles.css">

</head>

<header>
    <div class="nav-wrapper">
        <div class="menu">
            <ul>
                <li><a href="index.php?url=home/home">Accueil</a></li>
                <li><a href="index.php?url=reservation/newReservation">Réservation</a></li>
                <li>
                    <?php 
                        if (isset($_SESSION['id'])) {
                            echo "<a href='index.php?url=utilisateur/utilisateur'>Espace client</a>";
                        } else {
                            echo "<a href='index.php?url=utilisateur/login'>Espace client</a>";
                        }
                    ?>
                </li>
            </ul>
        </div>
        <div class="login-button">
            <?php 
                if (isset($_SESSION['id'])) {
                    echo "<a href='index.php?url=utilisateur/logout' class='button'>Se déconnecter</a>";
                } else {
                    echo "<a href='index.php?url=utilisateur/login' class='button'>Se connecter</a>";
                }
            ?>
        </div>
    </div>
</header>


<body>

    <?= $content ?>

</body>

<footer>
<nav>
    <ul>
        <li><a href="">Politique de Confidentialité</a></li>
        <li><a href="">Conditions d'Utilisation</a></li>
        <li><a href="">Contactez-nous</a></li>
    </ul>
</nav>
<div class="social-links">
    <a href="" class="social-icon">Facebook</a>
    <a href="" class="social-icon">Twitter</a>
    <a href="" class="social-icon">Instagram</a>
</div>
</footer>
</html>