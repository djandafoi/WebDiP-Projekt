<?php
    require("../izvorne_datoteke/baza.class.php");
    $db = new Baza();
    $db->spojiDB();
    $query = "SELECT * FROM korisnik";
    $odgovor = array();
    $result = $db->selectDB($query);
        while ($row = mysqli_fetch_row($result)) {
            $redak["idkorisnik"] = $row[0]; 
            $redak["ime"] = $row[1];
            $redak["prezime"] = $row[2];
            $redak["korisnicko_ime"] = $row[3];
            $redak["lozinka"] = $row[4];
            $redak["kriptirano"] = $row[5];
            $redak["email"] = $row[6];
            $odgovor[] = $redak;
        }

    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);
?>