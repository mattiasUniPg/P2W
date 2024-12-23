<?php
    session_name('P2W');
    session_start();
    if(isset($_SESSION['idUtente']))
        include 'Assets/php/ordini.php'; 
    else
        header("Location: login.php");
?>
<html lang="it">
    <head>
        <link rel="stylesheet" href="Assets/css/accountStyle.css" type="text/css"/>
        <script src="Assets/js/jquery-3.6.0.js"></script>
        <title>P2W
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="navBar">
            <a href=""><div class="navBarlogo"></div></a>
            <div class="tabletNav">
                <div class="navItem"><a href="index.php">Inventory</a></div>
                <div class="navItem"><a href="index.php">Our Mission</a></div>
                <div class="navItem"><a href="index.php">Contact</a></div>
                <div class="navItem"><a href="index.php">Future</a></div>
                <div class="navItem"><a href="ordina.php">Shop</a></div>
                <?php
                    if(isset($_SESSION['idUtente']))
                        echo "<div class='navItem image navBarLastitem' onclick=\"location.href = 'account.php';\"><div id='accountIcon'></div></div>";
                ?> 
            </div>
            <div class="phoneNav">
                <div class="navBarMenu"></div>
            </div>
        </div>

        <div class="main">
            <div class="titoloPage">Profile</div>
            
            <?php
                if(isset($_SESSION['idUtente']))
                {
                    echo "<div class=\"nomeUtente\">" . $_SESSION['nomeUtente'] . " " . $_SESSION['cognomeUtente'] . "</div>";
                    echo "<div class=\"emailUtente\">Email: " . $_SESSION['emailUtente'] . "</div>";
                    echo "<div class=\"telefonoUtente\">Telefono: " . $_SESSION['telefonoUtente'] . "</div>";
                    echo "<div class=\"cambiaPassword\"><button class=\"button\" onclick=\"inviaRichiesta();\">Cambia Password</button></div>";
                    echo "<div class=\"esciUtente\"><button class=\"button\" onclick=\"location.href = 'Assets/php/logout.php';\">Logout</button></div>";
                    
                    echo "<div class=\"ordiniBox\">";
                    echo "<div class=\"ordiniUtente\">Ordini</div>";
                    
                    if(isset($_SESSION["ordini"]) && count($_SESSION["ordini"]) > 0)
                    {
                        $idOrdine = $_SESSION["ordini"][0]["idOrdine"] + 1;
                        $index = 1;

                        foreach ($_SESSION["ordini"] as $ordine) 
                        {
                            if($ordine["idOrdine"] != $idOrdine)
                            {
                                if($index == 1)
                                    echo "<div class=\"ordineBox\">";
                                else
                                {
                                    echo "</div>";
                                    echo "<div class=\"ordineBox\">";
                                }

                                echo "<div class=\"ordineBoxItem titolo\">Ordine n." . $index . ", stato: " . $ordine["stato"] . "</div>";
                                $index++;
                                $idOrdine = $ordine["idOrdine"];
                            }

                            echo "<div class=\"ordineBoxItem\">-" . $ordine["nome"] . " x" . $ordine["quantità"] . "</div>";
                            if($ordine["dettagli"] != "")
                                echo "<div class=\"ordineBoxItem\">Dettagli: " . $ordine["dettagli"] . "</div>";
                        }
                    }
                    else
                        echo "<div class=\"noOrdini\">Nesun Ordine...</div>";
                    
                    echo "</div>";
                }
            ?>
        </div>
        
        <div class="footer">
            <div class="footerItem">
            </div>
            <div class="footerItem">
                <div class="footerItemTitle">
                    <span class="footerItemTitleTxt">Contact</span>
                </div>
                <div class="footerItemText">
                    <span class="footerItemTextTxt">Email: </span>
                    <span class="footerItemTextTxt"></span>
                    <div class="footerItemTextTxt linksFooter">
                        <a href=#><div id="facebookLogoFooter"></div></a>
                        <a href=#><div id="instagramLogoFooter"></div></a>
                        <a href=#><div id="whatsappLogoFooter"></div></a>
                    </div>
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
        
        <script src="Assets/js/accountScript.js"></script>
    </body>
</html>
