<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="icon" 
      type="image/png" 
      href="Images/pokeball.png">
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
                xmlhttp.open("GET", "gethint.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>
    
    <header>
        <div class="img-container">
            <img class="bg-image" src="Images/pokemon-bg.jpg" alt="Pokemon background image">
        </div>
        <h1>Pokédex</h1>
        <form autocomplete="off" action="pokemon.php" method="post">
            <input type="text" name="pokemon" placeholder="Voer een pokémon naam of id in" onkeyup="showHint(this.value)">
            <input type="submit" name="zoekPokemon" value="Zoek">
        </form>    
    </header>
    <!-- Suggestions will be displayed in below div. -->
    <div id="display"></div>
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
                <button type="submit">Bekijk alle Pokemons</button>
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