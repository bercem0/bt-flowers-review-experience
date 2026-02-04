<?php require_once "views/header.php"; ?> <!-- Importeer het headerbestand van de pagina. -->
<!doctype html>
<html lang="en"> <!-- Begin van de HTML-pagina -->
<head>
    <meta charset="UTF-8"> <!-- Stel de karaktercodering in op UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Zorg voor responsief ontwerp -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Compatibiliteit met Internet Explorer -->
    <title>B & T Flowers</title> <!-- Titel van de pagina -->
    <link rel="stylesheet" href="css/style.css"> <!-- Koppel de CSS-stylesheet -->
</head>
<body>
<div class="wrapper"> <!-- Container voor de inhoud van de pagina -->
    <div class="home-text"> <!-- Sectie voor de tekst op de homepage -->
        <h1>B & T FLOWERS</h1> <!-- Hoofdtitel -->
        <br>
        <h3>Welkom!</h3> <!-- Welkomstbericht -->
        <br>
        <p>Verras je dierbaren met de mooiste cadeaus van de natuur! Onze verse en zorgvuldig samengestelde bloemstukken brengen kleur in elke speciale gelegenheid. Of het nu gaat om een verjaardag, een jubileum of gewoon om iemand blij te maken, wij zorgen voor de perfecte bloemen voor elk moment.</p> <!-- Beschrijving van de diensten -->
        <br>
        <h4>Bestel nu en laat bloemen spreken voor je liefde!</h4> <!-- Aanmoediging om te bestellen -->
        <a href="about-us.php"><button class="about-us-btn">About Us</button></a> <!-- Knop om naar de 'Over ons'-pagina te gaan -->
    </div>
    <div class="home-img"> <!-- Sectie voor de afbeelding op de homepage -->
        <img src="img/logo.png" width="600px" height="600px"> <!-- Logo afbeelding -->
    </div>
</div>
<?php require_once "views/footer.php"; ?> <!-- Importeer het footerbestand van de pagina. -->
</body>
</html>
