<?php
header('Content-Type: application/json');

$results = [];

if(!isset($_POST['request']) && $_POST['request'] == "Prodotti")
    $results['error'] = "Errore nella richiesta!";
else 
{
    require 'database.php';
    session_name('burgerchain');
    session_start();
    
    $prodotti = [];
    
    $sql = "SELECT * FROM prodotto ORDER BY nome";
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
            $prodotti[$i] = $row;
            $i++;
        }
        
        foreach ($prodotti as $key => $prodotto)
        {
            if (!is_file("../../".$prodotto["linkImmagine"]))
                $prodotti[$key]["linkImmagine"] = "Assets/img/icons/noImageIcon.svg";
        }
        
        $results['prodotti'] = $prodotti;
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

echo json_encode($results);