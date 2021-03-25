<?php

require("../izvorne_datoteke/baza.class.php");
require("../izvorne_datoteke/sesija.class.php");
require './virtualno_vrijeme.php';
require './dnevnik.php';
$sad = new DateTime($novo_vrijeme);
$db = new Baza();
$db->spojiDB();
$query = "select * from korisnik_ima_licence inner join licence on idlicence=licence_idlicence inner join korisnik "
        . "where korisnik.idkorisnik=korisnik_ima_licence.korisnik_idkorisnik";
$result = $db->selectDB($query);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_row($result)) {
        $red["idvlasnistva"] = $row[0];
        $red["naziv"] = $row[7];
        $red["kljuc"] = $row[1];
        $red["datum"] = $row[3];
        $red["status"] = $row[2];
        $red["korisnik"] = $row[16];
        $red["licence_idlicence"] = $row[5];
        if($red["status"]=="zahtjev"){
        $odgovor[] = $red;
        }
    }
}

$db->zatvoriDB();
header("Content-Type: application/json");
echo json_encode($odgovor);
