<?php
include 'connessione.php';
include 'header.php';
?>

<div class="logoCentrato headline"></div>


<div class="contatti headline">

    <div class="freccie"></div>

    <div class="contatti_content">
        <h1 class="giallo titolo_contatti">CONTATTI</h1>
        <h2 class="bianco descrizione_contatti">Per qualsiasi dubbio o informazioni compila il modulo qui sotto. Ti risponderemo il prima possibile.</h2>
    </div>

    <div class="freccie"></div>

</div>

<div class="sezione_feedback">

    <div class="container">
        <fieldset>
            <form name="feedbackForm" method="POST" action='./Pagine/Feedbacks/feedbacks.php'>

                <p> <label for="mail"><b>Indirizzo e-mail</b></label></p>
                <p> <input type="text" id="mail" name="mail" placeholder="nome@provider.it"> </p>



                <p><label for="type"><b>Tipo di richiesta</b></label>
                    <select id="type" name="type" >
                        <option value="addBook">Aggiunta Libro</option>
                        <option value="addFunction">Aggiunta Funzioni</option>
                        <option value="other">Altro</option>
                    </select></p>

                <p><label for="subject"><b>Suggerimento</b></label>
                    <textarea id="subject" name="subject" placeholder="Scrivi qualcosa" style="height:200px" required></textarea></p>

                <input type="submit" formmethod="post" formaction='./Pagine/Feedbacks/feedbacks.php' name="Submit" id="Submit" value="Submit"/>

            </form>
        </fieldset>
    </div>
    <br>

</div>







<?php
include 'footer.php';
?>
