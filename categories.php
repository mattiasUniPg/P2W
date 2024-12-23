<?php
require 'database.php';

$categorie = [];

$sql = "SELECT * FROM categoria";
$stmt = mysqli_stmt_init($conn);

if(mysqli_stmt_prepare($stmt, $sql))
{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $i=0;

    while($row = mysqli_fetch_assoc($result))
    {
        $categorie[$row["nome"]] = $row;
        $i++;
    }
}

foreach ($categorie as $key => $categoria)
{
    $sql = "SELECT COUNT(idProdotto) AS numero FROM prodotto WHERE idCategoria=? AND disponibile=1";
    $stmt = mysqli_stmt_init($conn);
    
    if(mysqli_stmt_prepare($stmt, $sql))
    {
        mysqli_stmt_bind_param($stmt, "i", $categoria["idCategoria"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($result))
            $categorie[$key]["numeroProdotti"] = $row["numero"];
    }
}

$_SESSION["categorie"] = $categorie;

mysqli_stmt_close($stmt);
mysqli_close($conn);