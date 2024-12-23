<?php
if(isset($_POST['register-submit']))
{
    require 'database.php';
    
    $nome = $_POST['nomeUtente'];
    $cognome = $_POST['cognomeUtente'];
    $email = $_POST['emailUtente'];
    $password = $_POST['pwdUtente'];
    $passwordRepeat = $_POST['rptPwdUtente'];
    $phone = $_POST['telUtente'];
    $createDate = date("Y/m/d");
    $createHour = date('H:i:s');
    $vKey = md5(time().$nome);
    
    $linkVerification = "http://localhost/Burgerchain/Assets/php/verify.php?vkey=$vKey";
    
    $utente = [$nome,$cognome,$email,$password,$passwordRepeat,$birth,$phone];
    
    $sql = "SELECT email FROM utente WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location: ../../register.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        
        if($resultCheck > 0)
        {
            header("Location: ../../register.php?error=emailTaken");
            exit();
        }
        else 
        {
            if($password != $passwordRepeat)
            {
                header("Location: ../../register.php?error=pwdMatch");
                exit();
            }
            else
            {
                $sql = "INSERT INTO utente(nome,cognome,email,password,telefono,dataCreazione,oraCreazione,vKey) VALUES(?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
            
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../../register.php?error=sqlerror");
                    exit();
                }
                else
                {
                    $passwordCriptata = password_hash($password, PASSWORD_DEFAULT);
                
                    mysqli_stmt_bind_param($stmt, "ssssssss", $nome,$cognome,$email,$passwordCriptata,$phone,$createDate,$createHour,$vKey);
                    mysqli_stmt_execute($stmt);
                        
                    $to = $email;
                    $subject = "Verifica Account";
                    $html = file_get_contents('../mailTemplates/verificationTemplate.html');
                    $link = "<a href='$linkVerification'>Verifica Account</a>";
                    $html =  str_replace("{{NOME}}",$nome . " " . $cognome,$html);
                    $html =  str_replace("{{LINK}}",$link,$html);
                    $headers = "From: burgerchainit@gmail.com" . "\r\n";
                    $headers .= "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    mail($to, $subject, $html, $headers);

                    header("Location: ../../index.php?signup=success");
                    exit();
                }
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