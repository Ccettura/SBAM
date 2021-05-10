<?php
include 'connessione.php';
$conn = OpenCon();
$query = "select * from libro where codice=".$_GET['cod'];
$result = mysqli_query($conn,$query);
if (!$result) {
    echo 'Impossibile eseguire la query: '.mysqli_error();
    exit;
}
$row=mysqli_fetch_assoc($result);

include 'header.php';
?>


<!------------DETTAGLI PRODOTTO------------>
<div class="container singolo-libro">
    <div class="row">
        <div class="col">
            <img src="copertine/<?php echo $row['copertina']; ?>" />
        </div>
        <div class="col">
            <h1 class="titoli"><?php echo $row['titolo']; ?></h1>
            <p class="sottotitoli">Editore: <?php echo $row['editore']; ?></p>
            <p class="sottotitoli">Autori: <?php echo $row['autori']; ?></p>
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