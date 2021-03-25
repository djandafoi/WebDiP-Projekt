<?php

require '../izvorne_datoteke/baza.class.php';
require './virtualno_vrijeme.php';
require './dnevnik.php';
$db = new baza();
$db->spojiDB();
$email = $_GET["email"];
$upit = "SELECT *FROM korisnik WHERE email='$email'";
        $rezultat = $db->selectDB($upit);
        while ($red = mysqli_fetch_array($rezultat)) {
            if ($red) {
                $vrijemereg = new DateTime($red['datum_vrijeme_uvjeta']);                
                $korime = $red['korisnicko_ime'];
            }
        }
$vrijemereg->modify("+7 hours");
$reg = $vrijemereg->format('Y-m-d H:i:s');
$sad = $novo_vrijeme;
if ($reg > $sad) {
    $upit = "UPDATE korisnik set aktiviran = 1 where email = '$_GET[email]' ";
    $rez = $db->updateDB($upit);
    dodaj_u_dnevnik($korime, $novo_vrijeme, 'Uspješna aktivacija računa!');
    $message = 'Uspješno ste aktivirali račun!';
    echo "<SCRIPT type='text/javascript'>
        alert('$message');
        window.location.replace(\"https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/obrasci/prijava.php\");
    </SCRIPT>";
} else {
    $message = 'Prošlo je 24 sata, link za aktivaciju je istekao!';
    echo "<SCRIPT type='text/javascript'>
        alert('$message');
        window.location.replace(\"https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/obrasci/prijava.php\");
    </SCRIPT>";
}
