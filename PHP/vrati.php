<?php

require("../izvorne_datoteke/baza.class.php");
require './virtualno_vrijeme.php';
require './dnevnik.php';


$db = new Baza();
$db->spojiDB();
$korime = $_POST["korime"];
dodaj_u_dnevnik($korime, $novo_vrijeme, 'vracanje kljuca!');
$idlicence = $_POST["idlicence"];
$query = "select dostupno from licence where idlicence = '$idlicence'";
$result = $db->selectDB($query);
$dostupno = mysqli_fetch_array($result)[0];
$dostupno = $dostupno+1;
$query = "update korisnik_ima_licence set status = 'vraceno', kljuc = 'vraceno' where korisnik_ima_licence.licence_idlicence='$idlicence' and korisnik_ima_licence.korisnik_idkorisnik=(select korisnik.idkorisnik from korisnik where korisnik.korisnicko_ime = '$korime')";
$result = $db->updateDB($query);
$query = "update licence set dostupno = $dostupno where idlicence='$idlicence'";
$result = $db->updateDB($query);
$odgovor = 0;
if (mysqli_num_rows($result)) {
    $odgovor = 1;
}

$db->zatvoriDB();
header("Content-Type: application/json");
echo json_encode($odgovor);

