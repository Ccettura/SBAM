<?php
   include 'connessione.php';
   include 'paginazione.php';
   include 'header.php';
?>

<div class="sezioneRicerca headline">

    <div class="instazione_bacheca">
        <h1 class="sottotitoli giallo">CERCA UN LIBRO O UN FUMETTO</h1>
        <p class="paragrafi">Inserisci il titolo o l'isbn di un libro o fumetto per effettuare la ricerca.</p>
    </div>

    <form autocomplete="off" action="lista.php" method="POST">
            <div class="autocomplete">
                <input id="myInput" atype="text" name="search">
                <button class="button" type="submit" name="submit">Cerca</button>
            </div>
    </form>
</div>

<div class="bacheca">
    <select name="categorie">
        <?php
        $conn=OpenCon();
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT nomeCategoria from Categorie";
        $result = mysqli_query($conn,$sql);
        echo "<option>Tutte le categorie</option>";
        while ($row = mysqli_fetch_assoc($result)){
            $categorie = $row['nomeCategoria'];
            echo "<option value='$categorie'>$categorie</option>";
        }
        ?>
    </select>
</div>

<h1 class="sottotitoli giallo centroTesto mt2 headline">LISTA DI LIBRI</h1>

<div class="small-container headline">
    <?php
    $conn=OpenCon();
    $limite=15;
    $libri = mysqli_query($conn,"SELECT titolo FROM Libri");
    $libri = mysqli_fetch_all($libri);
    for($i=0;$i<count($libri);$i++){
        $libro[$i]=$libri[$i][0];
    }

    if (isset($_POST['submit'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT distinct Libri.codiceLibro, titolo, copertina FROM Libri JOIN scrive on Libri.codiceLibro=scrive.codiceLibro JOIN Autori ON Autori.codiceAutore=scrive.codiceAutore WHERE titolo LIKE '%$search%' OR nomecognome LIKE '%$search%'";
        $result = mysqli_query($conn,$sql);
        $numrighe=mysqli_num_rows($result);
        if($numrighe > 0){
            echo "Ci sono ".$numrighe." risultati";
            $currentPage=creaLista($result,$numrighe, $limite);
        }
        else{
            echo "Non ci sono risultati per la ricerca!";
        }
    }

    else{
        $sql = "SELECT * FROM Libri";
        $result = mysqli_query($conn,$sql);
        $numrighe=mysqli_num_rows($result);
        $currentPage=creaLista($result,$numrighe, $limite);
    }
    ?>

    <div class="pagination">
        <?php
        $pagine=$numrighe/$limite;
        $pagine=ceil($pagine);
        for($i=1; $i<=$pagine; $i++){
            echo "<a href='lista.php?page=$i'>$i</a>";
        }
        ?>
    </div>

</div>



<script>
    var div = document.getElementsByClassName("pagination")[0];
    div.children[<?php echo $currentPage-1 ?>].classList.add("active");
</script>

<script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }
    var libro = <?php echo json_encode($libro); ?>
    autocomplete(document.getElementById("myInput"), libro);
</script>

<?php
include 'footer.php';
?>
