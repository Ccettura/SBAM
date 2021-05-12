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
    echo "Connessione al database fallita: " . mysqli_connect_error();

}

// get the post records
$txtEmail = $_POST['mail'];
$txtType = $_POST['type'];
$txtSubject = $_POST['subject'];

// Test Echoes, cancellare poi
echo "<br> La tua mail è $txtEmail ";
echo "<br> Il tipo di richiesta è $txtType ";
echo "<br> Il testo è $txtSubject";

// database insert SQL code
$sql = "INSERT INTO `tbl_feedbacks` (`Id`, `fldEmail`, `fldType`, `fldMessage`) VALUES ('0', '$txtEmail', '$txtType', '$txtSubject')
/*-- create table tbl_feedbacks
(
	Id int null,
	fldEmail int null,
	fldType int null,
	fldMessage int null
); */

";

// insert in database

try {
    $rs = mysqli_query($con, $sql);
}catch(mysqli_sql_exception $e){
    echo "<br> Inserimento fallito";
}
if($rs)
{
    echo "<br> Informazioni trasmesse correttamente";
}

echo "<br> Complimenti, forse funziona";

?>

<?php
include 'footer.php';
?>
