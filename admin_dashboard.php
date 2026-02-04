<?php
require_once 'views/header.php'; // Header-bestand importeren
require_once 'user-functions.php';  // Functies voor gebruikersbeheer importeren

session_start();

// Controleer of de gebruiker is ingelogd en admin is
if (!isUserLoggedIn() || !isUserAdmin()) {
    header('Location: login.php'); // Redirect naar de inlogpagina als de gebruiker niet is ingelogd of geen admin is
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Dashboard</title>
</head>
<body>
<div class="admin-dashboard-container">
    <h2 class="admin-dashboard-title">Admin Dashboard</h2>
    <div class="admin-functions"> <!-- Container voor admin functies -->
        <button class="add_product-button"><a href="add_product.php">Voeg Product Toe</a></button> <!-- Knop om een product toe te voegen -->
        <button class="product_list-button"><a href="product_list.php">Bekijk Producten</a></button> <!-- Knop om de productlijst te bekijken -->
    </div>
    <button class="admin-logout-button"><a href="logout.php">Uitloggen</a></button>
</div>
<?php require_once "views/footer.php"; ?>
</body>
</html>