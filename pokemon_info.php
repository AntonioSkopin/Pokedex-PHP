<?php

// Checkt of zoek knop is geklikt
if (@isset($_POST["zoekPokemon"])) {
    // Get base link of api
    $base = "https://pokeapi.co/api/v2/pokemon/";
    // lowercase inputted text (All pokemon names are lowercased in API)
    $pokemonName = strtolower($_POST["pokemon"]);

    // Get all the data of the pokemon inputted
    @$data = file_get_contents($base.$pokemonName.'/');

    // Check if data is not empty (Pokemon exists)
    if (!empty($data)){
        // Create std object of json
        $pokemon = json_decode($data);
        // Store the pokemon image in a variable
        $pokemonIMG = "<img src='".$pokemon->sprites->front_default."' /><br>";
        // Get the pokemon name & uppercase first letter
        $pokemonName = ucfirst($pokemon->name);
        // Get id of the pokemon
        $pokemonId = $pokemon->id;
        // Get height of pokemon in decimeters
        $pokemonHeight = $pokemon->height;
        // Get the weight of pokemon in hectograms
        $pokemonWeight = $pokemon->weight;
        // Get type of the pokemon & uppercase first letter
        $pokemonType1 = ucfirst($pokemon->types[0]->type->name);
        // Some pokemons have two types & uppercase first letter
        @$pokemonType2 = ucfirst($pokemon->types[1]->type->name);
    } else {
        // If searched pokemon doesn't exist output it to the user
        echo "Deze Pokemon bestaat niet!";
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon info</title>
    <link rel="stylesheet" href="Styles/pokemoninfo.css">
</head>
<body>
    <a class="back-bttn" href="index.php">X</a>
    <div class="pokemonsContainer">
        <div class="pokemon-img">
            <?php echo $pokemonIMG ?>
        </div>
        <div class="pokemon-info">
            <?php
                function setPokemonTypeText($pokemonType) {
                    $typeStyle = 'color: #fff; border-radius: 5rem; text-align: center;';
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

                    switch ($pokemonType) {
                        case "Normal":
                            echo "<p style='$normalTypeStyle'>Normal</p>";
                            break;
                        case "Fire":
                            echo "<p style='$fireTypeStyle'>Fire</p>";
                            break;
                        case "Water":
                            echo "<p style='$waterTypeStyle'>Water</p>";
                            break;
                        case "Grass":
                            echo "<p style='$grassTypeStyle'>Grass</p>";
                            break;
                        case "Electric":
                            echo "<p style='$electricTypeStyle'>Electric</p>";
                            break;
                        case "Fighting":
                            echo "<p style='$fightingTypeStyle'>Fighting</p>";
                            break;
                        case "Flying":
                            echo "<p style='$flyingTypeStyle'>Flying</p>";
                            break;
                        case "Poison":
                            echo "<p style='$poisonTypeStyle'>Poison</p>";
                            break;
                        case "Physic":
                            echo "<p style='$physicTypeStyle'>Physic</p>";
                            break;
                        case "Ice":
                            echo "<p style='$iceTypeStyle'>Ice</p>";
                            break;
                        case "Dragon":
                            echo "<p style='$dragonTypeStyle'>Dragon</p>";
                            break;
                        case "Dark":
                            echo "<p style='$darkTypeStyle'>Dark</p>";
                            break;
                        case "Ground":
                            echo "<p style='$groundTypeStyle'>Ground</p>";
                            break;
                        case "Rock":
                            echo "<p style='$rockTypeStyle'>Rock</p>";
                            break;
                        case "Bug":
                            echo "<p style='$bugTypeStyle'>Bug</p>";
                            break;
                        case "Ghost":
                            echo "<p style='$ghostTypeStyle'>Ghost</p>";
                            break;
                        case "Fairy":
                            echo "<p style='$fairyTypeStyle'>Fairy</p>";
                            break;
                        case "Steel":
                            echo "<p style='$steelTypeStyle'>Steel</p>";
                            break;
                    }
                }

                echo "Naam: <b>$pokemonName</b><br>";
                echo "ID: <b>$pokemonId</b><br>";
                echo "Lengte: <b>$pokemonHeight dm</b><br>";
                echo "Gewicht: <b>$pokemonWeight hg</b><br><br>";
                // Check if second type of pokemon is not empty

                if (!empty($pokemon->types[1])) {
                    setPokemonTypeText($pokemonType1);
                    setPokemonTypeText($pokemonType2);
                } else {
                    // Depend on the type switch the color
                    setPokemonTypeText($pokemonType1);
                }
            ?>
        </div>
    </div>
</body>
</html>