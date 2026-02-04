<!-- 'require_once' zorgt ervoor dat het bestand maar één keer wordt ingeladen en voegt het bovenste gedeelte van de pagina (header) toe. -->
<?php require_once "views/header.php"; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About-Us</title>
</head>
<body>
<div class="about-us-wrapper"> <!-- Container voor de 'Over Ons' sectie -->
    <div class="about-us-text"> <!-- Tekstsectie -->
        <h1>Over Ons</h1> <!-- Titel van de sectie -->
    </div>
        <div class="about-us-img"> <!-- Afbeeldingssectie -->
            <img src="img/logo.png" width="600px" height="600px" >
        </div>

        <div class="about-us-paragraaf">
            <h3>Hallo! Wij zijn Bercem en Tugche.</h3 <!-- Introductie -->
            <br>
        <p> Onze liefde voor bloemen heeft ons ertoe gebracht deze pagina te starten. Ons doel is om de unieke schoonheid van bloemen met iedereen te delen en jouw speciale momenten nog mooier te maken met de meest verse en prachtige bloemen.
            <br> Bloemen zijn niet zomaar een cadeau, ze zijn de mooiste manier om gevoelens uit te drukken. Of je nu iemand wilt verrassen, je liefde wilt tonen of gewoon wat extra kleur aan je dag wilt toevoegen, wij zijn er voor jou.</p>
            <br><h3>We kiezen onze bloemen zorgvuldig uit, schikken ze met liefde en bezorgen ze vers bij jou thuis.</h3>
        </div>


    <div class="about-us">
        <hr> <!-- Scheidingslijn -->
        <h2 class="bt-title">Bercem & Tugche </h2>
        <h4>Wij zijn twee bloemenliefhebbers die dit niet alleen als een webshop zien, maar als een manier om mensen blij te maken.</h4> <!-- Beschrijving van de missie -->
        <div class="main-about-us"> <!-- Hoofdsectie over het team -->
        <img class="about-us-bercem" src="img/2.photo-about-us-bercem.jpg" width="200px">
            <h5 class="bercem-title">Bercem: </h5>
        <p class="bercem-paragraaf">Bloemen voelen voor mij als kleine wonderen van de natuur. Met hun kleuren, geuren en betekenissen brengen ze geluk in het leven van mensen. Voor mij is het heel speciaal om deze wereld te delen. Elk boeket zie ik als een kunstwerk dat een glimlach op iemands gezicht tovert.</p>
<!--            <img class="about-us-tugche" src="img/1.photo-about-us-Tugche.jpeg" width="200px">-->
            <img class="about-us-tugche" src="img/2.photo-about-us-Tugche.jpeg" width="200px">
            <h5 class="tugche-title">Tugche: </h5>
            <br>
        <p class="tugche-paragraaf">Ik geloof dat bloemen gevoelens kunnen overbrengen waar woorden soms tekortschieten. Met hun kleuren, geuren en betekenissen zijn ze als kleine kunstwerken. Het mooiste vind ik om de juiste bloem bij de juiste persoon te brengen.</p>
        </div>
    </div>
</div>
<!-- 'require_once' zorgt ervoor dat het bestand maar één keer wordt ingeladen en voegt het onderste gedeelte van de pagina (footer) toe. -->
<?php require_once "views/footer.php"; ?>
</body>
</html>