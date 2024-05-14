<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<header>
    <nav class="menu">
        <ul>
            <li><a href="<?= URL ?>">Accueil</a></li>
            <li><a href="index.php?url=reservation">Réservation</a></li>
            <li>
                <?php 
                    if (isset($_SESSION['User'])) {
                        echo "<a href='index.php?url=profil'>Espace client</a>";
                    } else {
                        echo "<a href='index.php?url=connexion'>Espace client</a>";
                    }
                    
                ?>
            </li>
        </ul>
    </nav>
</header>

<body>

    <?= $content ?>

</body>

<footer>
<nav>
    <ul>
        <li><a href="politique-confidentialite.html">Politique de Confidentialité</a></li>
        <li><a href="conditions-utilisation.html">Conditions d'Utilisation</a></li>
        <li><a href="contact.html">Contactez-nous</a></li>
    </ul>
</nav>
<div class="social-links">
    <a href="#" class="social-icon">Facebook</a>
    <a href="#" class="social-icon">Twitter</a>
    <a href="#" class="social-icon">Instagram</a>
</div>
</footer>
</html>