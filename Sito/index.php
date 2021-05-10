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
                <li><a href="index.php">Home</a></li>
                <li><a href="lista.php">Lista</a></li>
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
                <div><input class="input_codice" atype="text" name="search" placeholder="Cerca"></div>
                <div class="mt"></div>
                <div><button class="button" type="submit" name="submit">Cerca</button></div>
            </div>
        </form>

    </div>

    <div class="bacheca">

        <div class="instazione_bacheca">
            <h1 class="sottotitoli giallo">ULTIMI ARRIVI</h1>
            <p class="paragrafi">Dai un'occhiata agli ultimi arrivi:</p>
        </div>

        <div class="">
            
        </div>

    </div>

</body>
</html>