<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg data</title>
</head>
<body>
    <form method="post">
        <input type="submit" name="voeg" value="Voeg data">
    </form>
    <?php
        if (isset($_POST["voeg"])) {
            // Get database file
            include_once "../config/database.php";
            
            // Get database connection
            $database = new Database();
            $conn = $database->getConnection();

            // Base link of API
            $base = "https://pokeapi.co/api/v2/pokemon/";
            // Base link of images
            $baseimg = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/";

            // Loop 807 times (Amount of pokemons in API)
            for ($id = 1; $id <= 807; $id++) {
                // Get content of the base link with current id
                @$data = file_get_contents($base.$id.'/');
                // Create full url of image
                $dataImg = $baseimg.$id.'.png';

                // Create an object of the json
                $pokemon = json_decode($data);

                // Get all data from API and store it in variables
                $pokemonNaam = $pokemon->name;
                $pokemonId = $pokemon->id;
                $pokemonHeight = $pokemon->height;
                $pokemonWeight = $pokemon->weight;
                $pokemonType1 = $pokemon->types[0]->type->name;
                @$pokemonType2 = $pokemon->types[1]->type->name;

                // Query to insert all variables into database
                $query = "INSERT INTO pokemon(id, naam, lengte, gewicht, type1, type2, fotoUrl)
                VALUES
                ('$pokemonId', '$pokemonNaam', '$pokemonHeight', '$pokemonWeight', '$pokemonType1', '$pokemonType2', '$dataImg')";

                // Prepare the query
                $stmt = $conn->prepare($query);
                
                // Check if statement is executed
                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Succesvol toegevoegd!</p>";
                } else {
                    echo "Iets is fout gegaan";
                }
            }
        }
    ?>
</body>
</html>