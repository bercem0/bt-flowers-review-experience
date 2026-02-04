<?php
require_once "config.php"; // Databaseverbinding importeren

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het verzoek een POST-verzoek is

    $flower_id = $_POST['flower_id']; // Haal de bloem ID op uit de POST-gegevens
    $name = trim($_POST['name']); // Verwijder spaties aan het begin en einde van de naam
    $message = trim($_POST['message']); // Verwijder spaties aan het begin en einde van het bericht

    if (!empty($flower_id) && !empty($name) && !empty($message)) { // Controleer of alle velden zijn ingevuld

        $sql = "INSERT INTO flower_comments (flower_id, name, message, created_at) VALUES (?, ?, ?, NOW())"; // SQL-query voor het invoegen van een nieuw commentaar
        $stmt = $conn->prepare($sql); // Bereid de SQL-query voor

        if ($stmt) { // Controleer of de voorbereiding succesvol was

            $stmt->bind_param("iss", $flower_id, $name, $message); // Bind de parameters aan de SQL-query
            $stmt->execute(); // Voer de SQL-query uit
            $stmt->close(); // Sluit de statement
            header("Location: flower-detail.php?id=" . $flower_id); // Redirect naar de detailpagina van de bloem
            exit(); // Stop de uitvoering van het script

        } else {
            echo "Error: " . $conn->error; // Toon een foutmelding als de voorbereiding mislukt
        }
    } else {
        echo "Please fill in all fields."; // Vraag de gebruiker om alle velden in te vullen
    }
} else {
    echo "Invalid request."; // Toon een foutmelding voor een ongeldig verzoek
}
?>