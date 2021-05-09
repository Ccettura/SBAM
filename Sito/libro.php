<?php
include 'connessione.php';
$conn = OpenCon();
// $query = "select * from libro where codice=".$_GET['cod'];
$query = "select * from libro where codice=00001";
$result = mysqli_query($conn,$query);
if (!$result) {
    echo 'Impossibile eseguire la query: '.mysqli_error();
    exit;
}
$row = mysqli_fetch_row($result);
?>

<!DOCTYPE html>
<html lang="it-IT">
<head>
    <title> Visualizzazione libro </title>
</head>
<body>
<table align="center" border="1px" style="line-height:40px;">
    <tr>
        <th> Codice </th>
        <th> Titolo </th>
        <th> Descrizione </th>
        <th> Copertina </th>
        <th> Data di pubblicazione </th>
        <th> Dove acquistare </th>
    </tr>

    <tr>
        <th> <?php echo $row[0]; ?> </th>
        <th> <?php echo $row[1]; ?> </th>
        <th> <?php echo $row[2]; ?> </th>
        <th> <img src="copertine/<?php echo $row[3]; ?>" /> </th>
        <th> <?php echo $row[4]; ?> </th>
        <th> <?php echo $row[5]; ?> </th>
    </tr>

</table>
</body>
</html>