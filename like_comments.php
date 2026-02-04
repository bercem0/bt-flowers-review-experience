<?php
require_once "config.php"; // Voor mysqli connectie $conn

// Controleer of het formulier is verzonden met de POST-methode en of er een comment_id is
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_id'])) {
    $comment_id = intval($_POST['comment_id']); // Zet de comment_id om naar een integer
    $flower_id = intval($_POST['flower_id']); // Zet de flower_id om naar een integer

    // SQL-query om het aantal likes van de reactie te verhogen
    $sql = "UPDATE flower_comments SET likes = likes + 1 WHERE id = ?";
    $stmt = $conn->prepare($sql); // Bereid de SQL-query voor
    if ($stmt) { // Controleer of de voorbereiding succesvol was
        $stmt->bind_param("i", $comment_id); // Bind de comment_id parameter
        $stmt->execute(); // Voer de SQL-query uit
        $stmt->close(); // Sluit de statement
    }

    // Redirect naar de detailpagina van de bloem
    header("Location: flower-detail.php?id=" . $flower_id);
    exit(); // Stop de uitvoering van het script
}
