<?php
// Toon alle PHP foutmeldingen t.b.v. debugging, dit kan later uit na live
ini_set('display_errors', 1); // Zet foutweergave aan
ini_set('display_startup_errors', 1); // Zet start-up foutweergave aan
error_reporting(E_ALL); // Rapporteren van alle fouten

require_once "config.php"; // Voor mysqli connectie $conn

// Check of id parameter bestaat in URL
if (!isset($_GET['id']) || empty($_GET['id'])) { // Controleer of de ID-parameter aanwezig is
    die("Flower ID ontbreekt.");
}

$flower_id = intval($_GET['id']);

// Bereid statement om bloem op te halen
$sql = "SELECT * FROM flowers WHERE id = ?"; // SQL-query om de bloem op te halen
$stmt = $conn->prepare($sql); // Bereid de SQL-query voor
if (!$stmt) {
    die("Prepare failed: " . $conn->error); // Stop de uitvoering en geef een foutmelding als de voorbereiding mislukt
}
$stmt->bind_param("i", $flower_id); // Bind de parameter
$stmt->execute(); // Voer de SQL-query uit
$result = $stmt->get_result(); // Verkrijg het resultaat

if ($result->num_rows === 0) { // Controleer of er geen resultaten zijn
    die("Bloem niet gevonden."); // Stop de uitvoering en geef een foutmelding
}

$flower = $result->fetch_assoc(); // Haal de bloemgegevens op
$stmt->close(); // Sluit de statement

require_once "views/header.php";
?>

<div class="container-detail"> <!-- Container voor de bloemdetails -->
    <div class="flower-detail"> <!-- Sectie voor bloemdetails -->
        <h2><?= htmlspecialchars($flower['name']) ?></h2> <!-- Toon de naam van de bloem -->
        <p class="price">Prijs: <?= number_format($flower['price'], 2, ',', '.') ?>€</p> <!-- Toon de prijs van de bloem -->
        <?php if (!empty($flower['image'])): ?> <!-- Controleer of er een afbeelding is -->
            <img src="img/<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>"> <!-- Toon de afbeelding van de bloem -->
        <?php endif; ?>
        <?php if (!empty($flower['description'])): ?> <!-- Controleer of er een beschrijving is -->
            <p class="description"><?= nl2br(htmlspecialchars($flower['description'])) ?></p> <!-- Toon de beschrijving van de bloem -->
        <?php endif; ?>
    </div>

    <div class="comments-section"> <!-- Sectie voor reacties -->
        <h3>Reacties</h3>
        <?php
        $sqlComments = "SELECT * FROM flower_comments WHERE flower_id = ? ORDER BY created_at DESC"; // SQL-query om reacties op te halen
        $stmt = $conn->prepare($sqlComments); // Bereid de SQL-query voor

        if (!$stmt) {
            echo "<p>Fout bij ophalen reacties: " . htmlspecialchars($conn->error) . "</p>"; // Toon foutmelding als de voorbereiding mislukt
        } else {
            $stmt->bind_param("i", $flower_id); // Bind de parameter
            $stmt->execute(); // Voer de SQL-query uit
            $commentsResult = $stmt->get_result(); // Verkrijg het resultaat van de reacties

            if ($commentsResult->num_rows > 0) { // Controleer of er reacties zijn
                while ($comment = $commentsResult->fetch_assoc()) { // Loop door de reacties
                    ?>

                    <div class="comment"> <!-- Container voor een enkele reactie -->
                        <p><strong><?= htmlspecialchars($comment['name']) ?>:</strong></p> <!-- Toon de naam van de reageerder -->
                        <p><?= nl2br(htmlspecialchars($comment['message'])) ?></p> <!-- Toon het bericht van de reactie -->
                        <p><em>Geplaatst op <?= htmlspecialchars($comment['created_at']) ?></em></p> <!-- Toon de datum van de reactie -->
                        <p>Likes: <?= htmlspecialchars($comment['likes']) ?></p> <!-- Toon het aantal likes -->
                        <form action="like_comments.php" method="POST"> <!-- Formulier om een like toe te voegen -->
                            <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>"> <!-- Verborgen invoerveld voor commentaar-ID -->
                            <input type="hidden" name="flower_id" value="<?= $flower_id ?>"> <!-- Verborgen invoerveld voor bloem-ID -->
                            <button type="submit">Like</button> <!-- Knop om de reactie te liken -->
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p style='color:#ef4444;'>Nog geen reacties. Wees de eerste om te reageren!</p>"; // Toon bericht als er geen reacties zijn
            }
            $stmt->close(); // Sluit de statement
        }
        ?>
    </div>



    <div class="comment-form"> <!-- Sectie voor het toevoegen van een reactie -->
        <h3>Voeg een reactie toe</h3>
        <form action="add_comment.php" method="POST"> <!-- Formulier om een nieuwe reactie toe te voegen -->
            <input type="hidden" name="flower_id" value="<?= $flower_id ?>"> <!-- Verborgen invoerveld voor bloem-ID -->
            <input type="text" name="name" placeholder="Je naam" required> <!-- Invoerveld voor naam -->
            <textarea name="message" placeholder="Je bericht" required></textarea> <!-- Invoerveld voor bericht -->
            <button type="submit">Reactie toevoegen</button> <!-- Knop om de reactie toe te voegen -->
        </form>
    </div>
</div>

<?php require_once "views/footer.php"; ?>
