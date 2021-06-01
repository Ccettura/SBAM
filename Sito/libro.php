<?php
// ESTRAZIONE LIBRO DAL DATABASE
include 'connessione.php';
$conn = OpenCon();
$query = "select * from Libri JOIN scrive ON Libri.codiceLibro=scrive.codiceLibro JOIN Autori ON scrive.codiceAutore=Autori.codiceAutore JOIN Editori ON Libri.codiceEditore=Editori.codiceEditore where Libri.codiceLibro=".$_GET['cod'];
$result = mysqli_query($conn,$query);
if (!$result) {
    echo 'Impossibile eseguire la query: '.mysqli_error();
    exit;
}
$row=mysqli_fetch_assoc($result);
$query = "select nomecognome from Autori JOIN scrive ON Autori.codiceAutore=scrive.codiceAutore WHERE scrive.codiceLibro=".$_GET['cod'];
$autori = mysqli_query($conn,$query);

include 'header.php';
?>


<!------------DETTAGLI LIBRO------------>

<div class="container singolo-libro">
    <div class="row">
        <div class="col">
            <img src="copertine/<?php echo $row['copertina']; ?>" />
        </div>
        <div class="col">
            <h1 class="titoli"><?php echo $row['titolo']; ?></h1>
            <p class="sottotitoli">Editore: <?php echo $row['nomeEditore']; ?></p>
            <p class="sottotitoli">Autori:
                <?php
                $stringa="";
                while ($nomecognome = mysqli_fetch_assoc($autori)){
                    $stringa.=$nomecognome['nomecognome'].", ";
                }
                echo rtrim($stringa,", ");
                ?>
            </p>
            <p class="paragrafi">Categoria: <?php echo $row['categoria']; ?></p>
            <p class="paragrafi">Data di pubblicazione: <?php echo $row['dataPubblicazione']; ?></p>
            <p class="paragrafi">Pagine: <?php echo $row['numeroPagine']; ?></p>
            <p class="paragrafi"><?php echo $row['descrizione']; ?></p>
            <p class="paragrafi">
                <a href="<?php echo $row['doveAcquistare']; ?>" class="button">ACQUISTA</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>