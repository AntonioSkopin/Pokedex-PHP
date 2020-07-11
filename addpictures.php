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
            include_once "config/database.php";
            
            $database = new Database();
            $conn = $database->getConnection();

            $base = "https://pokeapi.co/api/v2/pokemon/";
            $baseimg = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/";

            for ($id = 1; $id <= 807; $id++) {
                @$data = file_get_contents($base.$id.'/');
                $dataImg = $baseimg.$id.'.png';

                $pokemon = json_decode($data);

                $pokemonNaam = $pokemon->name;
                $pokemonId = $pokemon->id;
                $pokemonHeight = $pokemon->height;
                $pokemonWeight = $pokemon->weight;
                $pokemonType1 = $pokemon->types[0]->type->name;
                @$pokemonType2 = $pokemon->types[1]->type->name;

                $query = "INSERT INTO pokemon(id, naam, lengte, gewicht, type1, type2, fotoUrl)
                VALUES
                ('$pokemonId', '$pokemonNaam', '$pokemonHeight', '$pokemonWeight', '$pokemonType1', '$pokemonType2', '$dataImg')";

                $stmt = $conn->prepare($query);
                
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