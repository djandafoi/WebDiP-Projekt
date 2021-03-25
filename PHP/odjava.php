<?php

require("../izvorne_datoteke/sesija.class.php");
require './virtualno_vrijeme.php';
require './dnevnik.php';

Sesija::kreirajSesiju();
dodaj_u_dnevnik($_SESSION['korisnik'], $novo_vrijeme, 'Uspješna odjava!');
Sesija::obrisiSesiju();
$message = 'Uspješna odjava!';
echo "<SCRIPT type='text/javascript'>
                alert('$message');
                window.location.replace(\"https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x057/index.php\");
                </SCRIPT>";



