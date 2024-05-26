<div class="error-message">
    <h1>Erreur</h1>
    <p>Code de l'erreur: <?= $errorCode ?? 'N/A' ?></p>
    <p>Message: <?= htmlspecialchars($errorMsg, ENT_QUOTES, 'UTF-8') ?></p>
</div>