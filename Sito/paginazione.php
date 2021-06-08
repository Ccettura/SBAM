<?php

// MOSTRA I LIBRI APPARTENENTI ALLA PAGINA SELEZIONATA
function creaLista($result, $numrighe, $limite, $sezione){
    if(isset($_GET['page'])){
        $currentPage=$_GET['page'];
        $result->data_seek(($currentPage)*$limite); // Preleva i dati dal primo libro appartenente alla pagina selezionata
        $start=($currentPage)*$limite;
    }
    else{
        $currentPage=1;
        $result->data_seek(0);
        $start=0;
    }
    echo "<div class='row'>";
    for($i=1; $i<=$limite and $i<=$numrighe-$start; $i++){
        $row = mysqli_fetch_assoc($result);
        echo "
            <div class='col-5'>
                <a href='libro.php?cod=" . $row['codiceLibro'] . "'> <p class='sottotitoli'>" . $row['titolo'] . "</p></a>
                <a href='libro.php?cod=" . $row['codiceLibro'] . "'> <img alt='Copertina Libro' src='copertine/" . $row['copertina'] . "' /> </a>
            </div>";
    }
    echo "</div>";

    return $currentPage;
}

?>