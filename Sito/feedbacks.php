<?php

include 'connessione.php';
include 'header.php';

?>
<div class="logoCentrato headline"></div>


<?php
// get the post records

$txtEmail = $_POST['mail'];
$txtType = $_POST['type'];
$txtSubject = $_POST['subject'];


echo "<br> La tua mail è $txtEmail ";
echo "<br> Il tipo di richiesta è $txtType ";
echo "<br> Il testo è $txtSubject";

// database insert SQL code
$conn=OpenCon();
$sql = "INSERT INTO `Feedbacks` (`fldEmail`, `fldType`, `fldMessage`) VALUES ('".$txtEmail."', '".$txtType."', '".$txtSubject."')";
$rs = mysqli_query($conn, $sql);
?>

<DOCTYPE html>
    <div align="center"><h1 class="sottotitoli giallo"> <br> Il feedback è stato ricevuto correttamente. <br> Grazie per aver contribuito a migliorare SBAM!<br></h1></div>
    <div align="center"><h2><a class="button"  type="button" href="lista.php">Continua ad esplorare le opere!</a></h2></div>
</DOCTYPE>


<?php
include 'footer.php';
?>
