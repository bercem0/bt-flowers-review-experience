<?php
$host = 'localhost'; // Database host (server)
$dbname = 'users_db'; // Naam van de database
$username = 'root'; // Database gebruikersnaam
$password = ''; // Database wachtwoord

try {
    // Maak een nieuwe PDO-verbinding met de database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Stel de PDO-foutmodus in op uitzondering
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Stop de uitvoering en toon een foutmelding als de verbinding mislukt
    die("Verbindungsfehler: " . $e->getMessage()); // Toon de foutmelding
}
