<?php

// Checkt of zoek knop is geklikt
if (@isset($_POST["zoekPokemon"])) {
    // lowercase inputted text (All pokemon names are lowercased in API)
    $pokemonNaam = strtolower($_POST["pokemon"]);

    include_once "../config/database.php";
    $database = new Database();
    $conn = $database->getConnection();

    // Query to select all data from inputted pokemon
    $query = "SELECT * FROM pokemon WHERE naam = :pokemonNaam OR id = :pokemonNaam";

    // Prepare query
    $stmt = $conn->prepare($query);

    // Bind values
    $stmt->bindParam(":pokemonNaam", $pokemonNaam);

    // Sanitize string
    $pokemonNaam = htmlspecialchars(strip_tags($pokemonNaam));

    // Execute query
    $stmt->execute();

    // Make array of data
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    // Loop trough array
    foreach ($result as &$data) {
        $image = $data["fotoUrl"];
        $imageData = base64_encode(file_get_contents($image));
        echo '<img src="data:image/png;base64,'.$imageData.'"><br>';
        echo "Naam: " . $data["naam"] . "<br>";
        echo "ID: " . $data["id"] . "<br>";
        echo "Lengte: " . $data["lengte"] . "<br>";
        echo "Gewicht: " . $data["gewicht"] . "<br>";
        echo "Type: " . $data["type1"] . $data["type2"];
        break;
    }
}