<?php
    include 'header.php';
    include 'connessione.php';
?>

    <div class="background"></div>
    <div class="logoSfondo"></div>

    <div class="cerca">

        <h1 class="sottotitoli giallo">CERCA UN LIBRO O UN FUMETTO</h1>

        <p class="paragrafi">Inserisci il titolo o l'isbn di un libro o fumetto per effettuare la ricerca.</p>

        <form action="lista.php" method="POST">
            <div class="barra_ricerca">
                <div><input class="input_codice" atype="text" name="search"></div>
                <div class="mt"></div>
                <div><button class="button" type="submit" name="submit">Cerca</button></div>
            </div>
        </form>

    </div>


    <div class="linea_orizzontale"></div>


    <!-- BACHECA -->

    <div class="bacheca">

        <div class="instazione_bacheca">
            <h1 class="sottotitoli giallo">ULTIME USCITE</h1>
            <p class="paragrafi">Dai un'occhiata alle ultime uscite.</p>
        </div>

        <div class="small-container">
            <div class="row">
                <?php
                $conn=OpenCon();
                $sql = "SELECT codice,titolo,copertina FROM (SELECT * FROM libro ORDER BY codice DESC LIMIT 5) sub ORDER BY codice ASC";
                $result = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_assoc($result)){
                    echo "
                    <div class='col-5'>
                        <a href='libro.php?cod=".$row['codice']."'> <p class='sottotitoli'>".$row['titolo']."</p></a>
                        <a href='libro.php?cod=".$row['codice']."'> <img src='copertine/".$row['copertina']."'/> </a>
                    </div>";
                }
                ?>
            </div>
        </div>

    </div>


<!-- SCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js" integrity="sha512-cA8gcgtYJ+JYqUe+j2JXl6J3jbamcMQfPe0JOmQGDescd+zqXwwgneDzniOd3k8PcO7EtTW6jA7L4Bhx03SXoA==" crossorigin="anonymous"></script>

</body>
</html>