<?php
require_once "views/header.php"; //Importeer het headerbestand

$host = "localhost";  // Database server
$user = "root";       // Database username
$password = "";       // Database password
$database = "contact_form_db"; // Database name

$conn = new mysqli($host, $user, $password, $database); //Verbind met de database

if ($conn->connect_error) {
    die("Verbindingsfout: " . $conn->connect_error); //Als er een verbindingsfout is, stop de uitvoering
}

$sql = "SELECT id, name, email, message, created_at FROM messages ORDER BY created_at DESC"; //Haalt berichten op uit de database
$result = mysqli_query($conn, $sql); //Voer de SQL-query uit
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inkomende Berichten</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <div class="messages-container">
        <div class="messages-title">
        <h1>Inkomende Berichten</h1>
        </div>
        <?php
        if (mysqli_num_rows($result) > 0) { //Als er berichten in de database zijn
            echo "<div class= 'messages-table'>";
            echo "<table border='1'>
<tr>
<th>ID</th>
<th>Naam</th>
<th>Email</th>
<th>Bericht</th> 
<th>Datum</th>
</tr>";
            while ($row = mysqli_fetch_assoc($result)) { //Haal elke bericht uit de database met een loop
                echo "<tr>
<td>".$row['id']."</td> <!--ID van het bericht-->
<td>".$row['name']."</td> <!--INaam van de afzender-->
<td>".$row['email']."</td> <!--E-mail van de afzender-->
<td>".$row['message']."</td> <!--Bericht inhoud-->
<td>".$row['created_at']."</td> <!--Datum van het bericht-->
</tr>";
            }
            echo "</table>";
            echo "</div>";
        } else { //Als er geen berichten zijn
            echo "<p>Er zijn nog geen berichten.</p>"; //Toon bericht
            }
        ?>
        <div class="messages-section-button">
            <a href="mailto:b&tFlowers@gmail.com" class="contact-btn email-btn"><img src="img/e-mail-icon.png" width="27px" height="27px">E-mail</a>
            <a href="tel:+31 6 12345678" class="contact-btn belnu-btn"><img src="img/phone-icon.png" width="27px" height="27px">Bel Nu</a>
            <a href="https://web.whatsapp.com/" class="contact-btn whatsapp-btn" target="_blank"><img src="img/img.png" width="27px" height="27px">WhatsApp Chat</a>
            <a href="contact.php"><img src="img/contact-page-icon.webp" width="29px" height="29px">Contact Pagina </a>
        </div>
    </div>
</main>
</body>
</html>

<?php require_once "views/footer.php"; ?> <!--Importeer het footerbestand-->
