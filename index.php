<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolo BMI</title>

    <?php 
        if($_SERVER["REQUEST_METHOD"] == "GET"){
    ?>
    <style>
        /* Reset base e Font di sistema */
        * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        /* Sfondo della pagina e centratura generale */
        body {
        background-color: #F1F3F5;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        min-height: 100vh;
        color: #1F2328;
        }

        /* Titolo <h1> con specifiche esatte di margine e centratura */
        h1 {
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 114px 135px 24px 135px;
        font-size: 2rem;
        font-weight: 700;
        }

        /* Card (contenitore principale) */
        .card {
        width: 360px;
        max-width: calc(100vw - 120px); /* Garantisce rispetto dei margini laterali di 60px anche su mobile */
        background-color: #ffffff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        
        /* Margini richiesti: top 175px, bottom 114px, sx/dx 60px con auto per centratura */
        margin-top: 0px;
        margin-bottom: 114px;
        margin-left: auto;
        margin-right: auto;
        
        text-align: left; /* Allinea le label del form a sinistra per ottima usabilità */
        }

        /* Classe .rigaForm per ciascun campo */
        .rigaForm {
        padding: 0px;
        margin: 0 0 16px 0;
        display: flex;
        flex-direction: column;
        gap: 6px; /* Distanza di 6px tra label e input */
        }

        /* Stile Label */
        .rigaForm label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #000000;
        }

        /* Tag <input> con altezza di 44px */
        .rigaForm input {
        height: 44px;
        width: 100%;
        padding: 0 12px;
        border: 1px solid #D0D7DE;
        border-radius: 6px;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        }

        .rigaForm input:focus {
        border-color: #0969DA;
        box-shadow: 0 0 0 3px rgba(9, 105, 218, 0.15);
        }

        /* Pulsante "Calcola" */
        .btn-calcola {
        background-color: #1F2328;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        width: 100%;
        margin-top: 24px;
        height: 44px;
        border: none;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-calcola:hover {
        background-color: #32383E;
        }

        .btn-calcola:active {
        transform: scale(0.99);
        }

        /*risultato in più*/
        /* Box del risultato dell'IMC */
        .risultato-container {
        margin-top: 20px;
        padding: 16px;
        border-radius: 8px;
        background-color: #F6F8FA;
        border: 1px solid #E1E4E8;
        display: none;
        text-align: center;
        }

        .risultato-container.attivo {
        display: block;
        animation: fadeIn 0.3s ease-in-out;
        }

        .risultato-titolo {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #57606A;
        margin-bottom: 4px;
        }

        .risultato-valore {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1F2328;
        }

        .risultato-stato {
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 4px;
        }

        @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
        }
    </style>
    <?php 
        }else{
    ?>
    <style>
        /* Reset base e Font sans-serif */
        * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        /* Sfondo della pagina e centratura generale */
        body {
        background-color: #F1F3F5;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        min-height: 100vh;
        color: #1F2328;
        }

        /* Tag h1 */
        h1 {
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 161px 175px 0px 175px;
        font-size: 2rem;
        font-weight: 700;
        }

        /* Struttura principale della Card generale */
        .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 24px 60px;
        border-style: solid;
        border-width: 3px;
        border-radius: 12px;
        width: fit-content;
        }

        /* Primo tag h3 con id "titolo" */
        #titolo {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-top: 27px;
        margin-bottom: 8px;
        margin-left: auto;
        margin-right: auto;
        font-size: 1.5rem;
        font-weight: 700;
        }

        /* Paragrafo subito dopo il primo h3 */
        .card p.descrizione {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-top: 0px;
        margin-bottom: 16px;
        color: #484F58;
        font-size: 1rem;
        }

        /* Testo valore BMI subito dopo il paragrafo */
        .valore-bmi {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin: 0px 115px 16px 115px;
        font-size: 48px;
        font-weight: bold;
        line-height: 1;
        }

        /* Secondo tag h3 (Fascia BMI) */
        .card h3.fascia-bmi {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-bottom: 27px;
        font-size: 1.5rem;
        font-weight: 700;
        }

        /* --- SOTTOCLASSI CARD --- */

        /* 1. Classe "sottopeso" */
        .card.sottopeso {
        background-color: #E3EEF9;
        border-color: #2F6FB3;
        }
        .card.sottopeso h3.fascia-bmi {
        color: #2F6FB3;
        }

        /* 2. Classe "normopeso" */
        .card.normopeso {
        background-color: #E3F4E6;
        border-color: #256D34;
        }
        .card.normopeso h3.fascia-bmi {
        color: #256D34;
        }

        /* 3. Classe "sovrappeso" */
        .card.sovrappeso {
        background-color: #FCEBD7;
        border-color: #9A4F06;
        }
        .card.sovrappeso h3.fascia-bmi {
        color: #9A4F06;
        }

        /* 4. Classe "obesita" */
        .card.obesita {
        background-color: #FBE2E2;
        border-color: #B32D2D;
        }
        .card.obesita h3.fascia-bmi {
        color: #B32D2D;
        }

        /* Link subito sotto la card */
        .link-ricalcola {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin: 0px 185px 161px 185px;
        color: #0969DA;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        }

        .link-ricalcola:hover {
        text-decoration: underline;
        }
    </style>

    <?php
    }
    ?>

