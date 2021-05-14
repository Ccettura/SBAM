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

    <form autocomplete="off" action="lista.php" method="POST">
            <div class="autocomplete">
                <input id="myInput" class="input_codice" atype="text" name="search">
                <button class="button" type="submit" name="submit">Cerca</button>
            </div>
    </form>
</div>

<div class="bacheca">
    <select name="categorie">
        <?php
        $conn=OpenCon();
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT nomeCategoria from Categorie";
        $result = mysqli_query($conn,$sql);
        echo "<option>Tutte le categorie</option>";
        while ($row = mysqli_fetch_assoc($result)){
            $categorie = $row['nomeCategoria'];
            echo "<option value='$categorie'>$categorie</option>";
        }
        ?>
    </select>
</div>

<h1 class="sottotitoli giallo centroTesto mt2 headline">LISTA DI LIBRI</h1>

<div class="small-container headline">
    <?php
    $conn=OpenCon();
    $limite=15;
    $libri = mysqli_query($conn,"SELECT titolo FROM Libri");
    $libri = mysqli_fetch_all($libri);
    for($i=0;$i<count($libri);$i++){
        $libro[$i]=$libri[$i][0];
    }

    if (isset($_POST['submit'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT distinct Libri.codiceLibro, titolo, copertina FROM Libri JOIN scrive on Libri.codiceLibro=scrive.codiceLibro JOIN Autori ON Autori.codiceAutore=scrive.codiceAutore WHERE titolo LIKE '%$search%' OR nomecognome LIKE '%$search%'";
        $result = mysqli_query($conn,$sql);
        $numrighe=mysqli_num_rows($result);
        if($numrighe > 0){
            echo "Ci sono ".$numrighe." risultati";
            $currentPage=creaLista($result,$numrighe, $limite);
        }
        else{
            echo "Non ci sono risultati per la ricerca!";
        }
    }

    else{
        $sql = "SELECT * FROM Libri";
        $result = mysqli_query($conn,$sql);
        $numrighe=mysqli_num_rows($result);
        $currentPage=creaLista($result,$numrighe, $limite);
    }
    ?>

    <div class="pagination">
        <?php
        $pagine=$numrighe/$limite;
        $pagine=ceil($pagine);
        for($i=1; $i<=$pagine; $i++){
            echo "<a href='lista.php?page=$i'>$i</a>";
        }
        ?>
    </div>

</div>


<script>
    var div = document.getElementsByClassName("pagination")[0];
    div.children[<?php echo $currentPage-1 ?>].classList.add("active");
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
