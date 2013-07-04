<pre>
<?php
$cheminClass = './class/';
include_once $cheminClass.'baseDeDonnees.class.php';
include_once $cheminClass.'utilisateur.class.php';
include_once $cheminClass.'groupeUtilisateur.class.php';


// Test de la classe Base de données
function testClasseBaseDeDonnes()
{
    $bdd = new baseDeDonnees();
    
    // Test de la selection
    $tabParametres = array();
    array_push($tabParametres, 2);
    array_push($tabParametres, "claud");
    $tab = $bdd->selection("select * from utilisateur", $tabParametres);


    //$tabParametres2 = array();
    //array_push($tabParametres2, "claudy2");
    //array_push($tabParametres2, "claudy2");
    //array_push($tabParametres2, 1);
    //echo $bdd->modifier("insert into utilisateur values (\"\", ?, ?, ?)", $tabParametres2);


// Moi
// ChambreOption
// PlatFormuleRestaurant

$tabParametres3 = array();
array_push($tabParametres3, 33);
echo $bdd->supprimer("delete from utilisateur where idUtilisateur = ?", $tabParametres3);


    print_r($tab);
}

//$tab = [1];
//
//if($tab)
//{
//    echo 'jérémy est un noob-boy !';
//}

/* ------------------------------------------------- Fonction test classe Utilisateur ------------------------------------------------- */
function testClasseUtilisateur()
{
//    // Test de la création des utilisateurs
//    $utilisateur1 = new Utilisateur(1);
//    print_r($utilisateur1);
//    $utilisateur2 = new Utilisateur('mathieu', 'mdp');
//    print_r($utilisateur2);
//    
//    // Ajout de l'utilisateur dans la base de données
//    $utilisateur2->ajouterUtilisateur();
//    
//    // Modification de l'utilisateur dans la base de données
//    $utilisateur1->setLoginUtilisateur('Mathieu');
//    $utilisateur1->modifierUtilisateur();
//    
//    // Suppression de l'utilisateur
//    $utilisateur1->supprimerUtilisateur();
    
    
}
/* ------------------------------------------------- Fonction test classe GroupeUtilisateur ------------------------------------------------- */
function testClasseGroupeUtilisateur()
{
    // Test de la création des groupes
    $groupe1 = new GroupeUtilisateur(1);
    print_r($groupe1);
    $groupe2 = new GroupeUtilisateur('modérateur');
    print_r($groupe2);
}


/* ------------------------------------------------- Appel des fonctions de test ------------------------------------------------- */
// Appel des fonctions de test
echo 'Test de la classe utilisateur: <br />';
testClasseUtilisateur();
echo '<br />';
//echo 'Test de la classe groupeUtilisateur: <br />';
//testClasseGroupeUtilisateur();
//echo '<br />';
?>
</pre>
