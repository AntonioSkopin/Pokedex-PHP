<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="stylesheet" href="Styles/style.css">
</head>
<body>
    
    <header>
        <div class="img-container">
            <img class="bg-image" src="Images/pokemon-bg.jpg" alt="Pokemon background image">
        </div>
        <h1>Pokédex</h1>
        <form autocomplete="off" action="objects/pokemon.php" method="post">
            <input type="text" name="pokemon" placeholder="Voer een pokémon naam of id in">
            <input type="submit" name="zoekPokemon" value="Zoek">
        </form>
    </header>

    <main>
        <div class="container">
            <div class="exeg-img">
                <img class="exeggutor-img" src="Images/trainer.png"
                alt="Exeggutor image" />
            </div>
            <div class="text-container">
                <h1>Vind alle Pokémons</h1>
                <br>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,<br> 
                    sed diam nonumy eirmod tempor invidunt ut labore et dolore <br>
                    magna aliquyam erat, sed diam voluptua. At vero eos et <br>
                    accusam et justo duo dolores et ea rebum. Stet clita kasd <br>
                    gubergren, no sea takimata sanctus est Lorem ipsum dolor sit <br>
                    amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,,
                </p>
                <br><br><br>
                <button type="submit">Zoek een pokemon</button>
            </div>
        </div>
    </main>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

</body>
</html>