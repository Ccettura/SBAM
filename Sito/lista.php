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
    <form action="lista.php" method="GET">
        <div>
            <div class="ricerca_2">
                <label class="bianco" for="cat">Seleziona una categoria:</label>
                <select class="bianco" name="cat">
                    <?php
                    $conn=OpenCon();
                    $search = mysqli_real_escape_string($conn, $_GET['search']);
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
                <input class="button" type="submit" value="Filtra">
            </div>
        </div>
    </form>
</div>

<h1 class="sottotitoli giallo centroTesto mt2 headline">LISTA DI LIBRI</h1>

<?php
if((isset($_GET['cat']) and $_GET['cat']!="all") or isset($_GET['search'])){
    echo "<div class='small-container paragrafi'>";
    echo "<a>FILTRA PER</a>";
    echo "<ul>";
        if(isset($_GET['cat'])){
            $categoria=$_GET['cat'];
            echo "
            <li>
            <a>Categoria:</a> ".$categoria."<a href='lista.php'> X</a>
            </li>
            ";
        }
        if (isset($_GET['search'])) {
            $ricerca=$_GET['search'];
            echo "
            <li>
            <a>Ricerca: </a>".$ricerca."<a href='lista.php'> X</a>
            </li>
            ";
        }
    echo "</ul>";
echo "</div>";
}
echo "<br>"
?>


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
        $libro[$i] = $libri[$i][0];
    }

    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        if(isset($_GET['cat'])){
            $categoria = $_GET['cat'];
            if($categoria=='all'){
                $sql = "SELECT distinct Libri.codiceLibro, titolo, copertina FROM Libri JOIN scrive on Libri.codiceLibro=scrive.codiceLibro JOIN Autori ON Autori.codiceAutore=scrive.codiceAutore WHERE titolo LIKE '%$search%' OR nomecognome LIKE '%$search%'";
            }
            else{
                $sql = "SELECT distinct Libri.codiceLibro, titolo, copertina FROM Libri JOIN scrive on Libri.codiceLibro=scrive.codiceLibro JOIN Autori ON Autori.codiceAutore=scrive.codiceAutore WHERE titolo LIKE '%$search%' OR nomecognome LIKE '%$search%' OR categoria LIKE '%$categoria%'";
            }
        }
        else{
            $sql = "SELECT distinct Libri.codiceLibro, titolo, copertina FROM Libri JOIN scrive on Libri.codiceLibro=scrive.codiceLibro JOIN Autori ON Autori.codiceAutore=scrive.codiceAutore WHERE titolo LIKE '%$search%' OR nomecognome LIKE '%$search%'";
        }

        $result = mysqli_query($conn,$sql);
        $numrighe = mysqli_num_rows($result);
        if($numrighe > 0){
            echo "<a class='sottotitoli'>Ci sono ".$numrighe." risultati</a>";
            $currentPage = creaLista($result,$numrighe,$limite,$sezione);
        }
        else{
            echo "<a class='paragrafi'>Non ci sono risultati per la ricerca!</a>";
            $currentPage=0;
        }
    }

    else{
        if(isset($_GET['cat'])){
            $categoria=$_GET['cat'];
            if($categoria=='all'){
                $sql = "SELECT * FROM Libri";
            }
            else{
                $sql = "SELECT * FROM Libri WHERE categoria LIKE '%$categoria%'";
            }
        }
        else{
            $sql = "SELECT * FROM Libri";
        }
        $result = mysqli_query($conn,$sql);
        $numrighe = mysqli_num_rows($result);
        $currentPage = creaLista($result,$numrighe,$limite,$sezione);
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

        if(isset($_GET['cat'])){
            $categoria="&cat=".$_GET['cat'];
        }
        else{
            $categoria="";
        }

        if($sezione!=0){
            $sez=$sezione-1;
            $page=10*$sezione-1;
            echo "<a href='lista.php?page=1&sez=0$search$categoria'>&laquo;</a>";
            echo "<a href='lista.php?page=$page&sez=$sez$search$categoria'>&lsaquo;</a>";
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
            echo "<a href='lista.php?page=$i&sez=$sez$search$categoria'>$i</a>";
        }
        if($sezione!=$sezioni and $pagine>=0){
            echo "<a href='lista.php?page=$pagine&sez=$sezioni$search$categoria'>&raquo;</a>";
        }

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

include 'footer.php';
?>
