<?php

session_start();

?>


<!DOCTYPE html>
<html lang="it">
    
<head>
<title>Burgerchain.IT</title>
</head>
<body>
<?php
//connessione al database 
$connessione = mysqli_connect("localhost","root","","burger");
if($connessione == False) {
  echo"Errore nella connessione al database: <br>";
  echo mysqli_connect_error();
  echo mysqli_connect_errno();
  exit;
}
?>
<div class="preloader" style="display: none;"></div>
    <nav class="navbar navbar-light bg-light">
    <div class="container-fluid"> <a class="navbar-brand" href="#">
    <a class="navbar-brand" href="menu.php">
            <img src="logo.jpg" height="100" width="500" class="d-inline-block align-bottom"> 
                
        </a>
      </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">
                    <h5 style="background-color:MediumSeaGreen; border-radius: 8px;">HOME</h5>
                </a> </li>
                <li class="nav-item"> <a class="nav-link" href="Burger-index.php">
                La nostra Missione
                </a> </li>
                <li class="nav-item"> <a class="nav-link" href="menu.php">
                Menu
                </a> </li>
                <li class="nav-item"> <a class="nav-link" href="contact.html">Contattaci</a> </li>
                <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false"> Informazioni </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="tel:+393756663517">Telefono</a></li>
                        <li><a class="dropdown-item" href="contact.html">Email</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="privacyBurgerc.html">Privacy</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false"> Pagine </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="https://www.facebook.com/Burgerchain-106615494292509/">Facebook</a></li>
                        <li>
                          <hr class="dropdown-divider">
                          <li><a class="dropdown-item" href="Login-Burgerchain-id.php">LOGIN</a></li>
                        </li>
                        <li><a class="dropdown-item" href="https://www.instagram.com/burgerchain/">INSTAGRAM</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex"> <input style="border-radius: 8px;" class="form-control mr-2" name='Cerca' value='Cerca' type="search" placeholder="Digita" aria-label="Search"> 
          
            <input style="color:red;border-width:8px;border-style:solid;border-color:green; border-radius: 8px;" class=class="btn btn-outline-primary" name='Premi' value='Premi' type="submit">
           </form>
        </div>
    </div>
</nav>
<div class="city">
      <div id="loaditem">
       <div id="loadingcon" style="text-align:center; display:none;"><img src="https://64.media.tumblr.com/b468a40070cac271b3bbd482447f5465/tumblr_p1y9cz3xce1vqc713o1_500.gifv" alt="loader" width="180" /></div>
          <div class="single_item row mb-3">
           <div class="item_img col-sm-3">
             <a href="#">
     <img src="bon.jpeg" class="img-fluid dimensione" alt="Baby Burger" heigth="100" width="100">
</a>     
    </div>
       <div class="item_details col-lg-6 col-sm-5 pl-0">
       <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <p>Gli ordini saranno confermati dopo l'avvenuto pagamento tramite satispay. Per cancellare l'ordine prego reinserire la quantita dei prodotti.</p>
         <div class="item_info col-lg-3 col-sm-4 text-center">
            <h4>TOTALE </h4>
            <a href="riepilogo.php">
                <button type="submit" name="Aggiorna" id="Aggiorna" class="btn btn-danger">  AGGIORNA </button>
                </a>    
                </div>
                </div>
                <?php
                
                if(!isset($_POST['Aggiorna'])){
                  session_unset();
                  }
                  ?>
        <div>
<a href="menu.php">

    <button type="submit" name="Back" id="Back" class="btn btn-danger">TORNA AL MENU</button>  
</a>

<a href="checkout.html">
    <button type="submit" name="Ordina" id="Ordina" class="btn btn-success">CHECKOUT</button>  
</a>
</div>
</body>


</html>