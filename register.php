<html lang="it">
    <head>
        <link rel="stylesheet" href="Assets/css/loginStyle.css" type="text/css"/>
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
                <div class="navItem"><a href="ordina.php">Shop</a></div>
            </div>
            <div class="phoneNav">
                <div class="navBarMenu"></div>
            </div>
        </div>
        
        <div class="main"> 
            <div class="formContainer">
                <div class="formTitle">Register</div>
                <form class="form" action="Assets/php/register.php" method="post">
                    <span class="item text first">Name : </span><input type="text" placeholder="Name" name="nameUser" class="item first" required>
                    <span class="item text">Surname : </span><input type="text" placeholder="Surname" name="SurnameUser" class="item" required>
                    <span class="item text">Email : </span><input type="email" placeholder="Email" name="emailUser" class="item" required>
                    <span class="item text">Password : </span><input type="password" placeholder="Password" name="pwdUser" class="item" required>
                    <span class="item text">Repeat Password : </span><input type="password" placeholder="Repeat password" name="rptPwdUser" class="item" required>
                    <input type="submit" name="register-submit" value="Register" class="item last button" id="lastNavItem">
                </form>
            </div>
            
            <button class="buttonMain" onclick="location.href = 'login.php';">Login</button>
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
    </body>
</html>
