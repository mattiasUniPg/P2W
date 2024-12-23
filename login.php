<?php
if(isset($_POST['login-submit']))
{
    require 'database.php';
    
    $email = $_POST['emailUser'];
    $password = $_POST['pwdUser'];
    
    $sql = "SELECT * FROM user WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location: ../../login.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($result))
        {
            $passwordCheck = password_verify($password, $row['password']);
            
            if(!$passwordCheck)
            {
                header("Location: ../../login.php?error=wrongpwd");
                exit();
            }
            else if($passwordCheck)
            {
                if($row['blocked'] == 0)
                {
                    if($row['verify'] == 1)
                    {              
                        session_name('P2W');
                        session_start();

                        $_SESSION['idUser'] = $row['idUser'];
                        $_SESSION['nameUser'] = $row['name'];
                        $_SESSION['surnameUser'] = $row['surname'];
                        $_SESSION['emailUser'] = $row['email'];
                        $_SESSION['numbUser'] = $row['number'];
                        $_SESSION['vKey'] = $row['vKey'];

                        header("Location: ../../ordina.php?login=success");
                        exit();
                    }
                    else
                    {
                        header("Location: ../../login.php?error=notverified");
                        exit();
                    }
                }
            }
            else 
            {
                header("Location: ../../login.php?error=wrongpwd");
                exit();
            }
        }
        else
        {
            header("Location: ../../login.php?error=nouser");
            exit();
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