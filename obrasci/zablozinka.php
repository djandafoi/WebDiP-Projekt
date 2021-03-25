<?php
require '../izvorne_datoteke/baza.class.php';
require '../izvorne_datoteke/sesija.class.php';
require '../PHP/virtualno_vrijeme.php';
require '../PHP/dnevnik.php';

function random_str(
        $length = 8,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

if (isset($_POST['submit'])) {
    $greska = "";
    foreach ($_POST as $k => $v) {
        if (empty($v)) {
            $greska .= $k . " nije unesen ";
        }
    }if (empty($greska)) {
        $veza = new Baza();
        $veza->spojiDB();
        $autenticiran = false;
        $email = $_POST['email'];
        $upit = "SELECT *FROM korisnik WHERE " . "email='{$email}'";
        $rezultat = $veza->selectDB($upit);
        while ($red = mysqli_fetch_array($rezultat)) {
            if ($red) {
                $autenticiran = true;
                $korime=$red['korisnicko_ime'];
                $novalozinka = random_str();
                $novokriptirano = sha1($novalozinka . 'kriptirano');
                $upit = "update korisnik set lozinka='$novalozinka', kriptirano='$novokriptirano' where email='{$email}'";
                $rezultat = $veza->updateDB($upit);
            }
            if ($autenticiran) {
                $za = $email;
                $predmet = 'Nova generirana lozinka';
                $poruka = 'Generirali ste novu lozinku na stranici Serial Keyller!
                Vaša nova lozinka je:' . $novalozinka . '
                ';

                $od = "From: serialkeyller@webdip.foi\r\n" . "MIME-version:1.0\r\n" . "Content-Type:text/html; charset=utf-8\r\n";
                mail($za, $predmet, $poruka, $od);
                dodaj_u_dnevnik($korime, $novo_vrijeme, 'Poslan zahtjev sa novom lozinkom!');
                $message = 'Poslan je mail sa novom lozinkom!';
                echo "<SCRIPT type='text/javascript'>
                alert('$message');
                window.location.replace(\"https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/obrasci/prijava.php\");
                </SCRIPT>";
            }
        }
        if (!$autenticiran) {
            echo "<script type='text/javascript'>alert('Korisnik s ovim mailom nije registriran!');</script>";
        }

        $veza->zatvoriDB();
    }
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
        <title>Zaboravljena lozinka</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Zaboravljena lozinka">
        <meta name="autor" content="Dominik Janda">
        <meta name="kljucneRijeci" content="Prijava, Obrazac, lozinka">
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
    </head>

    <body>

        <header>
            <h1 id="prijanim">Zaboravljena lozinka</h1>
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
            <?php if (1 == 1) { ?>
                <h2 id="obrazac_registracija">Obrazac</h2>
            <?php } ?>
            <br>
            <div id="greske">
                
            </div>
            <form action="https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/obrasci/zablozinka.php" method="post">              
                <div>
                    <div class="regobr">

                        <label for="email" class="labela"><b>Email</b></label>
                        <input id="email" type="text" placeholder="Unesi email" name="email" required><br>

                    </div>
                    <br><br>
                    <input name="submit" type="submit" class="registerbtn" value="Generiraj novu lozinku">

                </div>               
            </form>
        </section>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
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

