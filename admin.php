<html lang="it">
    <head>
        <link rel="stylesheet" href="Assets/css/ordinaStyle.css" type="text/css"/>
        <script src="Assets/js/jquery-3.6.0.js"></script>
        <title>Burgerchain</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
    body {
        background-color: #000;
        color: #fff;
        font-family: Verdana, sans-serif;
        font-size: 14px;
        }
    #form {
        width: 500px;
        margin: 50px auto; 
        background: #222;
        padding: 25px;
        overflow: hidden;
        -moz-border-radius: 20px;
        -webkit-border-radius: 20px;
        border-radius: 20px;
        }
    h2,h4 {
        font-size: 16px;
        color: #FCCC69;
        margin-bottom: 20px;
        }
    div.C{
        height: 150px;
        width: 250px;
        }
    label, input { /* Stili comuni agli elementi del form */
        color: #dedede; /* Colore del testo */
        float: left; /* Float a sinistra */ 
        font-family: Verdana, sans-serif; /* Tipo di carattere per il testo */
        margin: 10px 0; /* Margini */
        }
    label { /* Stili per la label */
        display: block; /* Impostiamo la label come elemento blocco */
        line-height: 1px; /* Altezza di riga */
        width: 150px; /* Larghezza */
        }
    input{ /* Stili per il campo di testo e per la textarea */
        background: #1C1C1C; /* Colore di sfondo */
        border: 1px solid #323232; /* Bordo */
        color: #fff; /* Colore del testo */
        height: 10px; /* Altezza */
        line-height: 10px; /* Altezza di riga */
        width: 30px; /* Larghezza */
        padding: 0 10px; /* Padding */
        }
    input { padding-left: 30px;
        background: #1C1C1C url('') no-repeat 235px 95px; /* Sfondo con immagine */
        font-size: 12px;
        height: 150px;
        width: 250px;
        overflow: hidden; /* disabilitare la scrollbar in IE */
    }
    #submit {
        padding: 0;
        width: 100px;
        } 
</style>
    </head>
    <body>

    <form action="#" method="POST"> 
    <div id="form">    
    <h2>AMMINISTRATORE GESTIONALE BURGERCHAIN SRL</h2>
    </br>
        <h4>digita nome del prodotto da cancellare</h4>
        <label for="nome">Nome prodotto</label><input type="text" name="prodotto" id="prodotto" value="Inserisci nome prodotto da cancellare"></input>
    </br>
    </br>
        <button type="submit" name="canc" id="canc">CANCELLA PRODOTTO</button>
    </br>
        <h4>digita nome ,costo, immagine prodotto da aggiungere:</h4> 
        <label for="NomeProdo">Nome prodotto</label><input type="text" name="nome" id="nome" value="Nome del nuovo prodotto?"></input>
        <label for="costProd">Costo prodotto</label><input type="number" name="costo" id="costo" value="Costo del nuovo prodotto?"></input>
        <input type="file" name="img" id="img" value="inserisci immagine"></input>
        <button type="submit" name="agg" id="agg">AGGIUNGI PRODOTTO</button>
        <h4>digita qui il nome del vecchio prodotto da sostituire:</h4> 
        <input type="text" name="pro" id="pro" value="nome vecchio prodotto?"></input>
    </br>
        <h4>digita nome ,costo, immagine prodotto da modificare:</h4> 
        <label for="NomeProdo">Nome prodotto</label><input type="text" name="prod" id="prod" value="Modifica nome del prodotto?"></input>
        <label for="costProd">Costo prodotto</label><input type="number" name="cost" id="cost" value="Modifica costo del prodotto?"></input>
        <input type="file" name="files" id="files" value="immagine da cambiare"></input> 
        
    <br>
    </br>
    
        <button type="submit" name="mod" id="mod">MODIFICA PRODOTTO</button>
    </br>
    <h4>digita nome costo ingrediente da aggiungere:</h4>
    <label for="NomeProdo">Nome ingrediente</label><input type="text" name="ADD" id="ADD" value="Aggiungi ingredienti"></input>
    <label for="costProd">Costo ingrediente</label><input type="number" name="cos" id="cos"></input>
    <br>
    </br>
    <button type="submit" name="ing" id="ing">AGGIUNGI INGREDIENTI</button>
    </form>
    </div>
</body>    
        <?php
            //1)connessione al DB
            $connessione=mysqli_connect("localhost","root","","burgerchain");
                if($connessione==false) {
                    die("Connessione non riuscita errno:". mysqli_connect_errno()."error: " .mysqli_connect_error() );
                        }
            //CANCELLA
            if(isset($_POST['canc'])){
            $query="DELETE FROM table_name
            WHERE nome='$_POST[prodotto]'";
            }
            echo $query;
            
            //AGGIUNGERE PRODOTTO
            if(isset($_POST['agg'])){
                $query1="INSERT INTO prodotto (idProdotto, nome, costo, linkImmagine,disponibile,idCategoria)
                VALUES ('' ,'. $_POST[nome].' ,'. $_POST[costo].' ,'.$_POST[img]. ', 1 , 10)";    
            }
            echo $query1;

            //--MODIFICA MENU
            if(isset($_POST['mod'])){
                $query2="UPDATE prodotto 
                SET nome='.$_POST[prod].' , costo='.$_POST[cost].' , linkImmagine='.$_POST[files].'
                WHERE nome=' .$_POST[pro]. ' ";
                }
                echo $query2;

            //--AGGIUNGI INGREDIENTI
            if(isset($_POST['agg'])){
                $query3="INSERT INTO ingrediente (idIngrediente, nome, dettagli, modificabile,costoAggiunta)
                VALUES ('' , '. $_POST[ADD] .' , '', 1 , '. $_POST[cos] .')";
                }
                echo $query3;

            mysqli_close($connessione);
        ?>
</html>