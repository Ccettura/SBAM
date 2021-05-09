<?php
   include 'connessione.php';
?>
<html>
<head>
</head>
<body>
<form action="search.php" method="POST">
    <input type="text" name="search" placeholder="Search">
    <button type="submit" name="submit"></button>
</form>

<h1> Lista di Libri: </h1>

<div class="libri-container">
     <?php
         $conn= OpenCon();
         $sql = "SELECT * FROM libro";
         $result =mysqli_query($conn,$sql);
         $queryResults = mysqli_num_rows($result);

         if($queryResults > 0){
             while($row = mysqli_fetch_Assoc($result)){
                 echo " <div>
                         <h3>".$row['titolo']."</h3>
                         <h3>".$row['copertina']."</h3>
                         <h3>".$row['autori']."</h3>
                         <h3>".$row['descrizione']."</h3>
                         <h3>".$row['dataPubblicazione']."</h3>
                         <h3>".$row['editore']."</h3>
                         <h3>".$row['doveAcquistare']."</h3>
                       </div>";
             }
         }
         ?>
</div>
</body>
</html>
