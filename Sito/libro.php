<?php
include 'connessione.php';
$conn = OpenCon();
$query = "select * from Libro where codice='0001'";
$result = mysqli_query($conn,$query);
if (!$result) {
    echo 'Impossibile eseguire la query: ' . mysqli_error();
    exit;
}
$row = mysqli_fetch_row($result);
?>

<html>
<head>
    <title> Visualizzazione libro </title>
</head>
<body>
<table align="center" border="1px" style="width:600px; line-height:40px;">
    <tr>
        <th> Codice </th>
        <th> Nome </th>
        <th> Descrizione </th>
        <th> Dove acquistare </th>
    </tr>

    <tr>
        <th> <?php echo $row[0]; ?> </th>
        <th> <?php echo $row[1]; ?> </th>
        <th> <?php echo $row[2]; ?> </th>
        <th> <?php echo $row[3]; ?> </th>
    </tr>

</table>
</body>
</html>