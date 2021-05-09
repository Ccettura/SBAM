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
        <h1 class="titoli">CERCA UN LIBRO O UN FUMETTO</h1>
        <form action="search.php" method="POST">
            <input type="text" name="ricerca" placeholder="Cerca un libro o un fumetto">
            <button type="submit" name="submit-search">Cerca</button>
        </form>
    </div>

</body>
</html>