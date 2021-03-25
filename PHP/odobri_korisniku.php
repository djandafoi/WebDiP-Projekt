<?php

require("../izvorne_datoteke/baza.class.php");
require("../izvorne_datoteke/sesija.class.php");
require './virtualno_vrijeme.php';
require './dnevnik.php';
Sesija::kreirajSesiju();

function random_str(
        $length = 10,
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
$db = new Baza();
$db->spojiDB();
$idvlasnistva = $_GET["idvlasnistva"];
$korime = $_SESSION['korisnik'];
$odgovor = 0;
$kljuc= random_str();
$query = "select licence_idlicence from korisnik_ima_licence where idvlasnistva = '$idvlasnistva'";
$result = $db->selectDB($query);
$id = mysqli_fetch_array($result)[0];

$query = "UPDATE korisnik_ima_licence set status='aktivan', kljuc='$kljuc' where idvlasnistva = '$idvlasnistva'";
$result = $db->updateDB($query);
dodaj_u_dnevnik($korime, $novo_vrijeme, 'Odobren korisniku zahtjev za licencu!');

$db->zatvoriDB();

$odgovor = 1;

header("Content-Type: application/json");
echo json_encode($odgovor);
