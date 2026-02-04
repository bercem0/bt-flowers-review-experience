<?php

require_once 'user_database.php';

/**
 * Register a new user
 */
function registerUser ($firstname, $lastname, $date, $email_address, $username, $password, $password_confirm) {
    global $pdo; // Maak de PDO-verbinding globaal beschikbaar
    $errors = []; // Array voor foutmeldingen

    $firstname = trim($firstname); // Trim de voornaam
    // trim() is een functie die witruimtes (spaties, tabs, enz.) aan het begin en einde van een string verwijdert.
    // Dit zorgt ervoor dat er geen onbedoelde spaties zijn in de naam.
    if (empty($firstname)) {
        $errors[] = "Voornaam is verplicht."; // Voeg foutmelding toe als voornaam leeg is
    }

    $lastname = trim($lastname); // Trim de achternaam
    if (empty($lastname)) {
        $errors[] = "Achternaam is verplicht."; // Voeg foutmelding toe als achternaam leeg is
    }

    $date = trim($date); // Trim de geboortedatum
    if (empty($date)) {
        $errors[] = "Geboortedatum is verplicht."; // Voeg foutmelding toe als geboortedatum leeg is
    }

    $email_address = trim($email_address); // Trim het e-mailadres
    if (empty($email_address)) {
        $errors[] = "E-mailadres is verplicht.";
    } elseif (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ongeldig e-mailadres."; // Voeg foutmelding toe als e-mailadres ongeldig is
    }

    $username = trim($username); // Trim de gebruikersnaam
    if (empty($username)) {
        $errors[] = "Gebruikersnaam is verplicht."; // Voeg foutmelding toe als gebruikersnaam leeg is
    }

    if (strlen($password) < 6) {
        $errors[] = "Wachtwoord moet minimaal 6 tekens lang zijn."; // Voeg foutmelding toe als wachtwoord te kort is
    }

    if ($password !== $password_confirm) {
        $errors[] = "Wachtwoorden komen niet overeen."; // Voeg foutmelding toe als wachtwoorden niet overeenkomen
    }

    // Check if username exists
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        if ($stmt->fetch()) {
            $errors[] = "Deze gebruikersnaam is al in gebruik.";
        }
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors, 'message' => '']; // Retourneer foutmeldingen als er zijn
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash het wachtwoord
    // password_hash() is een functie die een veilig, gehashed wachtwoord genereert.
    // Het gebruikt een algoritme om het wachtwoord te versleutelen, zodat het veilig kan worden opgeslagen in de database.

    // Voeg de gebruiker toe aan de database
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, date, email_address, username, password, is_admin) VALUES (:firstname, :lastname, :date, :email_address, :username, :password, 0)");
    $stmt->execute([
        ':firstname' => $firstname,
        ':lastname' => $lastname,
        ':date' => $date,
        ':email_address' => $email_address,
        ':username' => $username,
        ':password' => $password_hash,
    ]);

    return ['success' => true, 'errors' => [], 'message' => 'Registratie succesvol! U kunt nu inloggen.']; // Retourneer succesbericht
}

/**
 * Register a new administrator
 */
function registerAdmin($firstname, $lastname, $date, $email_address, $username, $password, $password_confirm) {
    global $pdo; // Maak de PDO-verbinding globaal beschikbaar
    $errors = []; // Array voor foutmeldingen

    $firstname = trim($firstname); // Trim de voornaam
    if (empty($firstname)) {
        $errors[] = "Voornaam is verplicht."; // Voeg foutmelding toe als voornaam leeg is
    }

    $lastname = trim($lastname); // Trim de achternaam
    if (empty($lastname)) {
        $errors[] = "Achternaam is verplicht."; // Voeg foutmelding toe als achternaam leeg is
    }

    $date = trim($date); // Trim de geboortedatum
    if (empty($date)) {
        $errors[] = "Geboortedatum is verplicht."; // Voeg foutmelding toe als geboortedatum leeg is
    }

    $email_address = trim($email_address); // Trim het e-mailadres
    if (empty($email_address)) {
        $errors[] = "E-mailadres is verplicht."; // Voeg foutmelding toe als e-mailadres leeg is
    } elseif (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ongeldig e-mailadres."; // Voeg foutmelding toe als e-mailadres ongeldig is
    }

    $username = trim($username); // Trim de gebruikersnaam
    if (empty($username)) {
        $errors[] = "Gebruikersnaam is verplicht."; // Voeg foutmelding toe als gebruikersnaam leeg is
    }

    if (strlen($password) < 6) {
        $errors[] = "Wachtwoord moet minimaal 6 tekens lang zijn."; // Voeg foutmelding toe als wachtwoord te kort is
    }

    if ($password !== $password_confirm) {
        $errors[] = "Wachtwoorden komen niet overeen."; // Voeg foutmelding toe als wachtwoorden niet overeenkomen
    }

    // Check if username exists
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        if ($stmt->fetch()) {
            $errors[] = "Deze gebruikersnaam is al in gebruik."; // Voeg foutmelding toe als gebruikersnaam al bestaat
        }
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors, 'message' => '']; // Retourneer foutmeldingen als er zijn
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash het wachtwoord

    // Voeg de administrator toe aan de database
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, date, email_address, username, password, is_admin) VALUES (:firstname, :lastname, :date, :email_address, :username, :password, 1)");
    $stmt->execute([
        ':firstname' => $firstname,
        ':lastname' => $lastname,
        ':date' => $date,
        ':email_address' => $email_address,
        ':username' => $username,
        ':password' => $password_hash,
    ]);

    return ['success' => true, 'errors' => [], 'message' => 'Registratie succesvol! U kunt nu inloggen als administrator.']; // Retourneer succesbericht
}

