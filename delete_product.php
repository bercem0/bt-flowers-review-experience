<?php
require_once "views/header.php";
require_once 'user-functions.php';

session_start();

if (!isUserLoggedIn() || !isUserAdmin()) { // Controleer of de gebruiker is ingelogd en admin is
    header('Location: login.php');  // Redirect naar de inlogpagina als de gebruiker niet is ingelogd of geen admin is
    exit;
}

// Controleer of er een product-ID is meegegeven in de URL
if (isset($_GET['id'])) {
    $result = deleteProduct($_GET['id']); // Verwijder het product met het opgegeven ID
    if ($result['success']) { // Controleer of het verwijderen succesvol was
        header('Location: product_list.php'); // Redirect naar de productlijst na succesvol verwijderen
        exit;
    }
}
?>
