<?php
require_once "views/header.php"; // Importeer het header-bestand van de pagina
require_once 'user-functions.php'; // Importeer de functies voor gebruikersbeheer

session_start(); // Start de sessie

// Controleer of de gebruiker is ingelogd en admin is
if (!isUserLoggedIn() || !isUserAdmin()) {
    header('Location: login.php'); // Redirect naar de inlogpagina als de gebruiker niet is ingelogd of geen admin is
    exit;
}

$errors = []; // Array voor foutmeldingen
$success_message = ''; // Variabele voor succesbericht
$product = null; // Variabele voor het product

// Controleer of er een product-ID is meegegeven in de URL
if (isset($_GET['id'])) {
    $product = getProductById($_GET['id']); // Verkrijg het product op basis van het ID
}

// Controleer of het formulier is verzonden met de POST-methode
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = editProduct($_POST['id'], $_POST['name'], $_POST['price'], $_POST['description']); // Bewerk het product
    if ($result['success']) { // Controleer of de bewerking succesvol was
        $success_message = $result['message']; // Sla het succesbericht op
    } else {
        $errors = $result['errors']; // Sla de foutmeldingen op
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Bewerk Product</title>
</head>
<body>
<div class="edit-product-container"><!-- Container voor het bewerken van het product -->
    <h2 class="edit-product-title">Bewerk Product</h2>

    <div class="edit-messages"> <!-- Container voor fout- en succesmeldingen -->

        <?php foreach ($errors as $error): ?> <!-- Toon foutmeldingen -->
            <div class="edit-error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>
        <?php if ($success_message): ?> <!-- Toon succesbericht als aanwezig -->
            <div class="edit-success"><?= htmlspecialchars($success_message) ?></div>

        <?php endif; ?>
    </div>
    <form class="edit-product-form" action="edit_product.php" method="post"> <!-- Formulier voor het bewerken van het product -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>"> <!-- Verborgen invoerveld voor product-ID -->
        Productnaam: <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br><br> <!-- Invoerveld voor productnaam -->
        Prijs: <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br><br> <!-- Invoerveld voor prijs -->
        Beschrijving: <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea><br><br> <!-- Invoerveld voor beschrijving -->
        <button class="edit-btn" type="submit">Product Bijwerken</button> <!-- Knop om het product bij te werken -->
        <button class="edit-dashboard-btn"><a href="admin_dashboard.php">Terug naar Admin Dashboard</a></button> <!-- Terugknop naar het admin dashboard -->
    </form>
</div>
<?php require_once "views/footer.php"; ?>
</body>
</html>
