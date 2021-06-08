<?php
include 'connessione.php';
include 'header.php';
?>

<div class="logoCentrato headline"></div>


<!-- FORM PER INVIARE UN MESSAGGIO DI FEEDBACK -->

<div class="contatti headline">

    <div class="freccie"></div>

    <div class="contatti_content">
        <h1 class="giallo titolo_contatti">CONTATTI</h1>
        <h2 class="bianco descrizione_contatti">Per qualsiasi dubbio o informazioni compila il modulo qui sotto. Ti risponderemo il prima possibile.</h2>
    </div>

    <div class="freccie"></div>

</div>

<div class="sezione_feedback headline">

    <div class="container">
        <fieldset>
            <form name="feedbackForm" method="POST" action='feedbacks.php'>

                <p class="bianco"> <label for="mail"><b>Indirizzo e-mail</b></label></p>
                <p> <input class="bianco" type="text" id="mail" name="mail" placeholder="esempio@provider.it" alt="Indirizzo mail"> </p>



                <p class="bianco"><label for="type"><b>Tipo di richiesta</b></label>
                    <select class="bianco" id="type" name="type" aria-labelledby="type">
                        <option value="addBook">Aggiunta Libro</option>
                        <option value="addFunction">Aggiunta Funzioni</option>
                        <option value="other">Altro</option>
                    </select></p>

                <p class="bianco"><label for="subject"><b>Suggerimento</b></label>
                    <textarea class="bianco" id="subject" name="subject" placeholder="" style="height:200px" aria-labelledby="subject" required></textarea></p>

                <div class="tasto_submit">
                    <input class="button" type="submit" formmethod="post" formaction='feedbacks.php' name="Submit" id="Submit" value="Submit"/>
                </div>

            </form>
        </fieldset>
    </div>
    <br>

</div>

<?php
include 'footer.php';
?>
