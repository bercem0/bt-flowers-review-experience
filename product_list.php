<?php
require_once "views/header.php"; // Importeer het headerbestand
require_once 'user-functions.php'; // Importeer de functies voor gebruikersbeheer

session_start(); // Start de sessie

if (!isUserLoggedIn() || !isUserAdmin()) {
    header('Location: login.php'); // Redirect naar de inlogpagina als de gebruiker niet is ingelogd of geen admin is
    exit;
}

$products = getProducts(); // Haal de producten op uit de database
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Producten Lijst</title>
</head>
<body>
<div class="product-list-container"> <!-- Container voor de productlijst -->
    <h2>Producten Lijst</h2> <!-- Titel van de sectie -->
    <table>
        <tr>
            <th>Afbeelding</th> <!-- Kolom voor afbeelding -->
            <th>Naam</th> <!-- Kolom voor naam -->
            <th>Prijs</th> <!-- Kolom voor prijs -->
            <th>Acties</th> <!-- Kolom voor acties -->
        </tr>
        <?php foreach ($products as $product): ?> <!-- Loop door de producten -->
            <tr>
                <td>
                    <?php if (!empty($product['image'])): ?> <!-- Controleer of er een afbeelding is -->
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width:100px;"> <!-- Toon de afbeelding -->
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($product['name']) ?></td> <!-- Toon de naam van het product -->
                <td><?= htmlspecialchars($product['price']) ?>€</td> <!-- Toon de prijs van het product -->
                <td>
                    <a class="edit-product-btn" href="edit_product.php?id=<?= $product['id'] ?>">Bewerken</a> <!-- Link om het product te bewerken -->
                    <a class="delete-btn" href="delete_product.php?id=<?= $product['id'] ?>">Verwijderen</a> <!-- Link om het product te verwijderen -->
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button class="admin-dashboard-btn"><a href="admin_dashboard.php">Terug naar Admin Dashboard</a></button> <!-- Knop om terug te gaan naar het admin dashboard -->
</div>
<?php require_once "views/footer.php"; ?>
</body>
</html>