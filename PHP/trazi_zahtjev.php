<?php

require("../izvorne_datoteke/baza.class.php");
require './virtualno_vrijeme.php';
require './dnevnik.php';
$db = new Baza();
$db->spojiDB();
$korime = $_GET["korime"];
$licenca = $_GET["licenca"];
$odgovor = 0;
$query = "select idkorisnik from korisnik where korisnicko_ime = '$korime'";
$result = $db->selectDB($query);
$id = mysqli_fetch_array($result)[0];
$query = "select vrijedi_do from licence where idlicence = '$licenca'";
$result = $db->selectDB($query);
$vrijedi = mysqli_fetch_array($result)[0];
$query = "select dostupno from licence where idlicence = '$licenca'";
$result = $db->selectDB($query);
$dostupno = mysqli_fetch_array($result)[0];
if ($dostupno > 0) {
    $query = "insert into korisnik_ima_licence values (default,'---' ,'zahtjev','$vrijedi','$id','$licenca')";
    $result = $db->updateDB($query);
    $query = "UPDATE licence set dostupno=($dostupno-1) where idlicence = '$licenca'";
    $result = $db->updateDB($query);
    dodaj_u_dnevnik($korime, $novo_vrijeme, 'Kreiran zahtjev za licencu!');
}
$db->zatvoriDB();

$odgovor = 1;

header("Content-Type: application/json");
echo json_encode($odgovor);
