<?php
    session_name('burgerchain');
    session_start();
    if(isset($_SESSION['idUtente']))
        header("Location: index.php");
    
    if(isset($_GET["error"]))
    {
        switch ($_GET["error"]) {
            case "wrongpwd":
                echo '<script language="javascript">';
                echo 'alert("Password o Email sbagliati!")';
                echo '</script>';
                break;
            case "nouser":
                echo '<script language="javascript">';
                echo 'alert("Nessun utente con l\' Email inserita!")';
                echo '</script>';
                break;
        }
    }
?>
<html lang="it">
    <head>
        <link rel="stylesheet" href="Assets/css/loginStyle.css" type="text/css"/>
        <script src="Assets/js/jquery-3.6.0.js"></script>
        <title>Burgerchain</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="navBar">
            <a href="index.php"><div class="navBarlogo"></div></a>
            <div class="tabletNav">
                <div class="navItem"><a href="index.php">Menù</a></div>
                <div class="navItem"><a href="index.php">La Nostra Missione</a></div>
                <div class="navItem"><a href="index.php">Contattaci</a></div>
                <div class="navItem"><a href="index.php">Dove Siamo</a></div>
                <div class="navItem"><a href="ordina.php">Ordina</a></div>
            </div>
            <div class="phoneNav">
                <div class="navBarMenu"></div>
            </div>
        </div>
        
        <div class="main"> 
            <div class="formContainer">
                <div class="formTitle">Accedi</div>
                <form class="form" action="Assets/php/login.php" method="post">
                    <span class="item text first">Email : </span><input type="email" placeholder="Email" name="emailUtente" class="item first" required>
                    <span class="item text">Password : </span><input type="password" placeholder="Password" name="pwdUtente" class="item last special" required>
                    <span class="item text last special"><a href="passwordDimenticata.php">Password dimenticata?</a></span>
                    <input type="submit" name="login-submit" value="Accedi" class="item last button" id="lastNavItem">
                </form>
            </div>
            <button class="buttonMain" onclick="location.href = 'register.php';">Registrati</button>
        </div>
        
        <div class="footer">
            <div class="footerItem">
                <div class="footerItemTitle">
                    <span class="footerItemTitleTxt">Dove Siamo</span>
                </div>
                <div class="footerItemText">
                    <a class="footerItemTextTxt" href="https://www.google.com/maps/dir//Burgerchain,+Lungogesso+Corso+Giovanni+XXIII,+30+E,+12100+Cuneo+CN/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x12cd6987a8c06759:0xd018c6e98c2f9f89?sa=X&ved=0ahUKEwigt4-X0r7sAhVkA2MBHZpiBtAQ48ADCCUwAA"><span class="linkTxt">Lungogesso corso Giovanni XXIII 30E, CUNEO 12100</span></a>
                </div>
            </div>
            <div class="footerItem">
                <div class="footerItemTitle">
                    <span class="footerItemTitleTxt">Contatti</span>
                </div>
                <div class="footerItemText">
                    <span class="footerItemTextTxt">Email: burgerchainit@gmail.com</span>
                    <span class="footerItemTextTxt">Tel/whatsapp: +393756663517</span>
                    <div class="footerItemTextTxt linksFooter">
                        <a href="https://www.facebook.com/Burgerchain-106615494292509/"><div id="facebookLogoFooter"></div></a>
                        <a href="https://www.instagram.com/burgerchain/"><div id="instagramLogoFooter"></div></a>
                        <a href="tel:+393756663517"><div id="whatsappLogoFooter"></div></a>
                    </div>
                </div>
            </div>
            <div class="footerItem">
                <div class="footerItemTitle">
                    <span class="footerItemTitleTxt">Orari di Apertura</span>
                </div>
                <div class="footerItemText">
                    <span class="footerItemTextTxt">Aperto tutti i giorni: dalle 12:00 alle 23:00</span>
                </div>
            </div>
            <div class="footerItem">
                <div class="footerItemTitle">
                    <span class="footerItemTitleTxt">© 2021 Burgerchain S.R.L. All Right Reserved.</span>
                </div>
            </div>
        </div>
    </body>
</html>