/**
 * Login user (admin or regular)
 */
function loginUser($username, $password) {

    global $pdo; // Maak de PDO-verbinding globaal beschikbaar
    $errors = []; // Array voor foutmeldingen
    $username = trim($username); // Trim de gebruikersnaam

    if (empty($username)) {
        $errors[] = "Gebruikersnaam is verplicht."; // Voeg foutmelding toe als gebruikersnaam leeg is
    }
    if (empty($password)) {
        $errors[] = "Wachtwoord is verplicht."; // Voeg foutmelding toe als wachtwoord leeg is
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors, 'message' => '']; // Retourneer foutmeldingen als er zijn
    }

    $stmt = $pdo->prepare("SELECT id, username, password, is_admin FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Verkrijg de gebruiker

    if (!$user || !password_verify($password, $user['password'])) {
        $errors[] = "Ongeldige gebruikersnaam of wachtwoord."; // Voeg foutmelding toe als gebruikersnaam of wachtwoord ongeldig is
        return ['success' => false, 'errors' => $errors, 'message' => '']; // Retourneer foutmeldingen
    }

    // Session start moet buiten deze functie gebeuren!

    $_SESSION['user_id'] = $user['id']; // Sla de gebruikers-ID op in de sessie
    $_SESSION['username'] = $user['username']; // Sla de gebruikersnaam op in de sessie

    $_SESSION['is_admin'] = (bool)$user['is_admin']; // Sla de admin-status op in de sessie
        // (bool) is een typecast die een waarde converteert naar een boolean (waar of niet waar).
        // In dit geval wordt de admin-status van de gebruiker omgezet naar een boolean waarde.

    return ['success' => true, 'errors' => [], 'message' => 'Succesvol ingelogd! Welkom, ' . htmlspecialchars($user['username'])]; // Retourneer succesbericht
}

//Check if user is logged in
function isUserLoggedIn() {
    return isset($_SESSION['user_id']); // Controleer of de gebruikers-ID in de sessie staat
}

//Check if user is admin
function isUserAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true; // Controleer of de gebruiker admin is
}

//Logout user
function logoutUser() {
    $_SESSION = []; // Maak de sessie leeg
    session_destroy(); // Vernietig de sessie
}

//Product functies
function addProduct($name, $price, $description, $image) {
    global $pdo; // Maak de PDO-verbinding globaal beschikbaar

    // Voeg een nieuw product toe aan de database
    $sql = "INSERT INTO products (name, price, description, image) VALUES (:name, :price, :description, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':description' => $description,
        ':image' => $image,
    ]);

    return [
        'success' => true,
        'message' => 'Product succesvol toegevoegd!' // Retourneer succesbericht
    ];
}


function editProduct($id, $name, $price, $description) {
    global $pdo; // Maak de PDO-verbinding globaal beschikbaar

    // Werk een bestaand product bij in de database
    $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price, description = :description WHERE id = :id");
    $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':description' => $description,
        ':id' => $id,
    ]);
    return ['success' => true, 'message' => 'Product succesvol bijgewerkt!']; // Retourneer succesbericht
}

function deleteProduct($id) {
    global $pdo; // Maak de PDO-verbinding globaal beschikbaar

    // Verwijder een product uit de database
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return ['success' => true, 'message' => 'Product succesvol verwijderd!']; // Retourneer succesbericht
}

function getProducts() {
    global $pdo; // Maak de PDO-verbinding globaal beschikbaar

    // Verkrijg alle producten uit de database
    $stmt = $pdo->query("SELECT * FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourneer de producten als een associatieve array
}

function getProductById($id) {
    global $pdo; // Maak de PDO-verbinding globaal beschikbaar

    // Verkrijg een product op basis van de ID
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retourneer het product als een associatieve array
}
?>