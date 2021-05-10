<?php
   include 'connessione.php';
   include 'header.php';
?>


<form action="lista.php" method="POST">
    <div class="barra_ricerca">
        <div>
            <input class="input_codice" atype="text" name="search">
            <button class="button" type="submit" name="submit">Cerca</button>
        </div>
    </div>
</form>

<h1> Lista di Libri: </h1>

<div class="small-container">
    <?php
    $conn=OpenCon();
    if (isset($_POST['submit'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM libro WHERE titolo LIKE '%$search%' OR autori LIKE '%$search%'";
        $result = mysqli_query($conn,$sql);
        $queryResult = mysqli_num_rows($result);

        if($queryResult > 0){
            echo "Ci sono ".$queryResult." risultati";
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)){
                echo "
                    <div class='col-5'>
                        <a href='libro.php?cod=".$row['codice']."'> <p class='sottotitoli'>".$row['titolo']."</p></a>
                        <a href='libro.php?cod=".$row['codice']."'> <img src='copertine/".$row['copertina']."'/> </a>
                    </div>";
            }
            echo "</div>";
        }else{
            echo "Non ci sono risultati per la ricerca!";
        }
    }

    else{
        $sql = "SELECT * FROM libro";
        $result = mysqli_query($conn,$sql);
        echo "<div class='row'>";
        while($row = mysqli_fetch_Assoc($result)) {
            echo "
                <div class='col-5'>
                    <a href='libro.php?cod=" . $row['codice'] . "'> <p class='sottotitoli'>" . $row['titolo'] . "</p></a>
                    <a href='libro.php?cod=" . $row['codice'] . "'> <img src='copertine/" . $row['copertina'] . "'/> </a>
                </div>";
        }
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
