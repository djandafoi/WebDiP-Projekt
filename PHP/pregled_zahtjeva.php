<?php
    require("../izvorne_datoteke/baza.class.php");
    require './virtualno_vrijeme.php';
    require './dnevnik.php';
    $korime = $_GET["korime"];
    dodaj_u_dnevnik($korime, $novo_vrijeme, 'Pregled zahtjeva!');
    $sad = new DateTime($novo_vrijeme);
    $db = new Baza();
    $db->spojiDB();    
    $query = "select * from korisnik_ima_licence inner join licence on idlicence=licence_idlicence inner join korisnik "
            . "where korisnik.korisnicko_ime='$korime' and korisnik.idkorisnik=korisnik_ima_licence.korisnik_idkorisnik";
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $red["naziv"] = $row[7];
            $red["kljuc"] = $row[1];            
            $red["datum"] = $row[3];
            $red["status"] = $row[2];
            $red["licence_idlicence"] = $row[5];
            $vrijemeisteka = new DateTime($red['datum']);
            $razlika = $sad->diff($vrijemeisteka);
            $ostatak= $razlika->format('%r%a');
            $red["istek"] = $ostatak;
            if($ostatak<0){
                $red["kljuc"]='istekao';
            }
            $odgovor[] = $red;
        }
    }
    
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);