</head>
<body>


    <?php

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(is_null($nome)){

    ?>
        <div>ERRORE</div>

    <?php
        }elseif(is_null($peso) || $peso<2 || $peso>300){
    ?>
          <div>ERRORE</div>
    
    <?php        
        }elseif(is_null($altezza) || $altezza<2 || $altezza>240){
    ?>
            
        
        <div>ERRORE</div>
    
    <?php
    }else{
        
        $nome = $_POST["nome"];
        $peso = $_POST["peso"];
        $altezza = $_POST["altezza"];

        $bmi = $peso / pow(($altezza / 100), 2);

        $bmi = round($bmi, 2);

        if($bmi<18.5){
            $classe = "sottopeso";
            $fascia = "SOTTOPESO";
        }elseif($bmi>18.5 && $bmi<24.9){
            $classe = "normopeso";
            $fascia = "NORMOPESO";
        }elseif($bmi>25 && $bmi<29.9){
            $classe = "sovrappeso";
            $fascia = "SOVRAPPESO";
        }elseif($bmi>30){
            $classe = "obesita";
            $fascia = "OBESITÀ";
        }

    }
   
    ?>



<?php 
    if($_SERVER["REQUEST_METHOD"] == "GET"){
?>
    <main>
        <h1>Calcolatore BMI</h1>

        <div class="card">

            <form action="index.php" method="get">
                
                <div class="rigaForm">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" required>
                </div>

                <div class="rigaForm">
                    <label for="peso">Peso (kg)</label>
                    <input type="number" min="1" max="300" step="0.05" name="peso" id="peso" required>
                </div>

                <div class="rigaForm">
                    <label for="altezza">Altezza (cm)</label>
                    <input type="number" min="8" max="240" step="0.5" name="altezza" id="altezza" required>
                </div>

                <!--puoi usare button-->
                <input type="submit" name="calcola" value="Calcola" class="btn-calcola">
                
            </form>

        </div>
    </main>
<?php 
    }else{
?>


    <h1>Il tuo BMI</h1>

    <div class="card-container">

        <div class="card <?= $classe ?>">
        <h3 id="titolo"><?= $nome ?></h3>
        <p class="descrizione"><?php echo "Peso " . $peso . " kg - Altezza " . $altezza . " cm" ?></p>
        <div class="valore-bmi"><?= $bmi?></div>
        <h3 class="fascia-bmi"><?= $fascia ?></h3>
        </div>

    </div>

    <a href="index.php" class="link-ricalcola">Calcola di nuovo</a>


<?php
    }
?>

    
</body>
</html>