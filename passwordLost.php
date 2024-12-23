<?php
    session_name('P2W');
    session_start();
?>
<html lang="it">
    <head>
        <link rel="stylesheet" href="Assets/css/passwordDimenticataStyle.css" type="text/css"/>
        <script src="Assets/js/jquery-3.6.0.js"></script>
        <title>P2W</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="navBar">
            <a href="index.php"><div class="navBarlogo"></div></a>
            <div class="tabletNav">
                <div class="navItem"><a href="index.php">Inventory</a></div>
                <div class="navItem"><a href="index.php">Our Mission</a></div>
                <div class="navItem"><a href="index.php">Contact</a></div>
                <div class="navItem"><a href="index.php">FUTURE</a></div>
                <div class="navItem"><a href="ordina.php">Order</a></div>
            </div>
            <div class="phoneNav">
                <div class="navBarMenu"></div>
            </div>
        </div>
        
        <div class="main"> 
            <div class="formContainer">
                <div class="formTitle">Change password</div>
                <div class="form">
                    <span class="item text first">Email : </span><input type="email" placeholder="Email" id="emailUtente" class="item first">
                    <button onclick="inviaRichiesta();" class="item last button" id="lastNavItem">Request new Password</button>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div class="footerItem">
                <div class="footerItemTitle">
                    <span class="footerItemTitleTxt">Contact</span>
                </div>
                <div class="footerItemText">
                    <span class="footerItemTextTxt">Email: </span>
                    <span class="footerItemTextTxt"></span>
                </div>
            </div>
            <div class="footerItem">
                <div class="footerItemTitle">
                    <span class="footerItemTitleTxt">Shipping delivery</span>
                </div>
                <div class="footerItemText">
                    <span class="footerItemTextTxt">Everywhere in USA EU Sahara Asia</span>
                </div>
            </div>
            <div class="footerItem">
                <div class="footerItemTitle">
                    <span class="footerItemTitleTxt">© 2021 P2W All Right Reserved.</span>
                </div>
            </div>
        </div>
        <script src="Assets/js/passwordDimenticataScript.js"></script>
    </body>
</html>
