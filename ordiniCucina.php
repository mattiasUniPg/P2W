<?php
header('Content-Type: application/json');

require 'database.php';
session_name('burgerchain');
session_start();

$results = [];

$sql = "SELECT ordine.idOrdine,ordine.idUtente,ordine.data,ordine.ora,ordine.stato,prodotto.nome,ordine_prodotto.dettagli,ordine_prodotto.quantità
        FROM ordine 
        INNER JOIN ordine_prodotto 
        ON ordine.idOrdine = ordine_prodotto.idOrdine
        INNER JOIN prodotto
        ON ordine_prodotto.idProdotto = prodotto.idProdotto
        WHERE stato = 'In Preparazione'";
$stmt = mysqli_stmt_init($conn);

if(mysqli_stmt_prepare($stmt, $sql))
{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $i = 0;

    while($row = mysqli_fetch_assoc($result))
    {
        $ordini[$i] = $row;
        $i++;
    }
    
    $results['message'] = $ordini;
}
else
    $results['errore'] = "Errore nel database";

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo json_encode($results);