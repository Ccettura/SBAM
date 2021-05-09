<?php
include 'connessione.php';
$conn = OpenCon();
$query = "select * from Libro";
$result = mysqli_query($conn,$query);
?>

<html>
<head>
    <title> Fetch Data From Database </title>
</head>
<body>
<table align="center" border="1px" style="width:600px; line-height:40px;">
    <tr>
        <th colspan="4"><h2>Student Record</h2></th>
    </tr>
    <th> Codice </th>
    <th> Nome </th>
    <th> Descrizione </th>
    <th> Dove acquistare </th>

    </tr>

    <?php while($rows=mysqli_fetch_assoc($result))
    {
        ?>
        <tr> <td><?php echo $rows['codice']; ?></td>
            <td><?php echo $rows['nome']; ?></td>
            <td><?php echo $rows['descrizione']; ?></td>
            <td><?php echo $rows['dove_acquistare']; ?></td>
        </tr>
        <?php
    }
    ?>

</table>
</body>
</html>
