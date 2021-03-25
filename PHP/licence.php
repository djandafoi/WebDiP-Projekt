<?php
    require("../izvorne_datoteke/baza.class.php");

    $db = new Baza();
    $db->spojiDB();
    $naziv= "";
    $query = "SELECT * FROM licence inner join kategorija_licence on idkategorija_licence=kategorija_licence_idkategorija_licence";

    $odg = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $red["idlicence"] = $row[0];
            $red["naziv"] = $row[1];
            $red["opis"] = $row[2];
            $red["slika"] = $row[3];
            $red["kategorija_licence_idkategorija_licence"] = $row[4];
            $red["kategorija"] = $row[8];
            $odg[] = $red;
        }
    }
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odg);
?>
