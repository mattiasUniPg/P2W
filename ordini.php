<?php
require 'database.php';

$order = [];

$sql = "SELECT order.idOrder,order.idUser,order.date,order.hour,order.status,product.name,order_product.detail,order_product.quantity
        FROM order 
        INNER JOIN order_product 
        ON order.idOrder = order_product.idOrder
        INNER JOIN product
        ON order_product.idProduct = product.idProduct
        WHERE idUser = ?";
$stmt = mysqli_stmt_init($conn);

if(mysqli_stmt_prepare($stmt, $sql))
{
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['idUser']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $i = 0;

    while($row = mysqli_fetch_assoc($result))
    {
        $order[$i] = $row;
        $i++;
    } 
}

$_SESSION["order"] = $ordini;

mysqli_stmt_close($stmt);
mysqli_close($conn);