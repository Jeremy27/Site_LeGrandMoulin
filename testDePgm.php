<?php


//----------------------------------------Vérifications de la classe OptionHotel----------------------------------------//
include_once 'class/optionHotel.class.php';

function ajoutOptionHotel($optionHotel)
{
    if($optionHotel->ajouterOptionHotel())
        echo 'Ajout : GOOD<br/>';
    else
        echo 'Ajout : PAS GOOD<br/>';
}

function modifierOptionHotel($optionHotel)
{
    $optionHotel->setLibelleOption("test de noob");
    $optionHotel->setPrixOption(4000);
    if($optionHotel->modifierOptionHotel())
        echo 'Modification : GOOD<br/>';
    else
        echo 'Modification : PAS GOOD<br/>';
}

function supprimerOption($optionHotel)
{
    if($optionHotel->supprimerOptionHotel())
        echo 'Suppression : GOOD<br/>';
    else
        echo 'Suppression : PAS GOOD<br/>';
}

function testClasseOptionHotel()
{
    echo '###### TEST OPTION HOTEL ######<br/>';
    $optionHotel = new OptionHotel("test de ouf", 100);
    ajoutOptionHotel($optionHotel);
    echo $optionHotel;
    modifierOptionHotel($optionHotel);
    echo $optionHotel;
    supprimerOption($optionHotel);
    echo '###### FIN DU TEST ######<br/>';
}

//testClasseOptionHotel();
//------------------------------------------------------------------------------------------------------------------------//




//----------------------------------------Vérifications de la classe Chambre----------------------------------------//
include_once 'class/chambre.class.php';

function ajoutChambre($chambre)
{
    if($chambre->ajouterChambre())
        echo 'Ajout : GOOD<br/>';
    else
        echo 'Ajout : PAS GOOD<br/>';
}

function modifierChambre($chambre)
{
    $chambre->setNomChambre("JC");
    $chambre->setInformationsChambre("chambre d'un dikkenek");
    $chambre->setCapaciteChambre(2);
    $chambre->setWcChambre("oui");
    $chambre->setSdbChambre("oui");
    
    if($chambre->modifierChambre())
        echo 'Modification : GOOD<br/>';
    else
        echo 'Modification : PAS GOOD<br/>';
}

function supprimerChambre($chambre)
{
    if($chambre->supprimerChambre())
        echo 'Suppression : GOOD<br/>';
    else
        echo 'Suppression : PAS GOOD<br/>';
}

function testClasseChambre()
{
    echo '###### TEST CHAMBRE ######<br/>';
    $chambre = new Chambre("Claudy", "chambre de pervers", 15, "pas besoin", "pareil");
    ajoutchambre($chambre);
    echo $chambre;
    modifierChambre($chambre);
    echo $chambre;
    supprimerChambre($chambre);
    echo '###### FIN DU TEST ######<br/>';
}

testClasseChambre();
//------------------------------------------------------------------------------------------------------------------------//
?>
