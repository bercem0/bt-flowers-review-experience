<?php
require_once 'views/header.php';
require_once 'user-functions.php';

$errors = []; // Array voor foutmeldingen
$success_message = ''; // Variabele voor succesbericht

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Controleer of het verzoek een POST-verzoek is

    $result = registerAdmin(
        $_POST['firstname'] ?? '',
        $_POST['lastname'] ?? '',
        $_POST['date'] ?? '',
        $_POST['email_address'] ?? '',
        $_POST['username'] ?? '',
        $_POST['password'] ?? '',
        $_POST['password_confirm'] ?? '' // Bevestiging van het wachtwoord
    );

    if ($result['success']) { // Controleer of de registratie succesvol was
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
    <title>Admin Registratie</title>
</head>
<body>
<div class="registration-container">

    <h2 class="registration-title">Admin Registratie</h2>
    <div class="messages-admin"> <!-- Container voor fout- en succesmeldingen -->

        <?php foreach ($errors as $error): ?> <!-- Toon foutmeldingen -->
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>
        <?php if ($success_message): ?> <!-- Toon succesbericht als aanwezig -->
            <div class="success"><?= htmlspecialchars($success_message) ?></div>
        <?php endif; ?>
    </div>
    <form class="registration-form" action="admin_sign-up.php" method="post"> <!-- Registratieformulier -->
        Voornaam: <input type="text" name="firstname" required><br><br>
        Achternaam: <input type="text" name="lastname" required><br><br>
        Geboortedatum: <input type="date" name="date"><br><br>
        E-mailadres: <input type="email" name="email_address" required><br><br>
        Gebruikersnaam: <input type="text" name="username" required><br><br>
        Wachtwoord: <input type="password" name="password" required><br><br>
        Wachtwoord (nog een keer): <input type="password" name="password_confirm" required><br><br>

        <button class="admin-button" type="submit">Registreer als Admin</button> <!-- Verzenden knop -->
        <button class="admin-sign-up-button"><a href="login.php">Bent u al lid? Inloggen</a></button> <!-- Knop om in te loggen -->
    </form>
</div>
<?php require_once "views/footer.php"; ?>
</body>
</html>
