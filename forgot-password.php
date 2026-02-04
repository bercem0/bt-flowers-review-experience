<?php
require_once "views/header.php"; // Importeer het header-bestand van de pagina
require_once 'user-functions.php'; // Importeer de functies voor gebruikersbeheer

$errors = []; // Array voor foutmeldingen
$success_message = ''; // Variabele voor succesbericht

// Controleer of het formulier is verzonden met de POST-methode
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['email_address']); // Verkrijg het e-mailadres en verwijder spaties

    if (!empty($username)) { // Controleer of het e-mailadres niet leeg is
        $success_message = "Een e-mail is verzonden naar uw geregistreerde e-mailadres om uw wachtwoord te resetten."; // Stel het succesbericht in
    } else {
        $errors[] = "E-mail Adres is verplicht."; // Voeg een foutmelding toe als het e-mailadres leeg is
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8"> <!-- Stel de karaktercodering in op UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Zorg voor responsief ontwerp -->
    <link rel="stylesheet" href="css/style.css"> <!-- Koppel de CSS-stylesheet -->
    <title>Wachtwoord Vergeten</title> <!-- Titel van de pagina -->
</head>
<body>
<div class="login-container"> <!-- Container voor het wachtwoord vergeten formulier -->
    <h2 class="login-title">Wachtwoord Vergeten</h2> <!-- Titel van de sectie -->
    <div class="messages"> <!-- Container voor fout- en succesmeldingen -->
        <?php foreach ($errors as $error): ?> <!-- Loop door de foutmeldingen -->
            <div class="error"><?= htmlspecialchars($error) ?></div> <!-- Toon de foutmelding -->
        <?php endforeach; ?>
        <?php if ($success_message): ?> <!-- Controleer of er een succesbericht is -->
            <div class="success"><?= htmlspecialchars($success_message) ?></div> <!-- Toon het succesbericht -->
        <?php endif; ?>
    </div>
    <form class="login-form" action="forgot-password.php" method="post"> <!-- Formulier voor het vergeten wachtwoord -->
        E-mail Adres: <input type="email" name="email_address" required><br><br> <!-- Invoerveld voor e-mailadres -->
        <button class="login-btn" type="submit">Verstuur</button> <!-- Knop om het formulier te verzenden -->
    </form>
    <button class="sign-up-button"><a href="login.php">Terug naar Inloggen</a></button> <!-- Knop om terug te gaan naar de inlogpagina -->
</div>
<?php require_once "views/footer.php"; ?> <!-- Importeer het footer-bestand van de pagina -->
</body>
</html>
