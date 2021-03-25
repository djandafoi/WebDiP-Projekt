<?php
require("./izvorne_datoteke/sesija.class.php");
Sesija::kreirajSesiju();

if (empty($_COOKIE["uvjeti"])) {
    echo "<script type='text/javascript'>confirm('Prihvaćate li uvjete korištenja koji se odnose na bilježenje podataka u kolačiće?');</script>";
    setcookie("uvjeti", "prihvaceni", time() + (86400 * 2), "/");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="hr"> 

    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Početna stranica">
        <meta name="autor" content="Dominik Janda">
        <meta name="kljucneRijeci" content="Autor, Računalo, Članci">
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
    </head>
    <body>

        <header>
            <h1 id="pocetak">Početna stranica</h1>
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
                if (isset($_SESSION["korisnik"]) and ($_SESSION["tip"]==2 or $_SESSION["tip"]==1)) {
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
            <h2 id="omeni">Dobrodošli na stranicu Serial Keyller!</h2>
            <div>
                <br><br>
                <p>Ova stranica služi kako bi pronašli softverske licence!</p>                
                <p>Započnite sa registracijom ili prijavom ako već imate račun...</p>
                <p>Zatim pronađite najpovoljnije softverske licence na internetu!</p>
                <p>Ubojite ponude donosi vam stranica Serial Keyller!</p>
            </div>
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
