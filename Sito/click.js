var risultati = document.getElementsByClassName("risultato");
for (let i=0; i<risultati.length; i++){
    risultati[i].firstChild.addEventListener("click",function () {
        alert("prova");
        ...
    });
}