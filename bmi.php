<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
</head>
<body>

    <?php

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

    <a href="index.html" class="link-ricalcola">Calcola di nuovo</a>
    
</body>
</html>