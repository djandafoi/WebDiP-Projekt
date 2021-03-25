<?php

require '../izvorne_datoteke/baza.class.php';
require '../izvorne_datoteke/sesija.class.php';
require './virtualno_vrijeme.php';
require './dnevnik.php';

if (isset($_POST["submit"])) {
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $korime = $_POST["korime"];
    $email = $_POST["email"];
    $lozinka = $_POST["lozinka"];
    $potvrdalozinke = $_POST["potvrdalozinke"];
    $kljuc = "6LfgRKcUAAAAAMwP0dkcTMPHNpDuFZE4C5RqaGyY";
    $odgovor = $_POST["g-recaptcha-response"];
    $provjera = 0;
    if ($ime == "") {
        $provjera = +1;
        header("Location: ../obrasci/registracija.php?server=1");
    }
    if ($prezime == "") {
        $provjera = +1;
        header("Location: ../obrasci/registracija.php?server=2");
    }
    $test = '/^.{6,}$/';
    if (!preg_match($test, $korime)) {
        $provjera = +1;
        header("Location: ../obrasci/registracija.php?server=3");
    }
    $test2 = '/^[0-9a-zA-Z.]+[@][a-zA-Z]+[.][a-zA-Z]+$/';
    if (!preg_match($test2, $email)) {
        $provjera = +1;
        header("Location: ../obrasci/registracija.php?server=4");
    }
    $test3 = '/^.{8,}$/';
    if (!preg_match($test3, $lozinka)) {
        $provjera = +1;
        header("Location: ../obrasci/registracija.php?server=5");
    }
    if ($potvrdalozinke != $lozinka) {
        $provjera = +1;
        header("Location: ../obrasci/registracija.php?server=6");
    }
    if ($odgovor == "") {
        $provjera = +1;
        header("Location: ../obrasci/registracija.php?robot=1");
    } else {
        $potvrda = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$kljuc}&response={$odgovor}");
        $nijerobot = json_decode($potvrda);
        if ($nijerobot->success == false) {
            $provjera = +1;
            header("Location: ../obrasci/registracija.php?server=7");
        }
    }
    if ($provjera == 0) {
        $db = new baza();
        $db->spojiDB();
        $kriptirano = sha1($lozinka . 'kriptirano');
        $vrijeme = $novo_vrijeme;
        $upit = "INSERT into korisnik values (default,'$ime','$prezime','$korime','$lozinka','$kriptirano','$email','$vrijeme','3','0','0')";
        $rs = $db->updateDB($upit);        
        $za = $email;
        $predmet = 'Email aktivacija';
        $poruka = 'Uspješno ste se registrirali na stranici Serial Keyller!
               Aktivirajte račun na sljedećem linku:
               https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/PHP/aktivacija.php?email=' . $za . '
               Aktivacijski link traje 24 sata.
               ';

        $od = "From: serialkeyller@webdip.foi\r\n" . "MIME-version:1.0\r\n" . "Content-Type:text/html; charset=utf-8\r\n";
        mail($za, $predmet, $poruka, $od);
        $message = 'Uspješna registracija! Na vaš mail je poslan link za aktivaciju računa!';
        dodaj_u_dnevnik($korime, $vrijeme, 'Uspješna registracija, poslan mail za aktivaciju!');
        echo "<SCRIPT type='text/javascript'>
        alert('$message');
        window.location.replace(\"https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/obrasci/prijava.php\");
    </SCRIPT>";
    }
}


