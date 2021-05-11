<?php
   include 'connessione.php';
   include 'header.php';
?>

<div class="sezioneRicerca headline">

    <div class="instazione_bacheca">
        <h1 class="sottotitoli giallo">CERCA UN LIBRO O UN FUMETTO</h1>
        <p class="paragrafi">Inserisci il titolo o l'isbn di un libro o fumetto per effettuare la ricerca.</p>
    </div>

    <form action="lista.php" method="POST">
        <div class="barra_ricerca">
            <div>
                <input class="input_codice" atype="text" name="search">
                <button class="button" type="submit" name="submit">Cerca</button>
            </div>
        </div>
    </form>
</div>

<div class="bacheca">
    <select name="Categorie">
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
    if (isset($_POST['submit'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM Libri JOIN scrive on Libri.codiceLibro=scrive.codiceLibro JOIN Autori ON Autori.codiceAutore=scrive.codiceAutore WHERE titolo LIKE '%$search%' OR nome LIKE '%$search%' OR cognome LIKE '%$search%'";
        $result = mysqli_query($conn,$sql);
        $queryResult = mysqli_num_rows($result);

        if($queryResult > 0){
            echo "Ci sono ".$queryResult." risultati";
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)){
                echo "
                    <div class='col-5'>
                        <a href='libro.php?cod=".$row['codiceLibro']."'> <p class='sottotitoli'>".$row['titolo']."</p></a>
                        <a href='libro.php?cod=".$row['codiceLibro']."'> <img src='copertine/".$row['copertina']."'/> </a>
                    </div>";
            }
            echo "</div>";
        }else{
            echo "Non ci sono risultati per la ricerca!";
        }
    }

    else{
        $sql = "SELECT * FROM Libri";
        $result = mysqli_query($conn,$sql);
        echo "<div class='row'>";
        while($row = mysqli_fetch_Assoc($result)) {
            echo "
                <div class='col-5'>
                    <a href='libro.php?cod=" . $row['codiceLibro'] . "'> <p class='sottotitoli'>" . $row['titolo'] . "</p></a>
                    <a href='libro.php?cod=" . $row['codiceLibro'] . "'> <img src='copertine/" . $row['copertina'] . "'/> </a>
                </div>";
        }
        echo "</div>";
    }
    ?>
</div>



<?php
include 'footer.php';
?>
