<?php
header('Content-Type: application/json');

$results = [];

if(!isset($_POST['request']) && $_POST['request'] == "PaniniMenu")
    $results['error'] = "Errore nella richiesta!";
else 
{
    require 'database.php';
    session_name('burgerchain');
    session_start();
    
    $paniniMenu = [];
    
    $sql = "SELECT * FROM prodotto INNER JOIN menu_prodotto ON prodotto.idProdotto = menu_prodotto.idMenu;";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
        $results['error'] = "Errore nel database!";
    else 
    {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $i=0;
        
        while($row = mysqli_fetch_assoc($result))
        {
            $paniniMenu[$i] = $row;
            $i++;
        }
        
        $results['paniniMenu'] = $paniniMenu;
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

echo json_encode($results);