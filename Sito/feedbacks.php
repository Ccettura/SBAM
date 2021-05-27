<?php


include 'header.php';?>
<div class="logoCentrato headline"></div>


<?php
// database connection code
mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);
try{
$con = new mysqli('localhost', 'root', '','tbl_feedbacks');
}catch(mysqli_sql_exception $e){

}
//Check Connection

if(mysqli_connect_errno()){
?>
    <DOCTYPE html>
        <div align="center"> <h1 class="sottotitoli giallo"><br> Purtroppo c'è stato un problema. <br> Ci dispiace, ma riprovate più tardi! </h1></div>
        <div align="center"><h2><a class="button"  type="button" href="lista.php">Nel mentre,continua ad esplorare le opere!</a></h2></div>
    </DOCTYPE>

<?php
}
// get the post records

$txtEmail = $_POST['mail'];
$txtType = $_POST['type'];
$txtSubject = $_POST['subject'];

// Test Echoes, cancellare poi
//echo "<br> La tua mail è $txtEmail ";
//echo "<br> Il tipo di richiesta è $txtType ";
//echo "<br> Il testo è $txtSubject";

// database insert SQL code
$sql = "INSERT INTO `tbl_feedbacks` (`Id`, `fldEmail`, `fldType`, `fldMessage`) VALUES ('0', '$txtEmail', '$txtType', '$txtSubject')";

// insert in database

    if (!empty($con)) {
        $rs = mysqli_query($con, $sql);
    }


if (!empty($rs)) {
    if($rs)
    {?>
            <DOCTYPE html>
                <div align="center"><h1 class="sottotitoli giallo"> <br> Il feedback è stato ricevuto correttamente. <br> Grazie per aver contribuito a migliorare SBAM!<br></h1></div>
                <div align="center"><h2><a class="button"  type="button" href="lista.php">Continua ad esplorare le opere!</a></h2></div>

            </DOCTYPE>

    <?php
    }
}


?>

<?php
include 'footer.php';
?>
