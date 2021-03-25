<?php

require("../izvorne_datoteke/baza.class.php");

$db = new Baza();
$db->spojiDB();

$query = "SELECT * FROM korisnik where blokiran='3'";
    $odg = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $red["idkorisnik"] = $row[0];
            $red["ime"] = $row[1];
            $red["prezime"] = $row[2];
            $red["korisnicko_ime"] = $row[3];
            $red["email"] = $row[6];
            $red["blokiran"] = "Zaključan";            
            $odgovor[] = $red;
        }
    }
$db->zatvoriDB();


header("Content-Type: application/json");
echo json_encode($odgovor);