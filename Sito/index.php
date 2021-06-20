<?php
    include 'header.php';
    include 'connessione.php';
?>

    <script src="autocompilazione.js" type="text/javascript"></script>


    <!-- VIDEO E BACKGROUND -->

        <div id="hero">

            <div class="texture"></div>

            <video autoplay muted loop preload="auto">
                <source src="videoBackground.mp4" type="video/mp4">
            </video>

            <div class="caption">
                <div class="logoSfondo headline mt1"></div>

                <div class="cerca headline">
                    <h1 class="sottotitoli giallo">CERCA UN LIBRO O UN FUMETTO</h1>

                    <p class="paragrafi">Inserisci il titolo o l'autore di un libro o fumetto per effettuare la ricerca.</p>

                    <form autocomplete="off" action="lista.php" method="POST">
                        <div class="autocomplete">
                            <div>
                                <input id="myInput" class="input_codice" atype="text" name="search" alt="titolo o autore opera">
                                <button class="button" type="submit" name="submit">Cerca</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>


 <!-- BACHECA -->

    <div class="bacheca headline">

        <div class="instazione_bacheca">
            <h1 class="sottotitoli giallo">ULTIME USCITE</h1>
            <p class="paragrafi">Dai un'occhiata alle ultime uscite.</p>
        </div>

    </div>

    <div class="small-container mt1">
        <div class="row">
            <?php
            $conn=OpenCon();
            $sql = "SELECT codiceLibro,titolo,copertina,dataPubblicazione FROM Libri ORDER BY dataPubblicazione DESC LIMIT 5";
            $result = mysqli_query($conn,$sql);
            while ($row = mysqli_fetch_assoc($result)){
                echo "
                    <div class='col-5'>
                        <a href='libro.php?cod=".$row['codiceLibro']."'> <p class='bianco'>".$row['titolo']."</p></a>
                        <a href='libro.php?cod=".$row['codiceLibro']."'> <img src='copertine/".$row['copertina']."' /> </a>
                    </div>";
            }
            ?>
        </div>
    </div>


<!-- SCRIPT PER L'AUTOCOMPLETAMENTO -->

<?php

$libri = mysqli_query($conn,"SELECT titolo FROM Libri");
$libri = mysqli_fetch_all($libri); //array colonna
for($i=0;$i<count($libri);$i++){
    $libro[$i]=$libri[$i][0];
}
echo"
<script type='text/javascript'>
    var libro = ".json_encode($libro)."
    autocomplete(document.getElementById('myInput'), libro);
</script>
";

?>

<?php
include 'footer.php';
?>