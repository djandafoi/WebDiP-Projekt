<?php
require '../izvorne_datoteke/baza.class.php';
require '../izvorne_datoteke/sesija.class.php';
require '../PHP/virtualno_vrijeme.php';

Sesija::kreirajSesiju();
$db = new Baza();
$db->spojiDB();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="hr"> 

    <head>
        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija">
        <meta name="autor" content="Dominik Janda">
        <meta name="kljucneRijeci" content="Registracija, Obrazac, Post">
        <link rel="stylesheet" href="../css/djanda.css" type="text/css"/>
        <link rel="stylesheet" href="../css/djanda_480.css" type="text/css">
        <link rel="stylesheet" href="../css/djanda_1024.css" type="text/css">
        <link rel="stylesheet" href="../css/djanda_1680.css" type="text/css">
        <link rel="stylesheet" href="../css/djanda_1920.css" type="text/css">
        <style>
            h2, h1, h3{
                color: crimson;
            }
        </style>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>        
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../PHP/djanda.js"></script>
    </head>

    <body>

        <header>
            <h1 id="reganim">Registracija</h1>
        </header>
        <br>
        <h2 style="text-align: center;" id="navigacija">Serial Keyller</h2>
        <nav class="izbornik">
            <ul  class="mobnav">
                <li class="nav_a"><a href="../index.php">Početna stranica</a></li>
                <li class="nav_a"><a href="../trgovina.php">Trgovina</a></li>              
                <li class="nav_a"><a href="prijava.php">Prijava</a></li>
                <li class="nav_a"><a href="registracija.php">Registracija</a></li>
            </ul>  
        </nav>

        <section class="sredina">
            <h2 id="obrazac_registracija">Obrazac</h2>
            <br>
            <form name="regforma" action="https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/PHP/reg_provjera.php" method="POST">              
                <div>
                    <div class="regobr">
                        
                        <label for="ime" class="labela"><b>Ime</b></label>
                        <input id="ime" type="text" placeholder="Unesi ime" name="ime" size="15" minlength="1" maxlength="25" autofocus="autofocus" required><br>                                           
                        
                        <label for="prezime" class="labela"><b>Prezime</b></label>
                        <input id="prezime" type="text" placeholder="Unesi prezime" name="prezime" size="20" minlength="1" maxlength="40" required><br>                                              
                        
                        <label for="korime" class="labela"><b>Korisničko ime</b></label>
                        <input id="korime" type="text" placeholder="Unesi korisničko ime" name="korime" minlength="6" maxlength="20" required><br>
                    
                        <label for="email" class="labela"><b>Email</b></label>
                        <input id="email" type="text" placeholder="Unesi email" name="email" required><br>                     
                        
                        <label for="lozinka" class="labela"><b>Lozinka</b></label>
                        <input id="lozinka" type="password" placeholder="Unesi lozinku" minlength="8" name="lozinka" required><br>

                        <label for="potvrdalozinke" class="labela"><b>Potvrda lozinke</b></label>
                        <input id="potvrdalozinke" type="password" placeholder="Potvrdi lozinku" name="potvrdalozinke" required><br>
                    </div>

                    <p><input type="checkbox" name="uvjet" value="prihvaćeno" required>Kreiranjem novoga računa prihavaćate <a href="#">Uvjete korištenja i pravila privatnosti</a>.</p>
                    <div style="text-align: center;">
                    <div class="g-recaptcha" data-sitekey="6LfgRKcUAAAAAOKCU0H_YrqUYz4DC5g7rvx8HmWj" style="display: inline-block;" required></div>
                    </div>
                    <input name="submit" type="submit" class="registerbtn" value="Registracija">                    
                </div>

                <div>
                    <p>Već imate račun? <a href="prijava.php">Prijava</a>.</p>
                </div>
            </form>

        </section>
        <br>     
        <br>
        <footer id="kraj">
            <hr style="border-color: crimson">
            <br>
            <address><strong>Kontakt:</strong> <a href="mailto:djanda@foi.hr">Dominik Janda</a>
            </address>
            <p>&copy; 2019 D.Janda</p>
            <p>
                <a href="http://validator.w3.org/check/referer" target="_blank">
                    <img style="border:0;"
                         src="../multimedija/HTML5.png"
                         alt="Valid CSS!" width="60"/></a>

                <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
                    <img style="border:0"
                         src="../multimedija/CSS.png"
                         alt="Valid CSS!" width="60"/></a>

            </p>
            <p><a href="../o_autoru.php">Autor</a></p>
        </footer>
    </body>
</html>
     

