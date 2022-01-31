<?php
require "Personnage.php";

// $flo = new Personnage;
// $flo->setId(1);
// $flo->setNom("Flo");
$donnees_flo = array(
    'id' => 1,
    'nom' => "Flo",
    'degats' => 25
);

$flo = new Personnage($donnees_flo);

$donnees_pierre = array(
    'id' => 2,
    'nom' => "Pierre",
    'degats' => 25
);
$pierre = new Personnage($donnees_pierre);

echo $flo->info();
echo $pierre->info();

$flo->frapper($pierre);
echo $pierre->info();
?>
