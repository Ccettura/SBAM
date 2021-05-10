<?php
    include 'header.php';
?>

<body>

    <div class="header">
        <div class="contenuto_header">
            <div class="logo">
                <img src="logo.png" alt="200" height="44">
            </div>

            <div class="divisore"></div>

            <ul class="menu">
                <li><a href="">Home</a></li>
                <li><a href="">Lista</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Contatti</a></li>
            </ul>
        </div>
    </div>

    <div class="background"></div>
    <div class="logoSfondo"></div>

    <div class="cerca">

        <h1 class="sottotitoli giallo">CERCA UN LIBRO O UN FUMETTO</h1>

        <p class="paragrafi">Inserisci il titolo o l'isbn di un libro o fumetto per effettuare la ricerca.</p>

        <form action="lista.php" method="POST">
            <div class="barra_ricerca">
                <div><input class="input_codice" type="text" name="ricerca" placeholder=""></div>
                <div class="mt"></div>
                <div><button class="button" type="submit" name="submit-search">CERCA</button></div>
            </div>
        </form>

    </div>

    <div class="bacheca">

        <div class="instazione_bacheca">
            <h1 class="sottotitoli giallo">ULTIMI ARRIVI</h1>
            <p class="paragrafi">Dai un'occhiata agli utlimi arrivi.</p>
        </div>

        <div class=""

    </div>

</body>
</html>