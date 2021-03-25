<?php
require("./izvorne_datoteke/sesija.class.php");
Sesija::kreirajSesiju();

?>

<html lang="hr"> 

    <head>
        <title>O autoru</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="O autoru">
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
            <h1 id="pocetak">Serial Keyller</h1>
        </header>
        <br>
        <h2 style="text-align: center;" id="navigacija">Navigacija</h2>
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

        <section class="sredina"><br><br><br>
            <h2 id="omeni">O meni</h2><br><br><br>
            <div>
                <ul style="padding: 20px;border: solid 1px;border-color: crimson; background-color: black; list-style-type:none;" class="podatci">
                    <li><strong>Osobni podatci:</strong></li>
                    <li>Dominik</li>
                    <li>Janda</li>
                    <li>djanda@foi.hr</li>
                    <li>45035/16-R</li>                   
                </ul>
                <img style="border: solid 1px;border-color: crimson;" class="podatci" src="multimedija/slika_autora.jpg" alt="MojaSlika" width="134"/>
                <p style="padding: 20px;border: solid 1px;border-color: crimson; background-color: black" class="podatci">    
                    <br>Poštovanje,
                    <br>Student sam treće godine smjera informacijski sustavi na Fakultetu organizacije i informatike.
                    <br>Na ovome fakultetu sam se susreo s mnogo kolegija, no trenutno smo na kolegiju koji se zove
                    <br>Web dizajn i programiranje. Ovdje se susrećem s mnogo zahtjevnih jezika poput jave i php, te
                    <br>stječem sve više iskustva u ovome području.<br>
                    <br>
                </p>
            </div>            
        </section>
        <br><br><br><br><br>
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