<?php
header('Content-Type: application/json');

require 'database.php';
session_name('burgerchain');
session_start();

$results = [];

if(isset($_SESSION['idUtente']))
{
    $vKey = $_SESSION['vKey'];
    $email = $_SESSION['emailUtente'];
    $nome = $_SESSION['nomeUtente'];
    $cognome = $_SESSION['cognomeUtente'];

    $linkVerification = "http://localhost/Burgerchain/cambiaPassword.php?email=$email&vKey=$vKey";

    $to = $email;
    $subject = "Cambio Password";
    $html = file_get_contents('../mailTemplates/changePasswordTemplate.html');
    $link = "<a href='$linkVerification'>Cambia password</a>";
    $html =  str_replace("{{NOME}}",$nome . " " . $cognome,$html);
    $html =  str_replace("{{LINK}}",$link,$html);
    $headers = "From: burgerchainit@gmail.com" . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($to, $subject, $html, $headers);

    $results['message'] = "Richiesta effettuata con successo! Controlla la tua email!";
}
else
{
    if(!isset($_POST['email']))
        $results['error'] = "Errore nella richiesta!";
    else 
    {
        $email = $_POST['email'];

        $sql = "SELECT * FROM utente WHERE email=?";
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
                $vKey = $row["vKey"];
                $nome = $row["nome"];
                $cognome = $row["cognome"];

                $linkVerification = "http://localhost/Burgerchain/cambiaPassword.php?email=$email&vKey=$vKey";

                $to = $email;
                $subject = "Cambio Password";
                $html = file_get_contents('../mailTemplates/changePasswordTemplate.html');
                $link = "<a href='$linkVerification'>Cambia password</a>";
                $html =  str_replace("{{NOME}}",$nome . " " . $cognome,$html);
                $html =  str_replace("{{LINK}}",$link,$html);
                $headers = "From: burgerchainit@gmail.com" . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($to, $subject, $html, $headers);

                $results['message'] = "success";
            }
            else
                $results['error'] = "Nessun utente trovato con la Email inserita!";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

echo json_encode($results);