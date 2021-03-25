<?php
    require("../izvorne_datoteke/baza.class.php");

    $db = new Baza();
    $db->spojiDB();
    $query = "SELECT * FROM kategorija_licence";

    $odg = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $red["naziv"] = $row[1];
            $red["idkategorija_licence"] = $row[0];            
            $odg[] = $red;
        }
    }
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odg);
?>