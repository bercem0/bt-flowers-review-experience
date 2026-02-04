<?php
ini_set('display_errors', 1); // Fouten weergeven
ini_set('display_startup_errors', 1); // Start-up fouten weergeven
error_reporting(E_ALL); // Alle fouten rapporteren

require_once "views/header.php"; // Header-bestand importeren
require_once 'user-functions.php'; // Functies voor gebruikersbeheer importeren
session_start(); // Start de sessie

// Controleer of de gebruiker is ingelogd en admin is
if (!isUserLoggedIn() || !isUserAdmin()) {
    header('Location: login.php'); // Redirect naar de inlogpagina als de gebruiker niet is ingelogd of geen admin is
    exit;
}

$errors = []; // Array voor foutmeldingen
$success_message = ''; // Variabele voor succesbericht
$image_path = ''; // Variabele voor het pad van de afbeelding

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Controleer of het verzoek een POST-verzoek is

    $name = trim($_POST['name'] ?? ''); // Haal de productnaam op en verwijder spaties
    $price = trim($_POST['price'] ?? ''); // Haal de prijs op en verwijder spaties
    $description = trim($_POST['description'] ?? ''); // Haal de beschrijving op en verwijder spaties

    // Validatie van de invoer
    if ($name === '') {
        $errors[] = "Productnaam is verplicht."; // Foutmelding als de productnaam leeg is
    }
    if ($price === '' || !is_numeric($price) || $price < 0) {
        $errors[] = "Voer een geldige prijs in."; // Foutmelding als de prijs ongeldig is
    }
    if ($description === '') {
        $errors[] = "Beschrijving is verplicht."; // Foutmelding als de beschrijving leeg is
    }

    // Afbeelding uploaden
    if (!empty($_FILES['image']['name'])) {

        $target_dir = "uploads/"; // Doelmap voor uploads
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true); // Maak de map aan als deze niet bestaat
        }
        $image_name = basename($_FILES['image']['name']); // Haal de bestandsnaam van de afbeelding op
        $image_path = $target_dir . $image_name; // Stel het pad van de afbeelding in
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION)); // Haal de bestandsextensie op
        $allowed_types = ['jpg','jpeg','png','gif']; // Toegestane bestandstypen

        // Controleer of het bestandstype geldig is
        if (!in_array($imageFileType, $allowed_types)) {
            $errors[] = "Je kunt alleen JPG-, JPEG-, PNG- of GIF-bestanden uploaden."; // Foutmelding voor ongeldig bestandstype

        } elseif ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
            $errors[] = "De foto mag maximaal 2 MB zijn."; // Foutmelding als de afbeelding te groot is

        } elseif (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            $errors[] = "Er is een probleem met het uploaden van de afbeelding."; // Foutmelding als het uploaden mislukt

        }
    } else {
        $errors[] = "Afbeelding is verplicht."; // Foutmelding als er geen afbeelding is geüpload
    }

    // Als er geen fouten zijn, voeg het product toe
    if (empty($errors)) {
        try {
            $result = addProduct($name, $price, $description, $image_path); // Voeg het product toe

            if ($result['success']) {
                $success_message = $result['message']; // Sla het succesbericht op
                $name = $price = $description = ''; // Reset de invoervelden
            } else {
                $errors[] = "Er is een fout opgetreden bij het toevoegen van het product."; // Foutmelding als het toevoegen mislukt
            }
        } catch (Exception $e) {
            $errors[] = "Er is een onverwachte fout opgetreden: " . htmlspecialchars($e->getMessage()); // Foutmelding voor onverwachte fouten
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Product Toevoegen</title>
</head>
<body>
<div class="add_product-container">
    <h2 class="add_product-title">Voeg Product Toe</h2>

    <div class="messages">
        <?php foreach ($errors as $error): ?> <!-- Toon foutmeldingen -->
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>

        <?php if ($success_message): ?>
            <div class="success"><?= htmlspecialchars($success_message) ?></div> <!-- Toon succesbericht als aanwezig -->
        <?php endif; ?>
    </div>

    <form class="add_product-form" action="add_product.php" method="post" enctype="multipart/form-data" novalidate>
        <label for="name">Productnaam</label>
        <input type="text" name="name" id="name" required value="<?= htmlspecialchars($name ?? "") ?>"> <!-- Invoerveld voor productnaam -->

        <label for="price">Prijs (€)</label>
        <input type="number" name="price" id="price" step="0.01" min="0" required value="<?=htmlspecialchars($price ?? "")?>"> <!-- Invoerveld voor prijs -->

        <label for="description">Beschrijving</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($description ?? "") ?></textarea> <!-- Invoerveld voor beschrijving -->

        <label for="image" class="custom-file-upload">Kies Afbeelding</label>
        <input type="file" name="image" id="image" accept="image/*" required style="display:none;"> <!-- Invoerveld voor afbeelding -->

        <button class="add_product" type="submit">Toevoegen</button>
        <a href="admin_dashboard.php" class="back-button" role="button">Terug naar Admin Dashboard</a> <!-- Terugknop naar het admin dashboard -->
    </form>
</div>
<?php require_once "views/footer.php"; ?> <!-- Footer-bestand importeren -->
</body>
</html>
