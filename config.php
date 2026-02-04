<?php
$servername = "localhost"; //Dit is de naam van de server waarop de database draait.
$username = "root"; //Dit is de gebruikersnaam voor de database.
$password = ""; //Het wachtwoord van de gebruiker (kan leeg zijn, maar niet aanbevolen voor productie).
$database = "flowers_db"; //De naam van de database waarmee verbinding wordt gemaakt.

$conn = new mysqli($servername, $username, $password, $database); //Maak verbinding met de database via MySQLi.

// Controleer de verbinding
if ($conn->connect_error) {  //Controleer of er een verbindingsfout is.
    die("Connection failed: " . $conn->connect_error); //Als de verbinding mislukt, stop dan en geef de foutmelding.
}
?>