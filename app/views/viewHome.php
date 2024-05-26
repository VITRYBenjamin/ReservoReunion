<?php 
    if (isset($message)) {
        echo "<h2>" . $message . "</h2>";
    }
?>

<div style="margin-left: 5vw;">
    <section class="presentation">
        <h2>À propos de notre application</h2>
        <p>Ici, vous pouvez ajouter une brève présentation de votre application et ses fonctionnalités principales.</p>
    </section>

    <section class="features">
        <h2>Fonctionnalités principales</h2>
        <div class="feature">
            <h3>Fonctionnalité 1</h3>
            <p>Description de la fonctionnalité 1</p>
        </div>
        <div class="feature">
            <h3>Fonctionnalité 2</h3>
            <p>Description de la fonctionnalité 2</p>
        </div>
        <!-- Ajoutez d'autres fonctionnalités ici -->
    </section>

    <section class="testimonials">
        <h2>Témoignages</h2>
        <div class="testimonial">
            <p>"Témoignage 1 de client satisfait"</p>
            <cite>Nom du Client</cite>
        </div>
        <!-- Ajoutez d'autres témoignages ici -->
    </section>

    <section class="cta">
        <h2>Prêt à commencer ?</h2>
        <a href="index.php?url=utilisateur/register" class="button">Inscrivez-vous maintenant</a>
    </section>
</div>