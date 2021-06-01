function autocomplete(inp, arr) {
    /* La funzione di autocompletamento prevede due elementi:
    l'elemento digitato e un array di possibili elementi ricercati:*/
    var currentFocus;
    /* Esegue la funzione quando qualcuno digita nel campo di testo: */
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        closeAllLists(); // Chiude una possibile lista di autocompletamento già aperta
        if (!val) { return false;}
        currentFocus = -1;
        /* Crea un elemento DIV che conterrà i seguenti valori:*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /* Controlla che il titolo del libro inizi con ciò che si sta cercando:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /* Crea un elemento DIV per ogni elemento che soddisfa il requisito:*/
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /* Esegue una funzione quando qualcuno clicca su un elemento: */
                b.addEventListener("click", function(e) {
                    /* Inserisce il testo dell'autocompletamento nella barra di ricerca */
                    inp.value = this.getElementsByTagName("input")[0].value;

                    closeAllLists(); // Chiude la lista di autocompletamento
                });
                a.appendChild(b);
            }
        }
    });
    /* Esegue una funzione quando viene premuto un tasto sulla tastiera: */
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++; // Freccia verso il basso -> incrementa il contatore ed evidenzia l'elemento selezionato
            addActive(x);
        } else if (e.keyCode == 38) { //up
            currentFocus--; // Freccia verso il basso -> incrementa il contatore ed evidenzia l'elemento selezionato
            addActive(x);
        } else if (e.keyCode == 13) {
            // Tasto INVIO -> si simula il click sull'elemento selezionato
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /* Funzione per contrassegnare l'elemento come "attivo": */
        if (!x) return false;
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /* Funzione per contrassegnare l'elemento come "non attivo": */
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /* Funzione chiudere tutte le liste di autocompletamento: */
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}