<?php
require_once "views/header.php"; // Importeer het headerbestand
require_once 'user-functions.php'; // Importeer de functies voor gebruikersbeheer

session_start();

// Controleer of de gebruiker is ingelogd
if (!isUserLoggedIn()) {
    header('Location: login.php'); // Redirect naar de inlogpagina als de gebruiker niet is ingelogd
    exit;
}

global $pdo; // Maak de PDO-verbinding globaal beschikbaar
$user_id = $_SESSION['user_id']; // Verkrijg de gebruikers-ID uit de sessie
$user_data = []; // Array voor gebruikersgegevens

// Fetch user data from the database
$stmt = $pdo->prepare("SELECT firstname, lastname, date, email_address, username FROM users WHERE id = :id");
$stmt->execute([':id' => $user_id]); // Voer de query uit met de gebruikers-ID
$user_data = $stmt->fetch(PDO::FETCH_ASSOC); // Verkrijg de gegevens als een associatieve array

$errors = [];
$success_message = '';

// Controleer of het formulier is verzonden met de POST-methode
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']); // Verkrijg en trim de voornaam
    $lastname = trim($_POST['lastname']); // Verkrijg en trim de achternaam
    $date = trim($_POST['date']); // Verkrijg en trim de geboortedatum
    $email_address = trim($_POST['email_address']); // Verkrijg en trim het e-mailadres
    $username = trim($_POST['username']); // Verkrijg en trim de gebruikersnaam

    // Validate input
    if (empty($firstname) || empty($lastname) || empty($date) || empty($email_address) || empty($username)) {
        $errors[] = "Alle velden zijn verplicht.";
    } else {
        // Update user data in the database
        $stmt = $pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email_address = :email_address, date = :date, username = :username WHERE id = :id");
        $stmt->execute([
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':date' => $date,
            ':email_address' => $email_address,
            ':username' => $username,
            ':id' => $user_id,
        ]);
        $success_message = "Persoonlijke gegevens zijn succesvol bijgewerkt!";
        // Refresh user data
        $user_data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'date' => $date,
            'email_address' => $email_address,
            'username' => $username,
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Persoonlijke Gegevens</title>
</head>
<body>
<div class="personal-data-container"> <!-- Container voor persoonlijke gegevens -->
    <h2 class="personal-data-title">Persoonlijke Gegevens</h2> <!-- Titel van de sectie -->
    <div class="messages"> <!-- Container voor fout- en succesmeldingen -->
        <?php foreach ($errors as $error): ?> <!-- Loop door de foutmeldingen -->
            <div class="error"><?= htmlspecialchars($error) ?></div> <!-- Toon de foutmelding -->
        <?php endforeach; ?>
        <?php if ($success_message): ?> <!-- Controleer of er een succesbericht is -->
            <div class="success"><?= htmlspecialchars($success_message) ?></div> <!-- Toon het succesbericht -->
        <?php endif; ?>
    </div>
    <form class="personal-data-form" action="personal-data.php" method="post">
        Voornaam: <input type="text" name="firstname" value="<?= htmlspecialchars($user_data['firstname']) ?>" required><br><br>
        Achternaam: <input type="text" name="lastname" value="<?= htmlspecialchars($user_data['lastname']) ?>" required><br><br>
        Geboortedatum: <input type="date" name="date" value="<?= htmlspecialchars($user_data['date']) ?>" required><br><br>
        E-mailadres: <input type="email" name="email_address" value="<?= htmlspecialchars($user_data['email_address']) ?>" required><br><br>
        Gebruikersnaam: <input type="text" name="username" value="<?= htmlspecialchars($user_data['username']) ?>" required><br><br>
        <button class="personal-data-btn" type="submit">Bijwerken</button>
        <button class="personal-data-btn"><a href="welcome.php">Terug naar Welkom</a></button>
    </form>
</div>
<?php require_once "views/footer.php"; ?>
</body>
</html>