<?php

require("../izvorne_datoteke/baza.class.php");
require("../izvorne_datoteke/sesija.class.php");
require './virtualno_vrijeme.php';
require './dnevnik.php';
Sesija::kreirajSesiju();

$db = new Baza();
$db->spojiDB();
$korisnik = $_GET["korisnik"];
$korime = $_SESSION['korisnik'];
$odgovor = 0;
$query = "UPDATE korisnik set blokiran='3' where korisnicko_ime = '$korisnik'";
$result = $db->updateDB($query);
dodaj_u_dnevnik($korime, $novo_vrijeme, 'Korisnik je zaključan!');

$db->zatvoriDB();

$odgovor = 1;

header("Content-Type: application/json");
echo json_encode($odgovor);
