<pre>
<?php
$cheminClass = './class/';
include_once $cheminClass.'baseDeDonnees.class.php';
include_once $cheminClass.'utilisateur.class.php';
include_once $cheminClass.'groupeUtilisateur.class.php';
include_once $cheminClass.'typePlat.class.php';
include_once $cheminClass.'platRestaurant.class.php';

/* ********************************** classe GroupeUtilisateur ********************************** */
function testClasseGroupeUtilisateur()
{
    // Création d'un nouveau groupe
    $groupe = new GroupeUtilisateur('pgm');
    
    // Ajout du groupe en base données
    if($groupe->ajouterGroupe())
        echo 'Ajout du groupe réussi ! <br />';
    else
        echo 'Echec de l\'ajout du groupe !<br />';
    
    // Affichage du groupe
    echo '####### Groupe #######<br />';
    var_dump($groupe);
    
    // Modification du groupe en base données
    $groupe->setLibelleGroupe('Noob');
    if($groupe->modifierGroupe())
        echo 'Modification du groupe réussi !<br />';
    else
        echo 'Echec de la modification du groupe !<br />';
    
    // Affichage du groupe
    echo '####### Groupe #######<br />';
    var_dump($groupe);
    
    // Suppression du groupe en base données
    if($groupe->supprimerGroupe())
        echo 'Suppression du groupe réussi !<br />';
    else
        echo 'Echec de la suppression du groupe !<br />';
    
}

/* ********************************** classe Utilisateur ********************************** */
function testClasseUtilisateur()
{
    // Création d'un nouveau groupe
    $utilisateur = new Utilisateur('Flamby', 'dsfsdf');
    
    // Ajout du groupe en base données
    if($utilisateur->ajouterUtilisateur())
        echo 'Ajout de l\'utilisateur réussi ! <br />';
    else
        echo 'Echec de l\'ajout de l\'utilisateur !<br />';
    
    // Affichage du groupe
    echo '####### Utilisateur #######<br />';
    var_dump($utilisateur);
    
    // Modification du groupe en base données
    $utilisateur->setLoginUtilisateur('Claudy');
    $utilisateur->setMdpUtilisateur('mdp');
    if($utilisateur->modifierUtilisateur())
        echo 'Modification de l\'utilisateur réussi !<br />';
    else
        echo 'Echec de la modification de l\'utilisateur !<br />';
    
    // Affichage du groupe
    echo '####### Utilisateur #######<br />';
    var_dump($utilisateur);
    
    // Suppression du groupe en base données
    if($utilisateur->supprimerUtilisateur())
        echo 'Suppression de l\'utilisateur réussi !<br />';
    else
        echo 'Echec de la suppression de l\'utilisateur !<br />';
}

/* ********************************** classe TypePlat ********************************** */
function testClasseTypePlat()
{
    // Création d'un nouveau type de plat
    $typePlat = new TypePlat('Entrée');
    
    // Ajout du type de plat en base données
    if($typePlat->ajouterTypePlat())
        echo 'Ajout du type de plat réussi ! <br />';
    else
        echo 'Echec de l\'ajout du type de plat !<br />';
    
    // Affichage du type de plat
    echo '####### Type Plat #######<br />';
    var_dump($typePlat);
    
    // Modification du type de plat en base données
    $typePlat->setLibelleTypePlat('Dessert');
    if($typePlat->modifierTypePlat())
        echo 'Modification du type de plat réussi !<br />';
    else
        echo 'Echec de la modification du type de plat !<br />';
    
    // Affichage du type de plat
    echo '####### Type Plat #######<br />';
    var_dump($typePlat);
    
    // Suppression du type de plat en base données
    if($typePlat->supprimerTypePlat())
        echo 'Suppression du type de plat réussi !<br />';
    else
        echo 'Echec de la suppression du type de plat !<br />';
}

/* ********************************** classe TypePlat ********************************** */
function testClassePlatRestaurant()
{
    // Création d'un nouveau plat
    $typePlat = new TypePlat(5);
    $plat = new PlatRestaurant('Steack - Frites', 8.5,$typePlat);
    
    // Ajout du plat en base données
    if($plat->ajouterPlat())
        echo 'Ajout du plat réussi ! <br />';
    else
        echo 'Echec de l\'ajout du plat !<br />';
    
    // Affichage du plat
    echo '####### Plat #######<br />';
    var_dump($plat);
    
    // Modification du plat
    $plat->setLibellePlat('Jambon - Frites');
    $plat->setPrixPlat(10);
    if($plat->modifierPlat())
        echo 'La modification a réussi !<br />';
    else
        echo 'Echec de la modification !<br />';
    
    // Affichage du plat
    echo '####### Plat #######<br />';
    var_dump($plat);
    
    // Suppression du plat
    if($plat->supprimerPlat())
        echo 'Suppression du plat réussi !<br />';
    else
        echo 'Echec de la suppression du plat !<br />';
    
}
//testClasseGroupeUtilisateur();
//testClasseUtilisateur();
//testClasseTypePlat();
//testClassePlatRestaurant();
?>
</pre>
