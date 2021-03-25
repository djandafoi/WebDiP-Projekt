<?php
require_once '../izvorne_datoteke/baza.class.php';
$db = new baza();
$db->spojiDB();

function dodaj_u_dnevnik($korime, $vrijeme, $radnja){
    global $db;
    $unos = "insert into dnevnik values (default,'$korime','$vrijeme','$radnja')";
    $rez = $db->updateDB($unos);

}