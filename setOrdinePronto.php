<?php
header('Content-Type: application/json');

if(isset($_POST["idOrdine"]))
{
    require 'database.php';
    session_name('burgerchain');
    session_start();

    $results = [];
    $idOrdine = $_POST["idOrdine"];

    $sql = "UPDATE ordine SET stato='Pronto' WHERE idOrdine=?";
    $stmt = mysqli_stmt_init($conn);

    if(mysqli_stmt_prepare($stmt, $sql))
    {
        mysqli_stmt_bind_param($stmt, "i", $idOrdine);
        mysqli_stmt_execute($stmt);
        
        $results['message'] = "Stato cambiato correttamente!";
    }
    else
        $results['errore'] = "Errore nel database";

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else
    $results['errore'] = "Errore nella richiesta";

echo json_encode($results);