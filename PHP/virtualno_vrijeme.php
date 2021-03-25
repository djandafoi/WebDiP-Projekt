<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$xml = simplexml_load_file("$root/WebDiP/2018_projekti/WebDiP2018x057/izvorne_datoteke/vrijeme.xml") or die("Error: Cannot create object");
$sati = $xml->broj;
$vrijeme_servera = time();
$vrijeme_sustava = $vrijeme_servera + ($sati * 60 * 60);
$novo_vrijeme = date('Y-m-d H:i:s', $vrijeme_sustava);
