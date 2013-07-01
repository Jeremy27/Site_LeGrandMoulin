<?php
//$cheminInclude = './inc/';
$cheminClass = './class/';
include_once $cheminClass.'baseDeDonnees.class.php';


// Test de la classe Base de données
$bdd = new baseDeDonnees();
var_dump($bdd);

$tabParametres = [1];
var_dump($bdd->selection('select * from utilisateur where id = ?', $tabParametres));
?>
