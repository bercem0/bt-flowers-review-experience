<?php
require_once "views/header.php"; // Importeer het headerbestand
require_once 'user-functions.php'; // Importeer de functies voor gebruikersbeheer

$errors = []; // Array voor foutmeldingen
$success_message = ''; // Variabele voor succesbericht

// Controleer of het formulier is verzonden met de POST-methode
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Probeer de gebruiker te registreren met de opgegeven gegevens
    $result = registerUser ($_POST['firstname'] ?? '', $_POST['lastname'] ?? '', $_POST['date'] ?? '', $_POST['email_address'] ?? '', $_POST['username'] ?? '', $_POST['password'] ?? '', $_POST['password_confirm'] ?? '');

    if ($result['success']) { // Controleer of de registratie succesvol was
        $success_message = $result['message']; // Stel het succesbericht in
    } else {
        $errors = $result['errors']; // Sla de foutmeldingen op als de registratie mislukt
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Registreren</title>
</head>
<body>
<div class="sign-up-container"> <!-- Container voor het registratieformulier -->
    <h2 class="sign-up-title">Registreren</h2>
    <div class="messages"> <!-- Container voor fout- en succesmeldingen -->

        <?php foreach ($errors as $error): ?> <!-- Loop door de foutmeldingen -->
            <div class="error"><?= htmlspecialchars($error) ?></div> <!-- Toon de foutmelding -->
        <?php endforeach; ?>

        <?php if ($success_message): ?> <!-- Controleer of er een succesbericht is -->
            <div class="success"><?= htmlspecialchars($success_message) ?></div> <!-- Toon het succesbericht -->
        <?php endif; ?>
    </div>
    <form class="sign-up-form" action="sign-up.php" method="post"> <!-- Formulier voor registratie -->
        Voornaam:<input type="text" name="firstname" required><br><br> <!-- Invoerveld voor voornaam -->
        Achternaam:<input type="text" name="lastname" required><br><br> <!-- Invoerveld voor achternaam -->
        Geboortedatum:<input type="date" name="date" required><br><br> <!-- Invoerveld voor geboortedatum -->
        E-mailadres:<input type="email" name="email_address" required><br><br> <!-- Invoerveld voor e-mailadres -->
        Gebruikersnaam: <input type="text" name="username" required><br><br> <!-- Invoerveld voor gebruikersnaam -->
        Wachtwoord: <input type="password" name="password" required><br><br> <!-- Invoerveld voor wachtwoord -->
        Wachtwoord (nog een keer): <input type="password" name="password_confirm" required><br><br> <!-- Invoerveld voor bevestiging van wachtwoord -->
        <button class="register" type="submit">Register</button>  <!-- Knop om het formulier te verzenden -->
    </form>

    <button class="sign-up-button"><a href="login.php">Bent u al lid? Inloggen</a></button> <!-- Knop om naar de inlogpagina te gaan -->
    <button class="admin-sign-up"><a href="admin_sign-up.php"> Register als Administrator </a></button> <!-- Knop om naar de registratiepagina voor admins te gaan -->
</div>
<?php require_once "views/footer.php"; ?> <!-- Importeer het footerbestand van de pagina. -->
</body>
</html>