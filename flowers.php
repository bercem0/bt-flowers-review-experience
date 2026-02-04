<?php
require_once "modules/functions.php"; // Importeer de functiebestanden
require_once "modules/database.php"; // Importeer de databasebestanden
require_once "config.php"; // Importeer het configuratiebestand

$pageTitle = "Flowers"; // Stel de paginatitel in
$categories = getCategories(); // Verkrijg de categorieën

// Als een categorie is geselecteerd, haal de bloemen op
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null; // Controleer of er een geselecteerde categorie is
$flowers = $selectedCategory ? getFlowersByCategory($selectedCategory) : []; // Haal bloemen op op basis van de geselecteerde categorie

require_once "views/header.php"; // Importeer het headerbestand
?>

<div class="container"> <!-- Container voor de hoofdinformatie -->
    <div class="categories"> <!-- Sectie voor de categorieën -->
        <?php foreach ($categories as $category): ?> <!-- Loop door de categorieën -->
            <a href="flowers.php?category=<?php echo $category['id']; ?>"> <!-- Link naar de bloemenpagina met de geselecteerde categorie -->
                <button class="categorie-btn"><?php echo $category['name']; ?></button> <!-- Knop voor de categorie -->
            </a>
        <?php endforeach; ?>
    </div>

    <div class="fl-img"> <!-- Sectie voor de bloemenafbeelding -->
        <img src="img/flowers-page-icon.png" width="580px" height="580px"> <!-- Afbeelding voor de bloemenpagina -->
    </div>

    <div class="flower-info"> <!-- Sectie voor informatie over bloemen -->
        <h1>FLOWERS</h1> <!-- Hoofdtitel -->
        <h3>De Mooiste Touch van de Natuur: Bloemen</h3> <!-- Subtitel -->
        <p>🌸 Welkom! Ontdek hier de mooiste bloemen en vind de perfecte bloem voor speciale gelegenheden. Bloemen zijn de meest natuurlijke en elegante manier om je liefde te uiten! Van boeketten tot arrangementen en speciale ontwerpen – er is voor ieder wat wils.</p> <!-- Welkomstbericht -->
        <h3>🌿 Je bent op de juiste plek voor bloemen die geluk brengen!</h3> <!-- Aanmoediging -->
    </div>
</div>

<div class="flowers"> <!-- Container voor de bloemen -->
    <?php if ($selectedCategory && count($flowers) > 0): ?> <!-- Controleer of er een geselecteerde categorie is en of er bloemen zijn -->
        <div class="flower-grid"> <!-- Grid voor de bloemen -->
            <?php foreach ($flowers as $flower): ?> <!-- Loop door de bloemen -->
                <div class="flower-item"> <!-- Container voor een enkele bloem -->
                    <?php if (!empty($flower['image'])): ?> <!-- Controleer of er een afbeelding is -->
                        <img src="img/<?php echo htmlspecialchars($flower['image']); ?>" alt="<?php echo htmlspecialchars($flower['name']); ?>"> <!-- Toon de afbeelding van de bloem -->
                    <?php endif; ?>
                    <div class="details"> <!-- Sectie voor de details van de bloem -->
                        <h3 class="name"><?php echo htmlspecialchars($flower['name']); ?></h3> <!-- Toon de naam van de bloem -->
                        <p class="price">Prijs: <?php echo htmlspecialchars($flower['price']); ?>€</p> <!-- Toon de prijs van de bloem -->
                        <a href="flower-detail.php?id=<?php echo $flower['id']; ?>">Bekijk Details</a> <!-- Link naar de detailpagina van de bloem -->
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No flowers found in this category.</p> <!-- Bericht als er geen bloemen zijn gevonden in de geselecteerde categorie -->
    <?php endif; ?>
</div>
<?php require_once "views/footer.php"; // Importeer het footer-bestand ?>
