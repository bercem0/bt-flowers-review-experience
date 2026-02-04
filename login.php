<?php
require_once "views/header.php"; // Importeer het header-bestand van de pagina
require_once 'user-functions.php'; // Importeer de functies voor gebruikersbeheer

session_start(); // Start de sessie

$errors = []; // Array voor foutmeldingen
$success_message = ''; // Variabele voor succesbericht

// Controleer of de gebruiker al is ingelogd
if (isUserLoggedIn()) {
    header('Location: welcome.php'); // Redirect naar de welkomstpagina als de gebruiker al is ingelogd
    exit;
}

// Controleer of het formulier is verzonden met de POST-methode
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Probeer de gebruiker in te loggen met de opgegeven gebruikersnaam en wachtwoord
    $result = loginUser($_POST['username'] ?? '', $_POST['password'] ?? '');

    if ($result['success']) { // Controleer of het inloggen succesvol was
        header('Location: welcome.php'); // Redirect naar de welkomstpagina
        exit;
    } else {
        $errors = $result['errors']; // Sla de foutmeldingen op als het inloggen mislukt
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Inloggen</title>
</head>
<body>
<div class="login-container"> <!-- Container voor het inlogformulier -->
    <h2 class="login-title">Inloggen</h2> <!-- Titel van de sectie -->
    <div class="messages"> <!-- Container voor foutmeldingen -->
        <?php foreach ($errors as $error): ?> <!-- Loop door de foutmeldingen -->
            <div class="error"><?= htmlspecialchars($error) ?></div> <!-- Toon de foutmelding -->
        <?php endforeach; ?>
    </div>
    <form class="login-form" action="login.php" method="post"> <!-- Formulier voor inloggen -->
        Gebruikersnaam: <input type="text" name="username" required /><br /><br /> <!-- Invoerveld voor gebruikersnaam -->
        Wachtwoord: <input type="password" name="password" required /><br /><br /> <!-- Invoerveld voor wachtwoord -->
        <button class="login-btn" type="submit">Login</button> <!-- Knop om het formulier te verzenden -->
    </form>
    <button class="sign-up-button"><a href="sign-up.php">Heeft u nog geen account? Registreren</a></button> <!-- Knop om naar de registratiepagina te gaan -->
    <button class="forgot-password"><a href="forgot-password.php">Wachtwoord vergeten?</a></button> <!-- Knop om naar de wachtwoord vergeten pagina te gaan -->
</div>

<?php require_once "views/footer.php"; ?> <!-- Importeer het footer-bestand van de pagina -->
</body>
</html>

