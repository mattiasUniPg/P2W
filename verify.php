<?php
if(isset($_GET['vkey']))
{
    require 'database.php';
    
    $vKey = $_GET['vkey'];
    
    $sql = "SELECT verificato,vKey FROM utente WHERE verificato = 0 AND vKey = '$vKey'";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location: ../../login.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        
        if($resultCheck == 0)
        {
            header("Location: ../../index.php?error=nouser");
            exit();
        }
        else
        {
            $sql = "UPDATE utente SET verificato = 1 WHERE verificato = 0 AND vKey = '$vKey'";
            $stmt = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../../index.php?error=sqlerror");
                exit();
            }
            else
            {
                mysqli_stmt_execute($stmt);
                
                header("Location: ../../index.php?verify=success");
                exit();
            }
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else
{
    header("Location: ../../index.php");
    exit();
}