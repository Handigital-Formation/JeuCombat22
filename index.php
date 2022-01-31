<?php
require "Personnage.php";

$flo = new Personnage;
$pierre = new Personnage;

$flo->setId(1); $flo->setNom("Flo");
$pierre->setId(2); $pierre->setNom("Pierre");

echo $flo->info();
echo $pierre->info();

$flo->frapper($pierre);
echo $pierre->info();
?>
