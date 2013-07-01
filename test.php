<?php
//$cheminInclude = './inc/';
$cheminClass = './class/';
include_once $cheminClass.'baseDeDonnees.class.php';


// Test de la classe Base de données
$bdd = new baseDeDonnees();

$tabParametres = array();
array_push($tabParametres, 2);
array_push($tabParametres, "claud");
$tab = $bdd->selection("select * from utilisateur", $tabParametres);


//$tabParametres2 = array();
//array_push($tabParametres2, "claudy2");
//array_push($tabParametres2, "claudy2");
//array_push($tabParametres2, 1);
//echo $bdd->modifier("insert into utilisateur values (\"\", ?, ?, ?)", $tabParametres2);


$tabParametres3 = array();
array_push($tabParametres3, 33);
echo $bdd->supprimer("delete from utilisateur where idUtilisateur = ?", $tabParametres3);


print_r($tab);


?>
