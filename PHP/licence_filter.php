<?php
    require("../izvorne_datoteke/baza.class.php");
    require("../izvorne_datoteke/sesija.class.php");
    require './virtualno_vrijeme.php';
    require './dnevnik.php';
    Sesija::kreirajSesiju();
    if(empty($_SESSION['korisnik'])){
        dodaj_u_dnevnik('Gost', $novo_vrijeme, 'Pretraga proizvoda po filteru!');
    }else{
    dodaj_u_dnevnik($_SESSION['korisnik'], $novo_vrijeme, 'Pretraga proizvoda po filteru!');
    }
    $filter=$_GET["filter"];
    $db = new Baza();
    $db->spojiDB();
    $naziv= "";
    $query = "SELECT * FROM licence inner join kategorija_licence on idkategorija_licence=kategorija_licence_idkategorija_licence where licence.kategorija_licence_idkategorija_licence='$filter'";

    $odg = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $red["idlicence"] = $row[0];
            $red["naziv"] = $row[1];
            $red["opis"] = $row[2];
            $red["slika"] = $row[3];
            $red["kategorija"] = $row[8];
            $odg[] = $red;
        }
    }
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odg);
?>
