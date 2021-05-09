<?php
include 'connessione.php';
$conn = OpenCon();
$query = "select * from libro";
$result = mysqli_query($conn,$query);
if (!$result) {
    echo 'Impossibile eseguire la query: '.mysqli_error();
    exit;
}
?>

<html>
<head>
    <title> Fetch Data From Database </title>
</head>
<body>
<table align="center" border="1px" style="line-height:40px;">
    <tr>
        <th> Titolo </th>
        <th> Copertina </th>
        <th> Data di pubblicazione </th>
    </tr>

    <?php while($row=mysqli_fetch_assoc($result))
    {
        ?>
        <tr>
            <td> <?php echo $row['titolo']; ?> </td>
            <td> <img src="copertine/<?php echo $row['copertina']; ?>" /> </td>
            <td> <?php echo $row['dataPubblicazione']; ?></td>
        </tr>
        <?php
    }
    ?>

</table>
</body>
</html>