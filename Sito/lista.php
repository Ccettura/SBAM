<?php
   include 'connessione.php';
   include 'paginazione.php';
   include 'header.php';
?>

<script src="autocompilazione.js" type="text/javascript"></script>

<div class="sezioneRicerca headline">

    <div class="instazione_bacheca">
        <h1 class="sottotitoli giallo">CERCA UN LIBRO O UN FUMETTO</h1>
        <p class="paragrafi">Inserisci il titolo o l'isbn di un libro o fumetto per effettuare la ricerca.</p>
    </div>

    <form autocomplete="off" action="lista.php" method="GET">
            <div class="autocomplete">
                <input id="myInput" class="input_codice" atype="text" name="search">
                <button class="button" type="submit">Cerca</button>
            </div>
    </form>
</div>

<div class="categorie mt2 headline">

    <form action="lista.php" method="POST">
        <div>
            <div class="ricerca_2">
                <select class="bianco" name="categorie">
                    <?php
                    $conn=OpenCon();
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    $sql = "SELECT nomeCategoria from Categorie";
                    $result = mysqli_query($conn,$sql);
                    echo "<option value='all'>Tutte le categorie</option>";
                    while ($row = mysqli_fetch_assoc($result)){
                        $categorie = $row['nomeCategoria'];
                        echo "<option value='$categorie'>$categorie</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="bottone_centrato">
                <input class="button" type="submit" name="filter" value="Cerca">
        </div>
    </form>

</div>

<h1 class="sottotitoli giallo centroTesto mt2 headline">LISTA DI LIBRI</h1>

<div class="small-container headline">
    <?php
    if(isset($_GET['sez'])){
        $sezione=$_GET['sez'];
    }
    else{
        $sezione=0;
    }

    $conn=OpenCon();
    $limite=15;
    $libri = mysqli_query($conn,"SELECT titolo FROM Libri");
    $libri = mysqli_fetch_all($libri);
    for($i=0;$i<count($libri);$i++){
        $libro[$i]=$libri[$i][0];
    }

    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $sql = "SELECT distinct Libri.codiceLibro, titolo, copertina FROM Libri JOIN scrive on Libri.codiceLibro=scrive.codiceLibro JOIN Autori ON Autori.codiceAutore=scrive.codiceAutore WHERE titolo LIKE '%$search%' OR nomecognome LIKE '%$search%'";
        $result = mysqli_query($conn,$sql);
        $numrighe = mysqli_num_rows($result);
        if($numrighe > 0){
            echo "<a class='sottotitoli'>Ci sono ".$numrighe." risultati</a>";
            $currentPage=creaLista($result,$numrighe,$limite,$sezione);
        }
        else{
            echo "Non ci sono risultati per la ricerca!";
        }
    }

    else{
        $sql = "SELECT * FROM Libri";
        $result = mysqli_query($conn,$sql);
        $numrighe=mysqli_num_rows($result);
        $currentPage=creaLista($result,$numrighe,$limite,$sezione);
    }
    ?>

    <div class="pagination">
        <?php
        if (isset($_GET['search'])){
            $search="&search=".$_GET['search'];
        }
        else{
            $search="";
        }
        if($sezione!=0){
            $sez=$sezione-1;
            $page=$currentPage-1;
            echo "<a href='lista.php?page=1&sez=0$search'>&laquo;</a>";
            echo "<a href='lista.php?page=$page&sez=$sez$search'>&lsaquo;</a>";
            $currentPage=$currentPage+2;
        }
        else{
            $currentPage=$currentPage-1;
        }
        $pagine=ceil($numrighe/$limite);
        $sezioni=ceil($pagine/10)-1;
        $pagine=$pagine-1;
        for($i=$sezione*10; $i<=10*$sezione+10 and $i<=$pagine; $i++){
            if($i==0){
                $i=1;
            }
            $sez=floor($i/10);
            echo "<a href='lista.php?page=$i&sez=$sez$search'>$i</a>";
        }
        if($sezione!=$sezioni){
            echo "<a href='lista.php?page=$pagine&sez=$sezioni$search'>&raquo;</a>";
        }

        //TODO fixare ricerca

        ?>
    </div>
</div>


<script>
    var div = document.getElementsByClassName("pagination")[0];
    div.children[<?php echo ($currentPage-10*($sezione)) ?>].classList.add("active");
</script>


<?php
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
