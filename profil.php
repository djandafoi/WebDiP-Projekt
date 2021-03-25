<?php
require("./izvorne_datoteke/sesija.class.php");
require ("./izvorne_datoteke/baza.class.php");
Sesija::kreirajSesiju();

$db = new Baza();
$db->spojiDB();
$aktivni = $_SESSION['korisnik'];
$query = "SELECT * FROM korisnik where korisnicko_ime='$aktivni'";
$rezultat = $db->selectDB($query);
$red = mysqli_fetch_array($rezultat);
$ime = $red["ime"];
$prezime = $red["prezime"];
$email = $red["email"];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="hr"> 

    <head>
        <title>Moderator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Moderator">
        <meta name="autor" content="Dominik Janda">
        <meta name="kljucneRijeci" content="Profil, pregled, odjava">
        <link href="css/djanda.css" rel="stylesheet" type="text/css">
        <link href="css/djanda_480.css" rel="stylesheet" type="text/css">
        <link href="css/djanda_1024.css" rel="stylesheet" type="text/css">
        <link href="css/djanda_1680.css" rel="stylesheet" type="text/css">
        <link href="css/djanda_1920.css" rel="stylesheet" type="text/css">
        <style>
            h2, h1, h3{
                color: crimson;
            }
        </style>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>        
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="PHP/djanda_trgovina.js"></script>
    </head>
    <body onload="pregled_zahtjeva('<?php echo $_SESSION['korisnik']; ?>'); dostupne_licence();">

        <header>
            <h1 id="pocetak">Moderator</h1>
        </header>
        <br>
        <h2 style="text-align: center;" id="navigacija">Serial Keyller</h2>
        <nav class="izbornik">
            <ul class="mobnav">
                <li class="nav_a"><a href="index.php">Početna stranica</a></li>
                <li class="nav_a"><a href="trgovina.php">Trgovina</a></li>
                <?php
                if (isset($_SESSION["korisnik"]) and $_SESSION["tip"]==1) {
                    echo "<li class='nav_a'><a href='administrator.php'>Admin</a></li>";
                }
                ?>
                <?php
                if (isset($_SESSION["korisnik"]) and ( $_SESSION["tip"] == 2 or $_SESSION["tip"] == 1)) {
                    echo "<li class='nav_a'><a href='moderator.php'>Mod</a></li>";
                }
                ?>
                <?php
                if (isset($_SESSION["korisnik"])) {
                    echo "<li class='nav_a'><a href='profil.php'>Moj profil</a></li><li class='nav_a'><a href='./PHP/odjava.php'>Odjavi se</a></li>";
                } else {
                    echo "<li class='nav_a'><a href='obrasci/prijava.php'>Prijava</a></li><li class='nav_a'><a href='obrasci/registracija.php'>Registracija</a></li>";
                }
                ?>
            </ul>  
        </nav>

        <section class="sredina">
            <br><br><br><br>

            <div>
                <p>Korisničko ime: <?php echo $aktivni; ?></p>
                <hr>
                <p>Ime: <?php echo $ime; ?></p>
                <p>Prezime: <?php echo $prezime; ?></p>
                <p>Email: <?php echo $email; ?></p>
            </div>
            <div>
                <h2 id="omeni">Moji zahtjevi!</h2>
            </div>
            <table id="zahtjevi" style = "width:100%; border:1px solid;" border=1></table>
            <hr>
            <select id="vracanje"></select>
            <input type="button" value="Vrati" onclick="vrati('<?php echo $_SESSION['korisnik']; ?>')">
            <hr>            
            <select id="licenca"><select>
                    <input type="button" value="Kreiraj zahtjev" onclick="trazi_zahtjev('<?php echo $aktivni; ?>')">   

                    </section>
                    <br><br><br><br><br><br><br>
                    <br>       
                    <footer id="kraj">
                        <hr style="border-color: crimson">
                        <address><strong>Kontakt:</strong> <a href="mailto:djanda@foi.hr">Dominik Janda</a>
                        </address>
                        <p>&copy; 2019 D.Janda</p>            

                        <p>
                            <a href="http://validator.w3.org/check/referer" target="_blank">
                                <img style="border:0;"
                                     src="multimedija/HTML5.png"
                                     alt="Valid CSS!" width="60"/></a>

                            <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
                                <img style="border:0"
                                     src="multimedija/CSS.png"
                                     alt="Valid CSS!" width="60"/></a>

                        </p>
                        <p><a href="./o_autoru.php">Autor</a></p>
                    </footer>
                    </body>
                    </html>
