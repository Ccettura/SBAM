<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','db_connect');

// get the post records
$txtEmail = $_POST['mail'];
$txtType = $_POST['type'];
$txtSubject = $_POST['subject'];

// database insert SQL code
$sql = "INSERT INTO `tbl_feedbacks` (`Id`, `fldEmail`, `fldType`, `fldMessage`) VALUES ('0', '$txtEmail', '$txtType', '$txtSubject')";

// insert in database
$rs = mysqli_query($con, $sql);

if($rs)
{
    echo "Contact Records Inserted";
}

?>