<?php
    require("../izvorne_datoteke/baza.class.php");
    $db = new Baza();
    $db->spojiDB();
    $query = "SELECT * FROM licence";
    $odgovor = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $redak["idlicence"] = $row[0]; 
            $redak["naziv"] = $row[1];
            $redak["dostupno"] = $row[5];
            $odgovor[] = $redak;
        }
    }
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);

