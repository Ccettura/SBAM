<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');


$con = new mysqli('localhost', 'root', '','tbl_feedbacks');

//Check Connection
if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_error();
    exit();
}

// get the post records
$txtEmail = $_POST['mail'];
$txtType = $_POST['type'];
$txtSubject = $_POST['subject'];

echo "La tua mail è $txtEmail ";
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
$rs = mysqli_query($con, $sql);

if($rs)
{
    echo "Contact Records Inserted";
}

echo "<br> Complimenti, forse funziona";

?>