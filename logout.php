<?php
require_once 'user-functions.php'; // Importeer de functies voor gebruikersbeheer

logoutUser (); // Log de gebruiker uit

header('Location: login.php'); // Redirect naar de inlogpagina

exit; // Stop de uitvoering van het script

?>