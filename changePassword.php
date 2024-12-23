<?php
header('Content-Type: application/json');

require 'database.php';
session_name('burgerchain');
session_start();

$results = [];

if(!isset($_POST['password']))
    $results['error'] = "Errore nella richiesta!";
else 
{
    if(isset($_SESSION["emailRecover"]) && isset($_SESSION["vKeyRecover"]))
    {
        $password = $_POST['password'];
        $passwordCriptata = password_hash($password, PASSWORD_DEFAULT);
        $email = $_SESSION["emailRecover"];
        $vKey = $_SESSION["vKeyRecover"];
        
        $sql = "SELECT vKey FROM utente WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql))
            $results['error'] = "Errore nel database!";
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        
            if($row = mysqli_fetch_assoc($result))
            {
                if($vKey == $row["vKey"])
                {
                    $sql = "UPDATE utente SET password=? WHERE email=? AND vKey=?";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql))
                        $results['error'] = "Errore nel database!";
                    else 
                    {
                        mysqli_stmt_bind_param($stmt, "sss", $passwordCriptata,$email,$vKey);
                        mysqli_stmt_execute($stmt);

                        $results['message'] = "success";

                        $vKeyNew = md5(time().$email);

                        $sql = "UPDATE utente SET vKey=? WHERE email=? AND vKey=?";
                        $stmt = mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt, $sql))
                            $results['error'] = "Errore nel database!";
                        else 
                        {
                            mysqli_stmt_bind_param($stmt, "sss", $vKeyNew,$email,$vKey);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
                else
                    $results['error'] = "La chiave non è più valida!";
            }
            else
                $results['error'] = "Errore nel database!";
        }
    }
    else
        $results['error'] = "Errore nel database!";
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

echo json_encode($results);