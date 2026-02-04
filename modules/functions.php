<?php
require_once "modules/database.php"; //Het bestand voor de databaseverbinding wordt ingeladen.

function getCategories() { // We beginnen een functie om de categorieën op te halen uit de database.
    global $pdo; //We zorgen voor toegang tot het PDO-object via global.
    $query = $pdo->prepare("SELECT * FROM categories"); //We bereiden een SQL-query voor om alle gegevens uit de 'categories' tabel op te halen.
    $query->execute(); //We voeren de query uit.
    return $query->fetchAll(PDO::FETCH_ASSOC); //We halen alle categorieën op uit de database als een array.
}

function getFlowersByCategory($categoryId) { //We beginnen een functie om bloemen op te halen op basis van een specifieke categorie.
    global $pdo; //We zorgen voor toegang tot het PDO-object via global.
    $query = $pdo->prepare("SELECT * FROM flowers WHERE category_id = ?"); //We bereiden een SQL-query voor om bloemen op te halen die behoren tot een specifieke categorie.
    $query->execute([$categoryId]); //We voeren de query uit en geven de categorie-ID als parameter mee.
    return $query->fetchAll(PDO::FETCH_ASSOC); //We halen de bloemen op uit de database als een array.
}
?>