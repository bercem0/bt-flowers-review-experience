<?php
$host = 'localhost'; //Het adres van de database server (in dit geval de lokale server)
$dbname = 'flowers_db'; // Database-naam zoals te zien in phpMyAdmin
$username = 'root'; //De gebruikersnaam voor de database (in dit geval wordt 'root' gebruikt)
$password = ''; //Het wachtwoord voor de database (in dit geval is het wachtwoord leeg)

try {
    //Een PDO-object wordt aangemaakt en een verbinding met de database wordt gemaakt met de karakterset 'utf8mb4'.
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    //Foutafhandelingsmodus wordt ingeschakeld, waarbij fouten als uitzonderingen (exceptions) worden weergegeven.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Als er een verbindingsfout optreedt, wordt het foutbericht weergegeven en wordt het script beëindigd.
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}
?>