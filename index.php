<?php
    session_name('P2W');
    session_start();
    
    if(isset($_GET["message"]))
    {
        switch ($_GET["message"]) {
            case "success":
                echo '<script language="javascript">';
                echo 'alert("Operation complete!")';
                echo '</script>';
                break;
        }
    }
?>
<html lang="it">
    <head>
        <link rel="stylesheet" href="Assets/css/indexStyle.css" type="text/css"/>
        <script src="Assets/js/jquery-3.6.0.js"></script>
        <title>P2W</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="navBar">
            <a href=""><div class="navBarlogo"></div></a>
            <div class="tabletNav">
                <div class="navItem"><a href="" onclick="return false;" id="menuButton">Inventory</a></div>
                <div class="navItem"><a href="" onclick="return false;" id="missionButton">Our Mission</a></div>
                <div class="navItem"><a href="" onclick="return false;" id="contactusButton">Contact</a></div>
                <div class="navItem"><a href="" onclick="return false;" id="whereweareButton">Future</a></div>
                <div class="navItem"><a href="ordina.php">Shop</a></div>
                <?php
                    if(isset($_SESSION['idUser']))
                        echo "<div class='navItem image navBarLastitem' onclick=\"location.href = 'account.php';\"><div id='accountIcon'></div></div>";
                ?> 
            </div>
            <div class="phoneNav">
                <div class="navBarMenu"></div>
            </div>
        </div>

        <div class="main">
            <div class="sez1"></div>
            <div class="mark" id="menuMark"></div>
            <div class="sez2">
                <div class="titolo"><span>Inventory</span></div>
                <div class="testo">
                    <span class="text">
                    Our service represents, as well as a place where you can taste products 
                        unique, also an information pole. Being a P2W customer does not mean 
                        only being privileged customers but also means embracing and understanding 
                        THE FUTURE!
                    </span>
                    <button class="button" onclick="location.href = 'order.php';">Order</button>
                </div>
            </div>
            <div class="sez3"></div>
            <div class="mark" id="missionMark"></div>
            <div class="sez4">
                <div class="titolo"><span>Our Mission</span></div>
                <div class="testo" id="testoSez4">
                    <div class="left">
                        <span class="text">
                            P2W® S.R.L is a company born with the aim of merging good service from the comfort of your home with the passion and ingenuity of what the economy represents 
                            of the future: CRYPTOCURRENCIES. Our mission is precisely to render, for our 
                            customers, this payment system a means of education and evolution, combined with the 
                            possibility to save money and, why not, have fun!
                        </span>
                    </div>
                    <div class="right">
                        <div class="img" id="img1"></div>
                        <div class="img" id="img2"></div>
                    </div>
                </div>
            </div>
            <div class="sez5"></div>
            <div class="mark" id="contactusMark"></div>
            <div class="sez6">
                <div class="titolo"><span>Contact</span></div>
                <div class="testo">
                    <span class="text">
                    Our task will be to satisfy your needs and minds with 
                        products of the highest quality along with many surprises for brilliant men. All 
                        this, only from P2W!
                    </span>
                </div>
            </div>
        </div>
        
        <div class="mark" id="whereweareMark"></div>
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
        
        <script src="Assets/js/PageNavigator.js"></script>
    </body>
</html>
