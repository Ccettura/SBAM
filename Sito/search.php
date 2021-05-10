<?php
   include 'connessione.php';
?>
...
<html>
<head></head>
<body>
<h1> Pagina di Ricerca </h1>
<div class="libri-container">
    <?php
    $conn=OpenCon();
    if (isset($_POST['submit'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM libro WHERE titolo LIKE '%$search%' OR autori LIKE '%$search%'";
        $result = mysqli_query($conn,$sql);
        $queryResult = mysqli_num_rows($result);



        if($queryResult > 0){
            echo "Ci sono ".$queryResult." risultati";
            while($row = mysqli_fetch_Assoc($result)){
                echo "<div>
                         <h3>".$row['titolo']."</h3>
                         <h3>".$row['copertina']."</h3>
                         <h3>".$row['autori']."</h3>
                         <h3>".$row['descrizione']."</h3>
                         <h3>".$row['dataPubblicazione']."</h3>
                         <h3>".$row['editore']."</h3>
                         <h3>".$row['doveAcquistare']."</h3>
                       </div>";
            }
        }else{
            echo "Non ci sono risultati per la ricerca!";
        }
    }
    ?>
</div>
</body>
</html>