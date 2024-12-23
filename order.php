<?php
    session_name('P2W');
    session_start();
    if(!isset($_SESSION['idUser']))
        header("Location: login.php");
    include 'Assets/php/categories.php';
?>
<html lang="it">
    <head>
        <link rel="stylesheet" href="Assets/css/ordinaStyle.css" type="text/css"/>
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
                <div class="navItem"><a href="index.php">Future</a></div>
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
            <div class="page" id="page">
                <div class="titoloPage">Order now</div>
                
                <div class="contenutoPage">
                    <div class="categorie">
                        <div class="categorieTitolo">Categories</div>
                        <div class="categorieSeparatore"></div>
                        <?php
                            if(isset($_SESSION["categories"]))
                                    foreach ($_SESSION["categories"] as $categories)
                                        if($categories["avaible"] == 1)
                                            echo "<div class=\"categories\" id=" . $categories["idCategories"] . ">" . $categories["name"] ." (". $categories["numberProduct"] . ") " . "</div>";
                        ?>
                    </div>
                    <div class="ordine phone">
                        <div class="ordineTitolo">Order</div>
                        <div class="ordineSeparatore"></div>
                        <div class="prodottiOrdine"></div>
                        <div class="totale"><span class="prezzoOrdine"></span></div>
                        <div class="buttonOrdina"> <button class="button" onclick="inviaOrdine()">Order</button> </div>
                    </div>
                    <div class="prodotti"></div>
                    <div class="ordine tablet">
                        <div class="ordineTitolo">Ordine</div>
                        <div class="ordineSeparatore"></div>
                        <div class="prodottiOrdine"></div>
                        <div class="totale"><span class="prezzoOrdine"></span></div>
                        <div class="buttonOrdina"> <button class="button" onclick="inviaOrdine()">Order</button> </div>
                    </div>
                </div>
            </div>
            
            <div class="prodottoOrdina" id="windowOrdina">
                <div class="prodottoOrdinaItem Exit"><div id="exitIcon"></div></div>
                <div class="prodottoOrdinaItem Titolo"><span id="titoloOrdina"></span></div>
                <div class="prodottoOrdinaItem Foto"><img id="fotoOrdina"/></div>
                <div class="prodottoOrdinaItem Scelte"><div id="scelteOrdina"></div></div>
                <div class="prodottoOrdinaItem Button"><button id="buttonOrdina" onclick="addProdottoToOrdine();">0.00</button></div>
            </div>
        </div>
        
        <div class="footer">
            <div class="mark" id="whereweareMark"></div>
            <div class="footerItem">
            </div>
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
        <script src="Assets/js/ordinaScript.js"></script>
    </body>
</html>
