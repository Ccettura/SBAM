<?php
include 'connessione.php';
$conn = OpenCon();
// $query = "select * from libro where codice=".$_GET['cod'];
$query = "select * from libro where codice=00001";
$result = mysqli_query($conn,$query);
if (!$result) {
    echo 'Impossibile eseguire la query: '.mysqli_error();
    exit;
}
$row=mysqli_fetch_assoc($result);

include 'header.php';
?>


<body>

<!------------BARRA SUPERIORE------------>
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
                <a href="<?php echo $row['doveAcquistare']; ?>">ACQUISTA</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>