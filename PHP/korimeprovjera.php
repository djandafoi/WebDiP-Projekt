<?php

require '../izvorne_datoteke/baza.class.php';

$veza = new Baza();
$veza->spojiDB();
$postoji=false;
$korime = $_GET['korime'];
$upit = "SELECT korisnicko_ime FROM korisnik WHERE " . "korisnicko_ime='{$korime}'";
$rezultat = $veza->selectDB($upit);

if (mysqli_num_rows($rezultat)) {
        while ($row = mysqli_fetch_row($rezultat)) {
            $redak["korime"] = $row[0];
            $postoji = true;
        }
    }
header("Content-Type: application/json");
echo json_encode($postoji);
$veza->zatvoriDB();