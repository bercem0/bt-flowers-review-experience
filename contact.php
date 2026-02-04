<?php
require_once "config-2.php"; //Importeer de configuratiebestand voor de databaseverbinding.
require_once "views/header.php"; //Importeer het headerbestand van de pagina.

$success_message = ""; //Definieer een variabele voor succesberichten.
$error_message = ""; //Definieer een variabele voor foutberichten.

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Controleer of het formulier met de POST-methode is verzonden.

    try {
        $name = htmlspecialchars(trim($_POST["name"])); //Verkrijg de naam en verwijder speciale tekens.
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); //Verkrijg het e-mailadres en zorg ervoor dat het in een geldig formaat is.
        $message = htmlspecialchars(trim($_POST["message"])); //Verkrijg het bericht en verwijder speciale tekens.

        if (!empty($name) && !empty($email) && !empty($message)) { //Als naam, e-mail en bericht niet leeg zijn, gaan we verder.
            // SQL-query voorbereiden
            $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)"); //Voeg het bericht toe aan de database.
            if ($stmt) {
                $stmt->bind_param("sss", $name, $email, $message); //Bind de parameters.
                $stmt->execute(); //Voer de SQL-query uit.

                if ($stmt->affected_rows > 0) { //Als er een rij is beïnvloed, geven we aan dat de bewerking succesvol was.
                    $success_message = "Bedankt! Uw bericht is succesvol verzonden."; //We stellen het succesbericht in.

                    // E-mail verzenden proces
                    $to = ""; // Vul hier uw eigen e-mailadres in
                    $subject = "Nieuw contactformulierbericht"; //Onderwerp van de e-mail.
                    $headers = "From: $email\r\n"; //Stel de e-mailkop in.
                    $headers .= "Reply-To: $email\r\n"; //Stel het antwoordadres in.
                    $headers .= "X-Mailer: PHP/" . phpversion(); //Voeg de PHP-versie toe.
                    $body = "Name: $name\nEmail: $email\nMessage:\n$message"; //Maak de inhoud van de e-mail aan.

                    mail($to, $subject, $body, $headers); //Verstuur de e-mail.
                } else {
                    $error_message = "Er is een fout opgetreden bij het opslaan van uw bericht."; //Als de bewerking mislukt, geven we een foutmelding.
                }

                $stmt->close(); //Sluit de SQL-query.
            } else {
                $error_message = "Databasefout: " . $conn->error; //Als er een databasefout is, geef dan de foutmelding.
            }
        } else {
            $error_message = "Vul alle velden in."; //Als er velden ontbreken, geef dan een foutmelding.
        }

    } catch (Exception $e) {
        $error_message = $e->getMessage(); //Als er een uitzondering optreedt, krijgen we de foutmelding.
    }

//    if ($error_message != "") {
//        echo "<p>" . $error_message . "</p>";
//    } else if ($success_message != "") {
//        echo "<p>" . $success_message . "</p>";
//    }
}

$conn->close(); // Close de database
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<main>
    <div class="contact-container"> <!-- Container voor het contactformulier -->
        <div class="contact-text">
            <h1>CONTACT</h1>
            <p>Wil je contact met mij opnemen? Je kunt me bereiken via onderstaande kanalen:</p>

            <!-- Succes- of foutmelding -->
            <?php if (!empty($success_message)) { echo "<p style='color: green;'>$success_message</p>"; } ?> <!-- Als er een succesbericht is, tonen we het succesbericht in groen. -->
            <?php if (!empty($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?> <!-- Als er een foutbericht is, tonen we het foutbericht in rood. -->

            <!-- Contactformulier -->
            <div class="contact-form">
                <form action="" method="POST"> <!-- Formulier voor contact -->

                    <div class="input-container"> <!-- Container voor naam -->
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required>
                    </div>

                    <div class="input-container"> <!-- Container voor e-mailadres -->
                        <label for="email">E-mail Address</label>
                        <input type="email" id="email" name="email" placeholder="Your Email" required>
                    </div>

                    <div class="input-container"> <!-- Container voor bericht -->
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                    </div>

                    <button type="submit">Sturen</button>
                </form>
                <div class="button-section"> <!-- Sectie voor extra contactknoppen -->
                    <a href="mailto:b&tFlowers@gmail.com" class="contact-btn email-btn"><img src="img/e-mail-icon.png" width="27px" height="27px">E-mail</a>
                    <a href="tel:+31 6 12345678" class="contact-btn belnu-btn"><img src="img/phone-icon.png" width="27px" height="27px">Bel Nu</a>
                    <a href="https://web.whatsapp.com/" class="contact-btn whatsapp-btn" target="_blank"><img src="img/img.png" width="27px" height="27px">WhatsApp Chat</a>
                    <a href="messages.php"><img src="img/img_1.png" width="27px" height="27px">De klanten reacties </a> <!-- Google Maps iframe -->
                </div>
            </div>

            <div class="kaart-container"> <!-- Container voor de kaart -->
                <h2>Routekaart</h2> <!-- Titel van de kaartsectie -->
                <div class="map-container">
                    <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509198!2d144.9537353153164!3d-37.81627997975157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11f1b3%3A0x5045675218ceed30!2sYour%20Company%20Name!5e0!3m2!1sen!2s!4v1616161616161!5m2!1sen!2s"
                            width="600"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                    </iframe>
                </div>
            </div>
            <div class="social-icons"> <!-- Sectie voor sociale media-iconen -->
                <a href="https://www.instagram.com/b.t_flowerss"><i class='bx bxl-instagram'></i></a>
                <a href="https://www.snapchat.com/b.t_flowerss"><i class='bx bxl-snapchat'></i></a>
                <a href="https://www.linkedin.com/in/b.t_flowerss-7767b0334/"><i class='bx bxl-linkedin'></i></a>
            </div>
        </div>
    </div>
</main>

<?php require_once "views/footer.php"; ?> <!-- Importeer het footerbestand van de pagina. -->
</body>
</html>