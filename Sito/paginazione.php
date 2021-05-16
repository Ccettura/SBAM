<?php

function creaLista($result, $numrighe, $limite, $sezione){
    if(isset($_GET['page'])){
        $currentPage=$_GET['page'];
        $result->data_seek(($currentPage)*$limite);
        $start=($currentPage)*$limite;
    }
    else{
        $currentPage=1;
        $result->data_seek(0);
        $start=0;
    }
    //echo "sezione $sezione pagina $currentPage";
    echo "<div class='row'>";
    for($i=1; $i<=$limite and $i<=$numrighe-$start; $i++){
        $row = mysqli_fetch_assoc($result);
        echo "
            <div class='col-5'>
                <a href='libro.php?cod=" . $row['codiceLibro'] . "'> <p class='sottotitoli'>" . $row['titolo'] . "</p></a>
                <a href='libro.php?cod=" . $row['codiceLibro'] . "'> <img src='copertine/" . $row['copertina'] . "'/> </a>
            </div>";
    }
    echo "</div>";

    return $currentPage;
}

?>