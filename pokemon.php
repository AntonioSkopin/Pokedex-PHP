<?php

// Checkt of zoek knop is geklikt
if (@isset($_POST["zoekPokemon"])) {
    // lowercase inputted text (All pokemon names are lowercased in API)
    $pokemonNaam = strtolower($_POST["pokemon"]);

    // Get pokemon type
    $pokemonType = null;

    include_once "config/database.php";
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
    
    function setPokemonTypeText($pokemonType) {
        // Base style
        $typeStyle = 'color: #fff; border-radius: 5rem; text-align: center; padding: 0.3rem 1.5rem; margin-top: 1rem;';
        // All styles per pokemon type
        $normalTypeStyle = 'background-color: rgb(168,168,120); ' . $typeStyle;
        $fireTypeStyle = 'background-color: rgb(240,128,48); ' . $typeStyle;
        $waterTypeStyle = 'background-color: rgb(104,144,240); ' . $typeStyle;
        $grassTypeStyle = 'background-color: rgb(120,200,80); ' . $typeStyle;
        $electricTypeStyle = 'background-color: rgb(248,208,48); ' . $typeStyle;
        $fightingTypeStyle = 'background-color: rgb(192,48,40); ' . $typeStyle;
        $flyingTypeStyle = 'background-color: rgb(168,144,240); ' . $typeStyle;
        $poisonTypeStyle = 'background-color: rgb(160,64,160); ' . $typeStyle;
        $physicTypeStyle = 'background-color: rgb(248,88,136); ' . $typeStyle;
        $iceTypeStyle = 'background-color: rgb(152,216,216); ' . $typeStyle;
        $dragonTypeStyle = 'background-color: rgb(112,56,248); ' . $typeStyle;
        $darkTypeStyle = 'background-color: rgb(112,88,72); ' . $typeStyle;
        $groundTypeStyle = 'background-color: rgb(224,192,104); ' . $typeStyle;
        $rockTypeStyle = 'background-color: rgb(184,160,56); ' . $typeStyle;
        $bugTypeStyle = 'background-color: rgb(168,184,32); ' . $typeStyle;
        $ghostTypeStyle = 'background-color: rgb(112,88,152); ' . $typeStyle;
        $fairyTypeStyle = 'background-color: rgb(238,153,172); ' . $typeStyle;
        $steelTypeStyle = 'background-color: rgb(184,184,208); ' . $typeStyle;

        // Check what type the pokemon is and output different style for different type
        switch ($pokemonType) {
            case "normal":
                echo "<p style='$normalTypeStyle'>Normal</p>";
                break;
            case "fire":
                echo "<p style='$fireTypeStyle'>Fire</p>";
                break;
            case "water":
                echo "<p style='$waterTypeStyle'>Water</p>";
                break;
            case "grass":
                echo "<p style='$grassTypeStyle'>Grass</p>";
                break;
            case "electric":
                echo "<p style='$electricTypeStyle'>Electric</p>";
                break;
            case "fighting":
                echo "<p style='$fightingTypeStyle'>Fighting</p>";
                break;
            case "flying":
                echo "<p style='$flyingTypeStyle'>Flying</p>";
                break;
            case "poison":
                echo "<p style='$poisonTypeStyle'>Poison</p>";
                break;
            case "physic":
                echo "<p style='$physicTypeStyle'>Physic</p>";
                break;
            case "ice":
                echo "<p style='$iceTypeStyle'>Ice</p>";
                break;
            case "dragon":
                echo "<p style='$dragonTypeStyle'>Dragon</p>";
                break;
            case "dark":
                echo "<p style='$darkTypeStyle'>Dark</p>";
                break;
            case "ground":
                echo "<p style='$groundTypeStyle'>Ground</p>";
                break;
            case "rock":
                echo "<p style='$rockTypeStyle'>Rock</p>";
                break;
            case "bug":
                echo "<p style='$bugTypeStyle'>Bug</p>";
                break;
            case "ghost":
                echo "<p style='$ghostTypeStyle'>Ghost</p>";
                break;
            case "fairy":
                echo "<p style='$fairyTypeStyle'>Fairy</p>";
                break;
            case "steel":
                echo "<p style='$steelTypeStyle'>Steel</p>";
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Info</title>
    <link rel="stylesheet" href="Styles/pokemon_info.css">
    <link rel="icon" 
      type="image/png" 
      href="../Images/pokeball.png">
      <script>
        const showHint = str => {
            if (str.length == 0) { // Check if input string is empty
                document.getElementById("display").innerHTML = "";
                return;
            } else {
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // Checks if request is finished and response is ready
                        // Checks if status is OK
                        // Sets suggestions to response data
                        document.getElementById("display").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "gethint2.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>
    <div class="search-container">
        <form autocomplete="off" action="pokemon.php" method="post">
            <input type="text" name="pokemon" placeholder="Voer een pokémon naam of id in" onkeyup="showHint(this.value)">
            <input type="submit" name="zoekPokemon" value="Zoek">
        </form>
        <div style="margin-top: 1rem;" id="display"></div>
    </div>
    <a class="back-bttn" href="index.php">X</a>
    <div class="pokemonsContainer">
        <?php
            // Output all data
            foreach ($result as &$data) {
                // Set pokemon type to global variable
                $pokemonType = $data["type1"];
                echo "<div class='pokemon-img'>";
                    $image = $data["fotoUrl"];
                    $imageData = base64_encode(file_get_contents($image));
                    echo '<img src="data:image/png;base64,'.$imageData.'"><br>';
                echo "</div>";
                echo "<div class='pokemon-info'>";
                    // Uppercase first letter of pokemon name
                    echo "Naam: <b>" . ucfirst($data["naam"]) . "</b><br>";
                    echo "Pokemon ID: <b>" . $data["id"] . "</b><br>";
                    echo "Lengte: <b>" . $data["lengte"] . "dm</b><br>";
                    echo "Gewicht: <b>" . $data["gewicht"] . "hg</b><br>";
                    echo "<div class='type-container'>";
                        setPokemonTypeText($data["type1"]);
                        echo " ";
                        setPokemonTypeText($data["type2"]);
                    echo "</div>";
                echo "</div>";
            }
        ?>
    </div>
    <div class="related-pokemons">
        <?php
            // Query to show related pokemons
            $queryRelated = "SELECT fotoUrl FROM pokemon WHERE type1 = '$pokemonType' ORDER BY RAND()
            LIMIT 5";

            // Prepare the query
            $stmtRelated = $conn->prepare($queryRelated);

            // Execute the query
            $stmtRelated->execute();

            // Get all data and store it as an array
            $resultRelated = $stmtRelated->fetchAll(PDO::FETCH_ASSOC);

            // Output data
            foreach ($resultRelated as &$dataRelated) {
                $image = $dataRelated["fotoUrl"];
                $imageData = base64_encode(file_get_contents($image));
                echo '<img src="data:image/png;base64,'.$imageData.'"><br>';
            }
        ?>
    </div>
</body>
</html>