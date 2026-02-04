<?php
require_once "views/header.php"; // Importeer het headerbestand

session_start(); // Start de sessie

require_once 'user-functions.php'; // Importeer de functies voor gebruikersbeheer

if (!isUserLoggedIn()) {
    header('Location: login.php'); // Redirect naar de inlogpagina als de gebruiker niet is ingelogd
    exit; // Stop de uitvoering
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welkom</title>
</head>
<body>
<div class="welcome-container"> <!-- Container voor de welkomstsectie -->
    <div class="welcome-title">
        <h1>👋🏻Welkom, <?= htmlspecialchars($_SESSION['username']) ?>!🎀</h1> <!-- Welkomstbericht met gebruikersnaam -->
        <hr class="welcome-divider" /> <!-- Scheidingslijn -->
    </div>

    <div class="welcome-p">
        <p>U bent succesvol ingelogd.</p> <!-- Bericht dat de gebruiker succesvol is ingelogd -->
    </div>

    <div class="welcome-a"> <!-- Actiesectie -->
        <button><a href="logout.php">Uitloggen</a></button> <!-- Knop om uit te loggen -->
        <button><a href="index.php">Home</a></button> <!-- Knop om naar de homepage te gaan -->
        <button><a href="personal-data.php">Persoonlijke Gegevens</a></button> <!-- Knop om naar persoonlijke gegevens te gaan -->
    </div>

</div>
<?php require_once "views/footer.php"; ?> <!-- Importeer het footerbestand van de pagina. -->
</body>
</html>