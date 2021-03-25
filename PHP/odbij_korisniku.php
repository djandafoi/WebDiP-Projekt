<?php

require("../izvorne_datoteke/baza.class.php");
require("../izvorne_datoteke/sesija.class.php");
require './virtualno_vrijeme.php';
require './dnevnik.php';
Sesija::kreirajSesiju();

$db = new Baza();
$db->spojiDB();
$idvlasnistva = $_GET["idvlasnistva"];
$korime = $_SESSION['korisnik'];
$odgovor = 0;

$query = "select licence_idlicence from korisnik_ima_licence where idvlasnistva = '$idvlasnistva'";
$result = $db->selectDB($query);
$id = mysqli_fetch_array($result)[0];
$query = "select dostupno from licence where idlicence = '$id'";
$result = $db->selectDB($query);
$dostupno = mysqli_fetch_array($result)[0];

$query = "UPDATE korisnik_ima_licence set status='odbijeno', kljuc='odbijeno' where idvlasnistva = '$idvlasnistva'";
$result = $db->updateDB($query);
$query = "UPDATE licence set dostupno=($dostupno+1) where idlicence = '$id'";
$result = $db->updateDB($query);
dodaj_u_dnevnik($korime, $novo_vrijeme, 'Odbijen korisniku zahtjev za licencu!');

$db->zatvoriDB();

$odgovor = 1;

header("Content-Type: application/json");
echo json_encode($odgovor);

