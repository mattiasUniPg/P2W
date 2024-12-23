<?php
header('Content-Type: application/json');

$results = [];

if(!isset($_POST['prodotti']))
    $results['error'] = "Errore nella richiesta!";
else 
{
    require 'database.php';
    session_name('burgerchain');
    session_start();
    
    $prodotti = $_POST['prodotti'];
    $idUtente = $_SESSION['idUtente']; 
    $data = date("Y/m/d");
    $ora = date('H:i:s');
    $importo = 0;
    $stato = "In Preparazione";
    
    for($i=0;$i<count($prodotti);$i++)
        $importo+=$prodotti[$i]["costoTotale"];
    
    $sql = "INSERT INTO ordine(idUtente,data,ora,importo,stato) VALUES(?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        $results['error'] = "Sql Error!";
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "issss", $idUtente,$data,$ora,$importo,$stato);
        mysqli_stmt_execute($stmt);
        
        $idOrdine = $stmt->insert_id;
        
        for($i=0;$i<count($prodotti);$i++)
        {
            $sql = "INSERT INTO ordine_prodotto(idOrdine,idProdotto,dettagli,quantità,importo) VALUES(?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                $results['error'] = "Sql Error!";
            }
            else
            {
                if(isset($prodotti[$i]["dettagliProdotto"]))
                    $dettagliStringa = implode(", ", $prodotti[$i]["dettagliProdotto"]);
                else
                    $dettagliStringa = "";
                
                mysqli_stmt_bind_param($stmt, "iisis", $idOrdine,$prodotti[$i]["idProdotto"],$dettagliStringa,$prodotti[$i]["quantita"],$prodotti[$i]["costoTotale"]);
                mysqli_stmt_execute($stmt);
            }
        }
        
        $email = $_SESSION["emailUtente"];
        $nome = $_SESSION["nomeUtente"];
        $cognome = $_SESSION["cognomeUtente"];
        
        $link = "http://localhost/Burgerchain/account.php";
        
        $to = $email;
        $subject = "Ordine effettuato";
        $html = file_get_contents('../mailTemplates/sentOrderTemplate.html');
        $linkHtml = "<a href='$link'>Vedi Ordine</a>";
        $html =  str_replace("{{NOME}}",$nome . " " . $cognome,$html);
        $html =  str_replace("{{LINK}}",$linkHtml,$html);
        $headers = "From: burgerchainit@gmail.com" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $html, $headers);

        $results['message'] = "success";
        
        $results['message'] = "Ordine inviato! Controlla il tuo account per monitorare lo stato, ti aspettiamo a negozio!";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

echo json_encode($results);