<?php
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if ($url != "https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/obrasci/prijava.php") {
    header("Location: https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/obrasci/prijava.php");
}
require '../izvorne_datoteke/baza.class.php';
require '../izvorne_datoteke/sesija.class.php';
require '../PHP/virtualno_vrijeme.php';
require '../PHP/dnevnik.php';

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
        $korime = $_POST['korime'];
        $lozinka = $_POST['lozinka'];
        $kriptirano = sha1($lozinka . 'kriptirano');
        $upit = "SELECT *FROM korisnik WHERE korisnicko_ime='{$korime}'";
        $rezultat = $veza->selectDB($upit);
        while ($red = mysqli_fetch_array($rezultat)) {
            if ($red) {
                $autenticiran = true;
                $aktiviran = $red['aktiviran'];
                $tip = $red['Uloge_idUloge'];
                $blokiran = $red['blokiran'];
                $pass= $red['lozinka'];
                $kript = $red['kriptirano'];
            }

            if ($autenticiran and $aktiviran == 1 and $lozinka == $pass and $kriptirano == $kript and ! ($blokiran == 3)) {
                Sesija::kreirajSesiju();
                $_SESSION['korisnik']=$korime;
                $_SESSION['tip']=$tip;
                Sesija::kreirajKorisnika($korime, $tip);
                if (isset($_POST['zapamti'])) {
                    setcookie("korisnik", $korime, time()+30000);
                }
                $blokiran = 0;
                $upit = "update korisnik set blokiran='$blokiran' where korisnicko_ime='{$korime}'";
                $rezultat = $veza->updateDB($upit);
                dodaj_u_dnevnik($korime, $novo_vrijeme, 'Uspješna prijava');
                $message = 'Uspješna prijava!';
                echo "<SCRIPT type='text/javascript'>
                alert('$message');
                window.location.replace(\"https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/index.php\");
                </SCRIPT>";
            }
            if ($autenticiran and ! ($aktiviran == 1) and ! ($blokiran == 3) and $lozinka == $pass and $kriptirano == $kript) {
                echo "<script type='text/javascript'>alert('Vaš račun nije aktiviran, provjerite mail!');</script>";
            }
            if ($autenticiran and $blokiran == 3) {
                dodaj_u_dnevnik($korime, $novo_vrijeme, 'Račun je blokiran!');
                echo "<script type='text/javascript'>alert('Vaš račun je zaključan, kontaktirajte admina!');</script>";
            }
            if ($autenticiran  and ! ($lozinka == $pass) and ! ($kriptirano == $kript) and ! ($blokiran == 3)) {
                $blokiran = $blokiran + 1;
                $upit = "update korisnik set blokiran='$blokiran' where korisnicko_ime='{$korime}'";
                $rezultat = $veza->updateDB($upit);
                dodaj_u_dnevnik($korime, $novo_vrijeme, 'Neuspješna prijava');
                echo "<script type='text/javascript'>alert('Neuspješna prijava!');</script>";
            }
        }
        if (!$autenticiran) {
            echo "<script type='text/javascript'>alert('Korisnik ne postoji!');</script>";
        }

        $veza->zatvoriDB();
    }
}
$zapamti = "";
if (!empty($_COOKIE["korisnik"])) {
    $zapamti = $_COOKIE["korisnik"];
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
        <title>Prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Prijava">
        <meta name="autor" content="Dominik Janda">
        <meta name="kljucneRijeci" content="Prijava, Obrazac, Zapamti">
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
            <h1 id="prijanim">Prijava</h1>
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
            <div id="greske">
                <?php
                if (isset($greska)) {
                    echo $greska;
                }
                ?>
            </div>
            <form action="https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/obrasci/prijava.php" method="post">              
                <div>
                    <div class="regobr">

                        <label for="korime" class="labela"><b>Korisničko ime</b></label>
                        <input id="korime" type="text" placeholder="Unesi korisničko ime" minlength="1" maxlength="20" autofocus="autofocus" name="korime" value="<?php echo $zapamti ?>" required><br>

                        <label for="lozinka" class="labela"><b>Lozinka</b></label>
                        <input id="lozinka" type="password" placeholder="Unesi lozinku" name="lozinka" minlength="1" required>

                    </div>

                    <p><input type="checkbox" name="zapamti" checked="checked" >Zapamti me!</p>


                    <input name="submit" type="submit" class="registerbtn" value="Prijava">
                </div>
                <div>
                    <p>Nemate račun? <a href="registracija.php">Registriraj se</a>.</p>
                    <p>Zaboravljena lozinka? <a href="zablozinka.php">Zaboravio sam</a>.</p>
                </div>                
            </form>
        </section>
        <br><br><br><br><br><br>
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