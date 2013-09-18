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

//testClasseChambre();
//------------------------------------------------------------------------------------------------------------------------//



//----------------------------------------Vérifications de la classe TypeSejour----------------------------------------//
include_once 'class/typeSejour.class.php';

function ajoutTypeSejour($typeSejour)
{
    if($typeSejour->ajouterTypeSejour())
        echo 'Ajout : GOOD<br/>';
    else
        echo 'Ajout : PAS GOOD<br/>';
}

function modifierTypeSejour($typeSejour)
{
    $typeSejour->setLibelleType("Sejour de ouf");
    
    if($typeSejour->modifierTypeSejour())
        echo 'Modification : GOOD<br/>';
    else
        echo 'Modification : PAS GOOD<br/>';
}

function supprimerTypeSejour($typeSejour)
{
    if($typeSejour->supprimerTypeSejour())
        echo 'Suppression : GOOD<br/>';
    else
        echo 'Suppression : PAS GOOD<br/>';
}

function testClasseTypeSejour()
{
    echo '###### TEST TYPE SEJOUR ######<br/>';
    $typeSejour = new TypeSejour("Sejour de noob");
    ajoutTypeSejour($typeSejour);
    echo $typeSejour;
    modifierTypeSejour($typeSejour);
    echo $typeSejour;
    supprimerTypeSejour($typeSejour);
    echo '###### FIN DU TEST ######<br/>';
}

//testClasseTypeSejour();
//------------------------------------------------------------------------------------------------------------------------//



//----------------------------------------Vérifications de la classe PrixChambre----------------------------------------//
include_once 'class/prixChambre.class.php';

function ajoutPrixChambre($prixChambre)
{
    
    if($prixChambre->ajouterPrixChambre())
        echo 'Ajout : GOOD<br/>';
    else
        echo 'Ajout : PAS GOOD<br/>';
}

function modifierPrixChambre($prixChambre)
{
    $prixChambre->setPrix(100);
    
    if($prixChambre->modifierPrixChambre())
        echo 'Modification : GOOD<br/>';
    else
        echo 'Modification : PAS GOOD<br/>';
}

function supprimerPrixChambre($prixChambre)
{
    if($prixChambre->supprimerPrixChambre())
        echo 'Suppression : GOOD<br/>';
    else
        echo 'Suppression : PAS GOOD<br/>';
}

function testClassePrixChambre()
{
    $chambre = new Chambre("Claudy", "chambre de pervers", 15, "pas besoin", "pareil");
    $chambre->ajouterChambre();
    $typeSejour = new TypeSejour("Sejour de noob");
    $typeSejour->ajouterTypeSejour();
    
    
    echo '###### TEST PRIX CHAMBRE ######<br/>';
    $prixChambre = new PrixChambre($chambre->getIdChambre(), $typeSejour->getIdType());
    $prixChambre->setPrix(4000);
    ajoutPrixChambre($prixChambre);
    echo $prixChambre;
    modifierPrixChambre($prixChambre);
    echo $prixChambre;
    supprimerPrixChambre($prixChambre);
    echo '###### FIN DU TEST ######<br/>';
    
    $chambre->supprimerChambre();
    $typeSejour->supprimerTypeSejour();
}

//testClassePrixChambre();
//------------------------------------------------------------------------------------------------------------------------//



//----------------------------------------Vérifications de la classe ChambreOption----------------------------------------//
include_once 'class/chambreOption.class.php';

function ajoutChambreOption($chambreOption)
{
    
    if($chambreOption->ajouterChambreOption())
        echo 'Ajout : GOOD<br/>';
    else
        echo 'Ajout : PAS GOOD<br/>';
}

function supprimerChambreOption($chambreOption)
{
    if($chambreOption->supprimerChambreOption())
        echo 'Suppression : GOOD<br/>';
    else
        echo 'Suppression : PAS GOOD<br/>';
}

function testClasseChambreOption()
{
    $chambre = new Chambre("Claudy", "chambre de pervers", 15, "pas besoin", "pareil");
    $chambre->ajouterChambre();
    $optionHotel = new OptionHotel("option premium", 100);
    $optionHotel->ajouterOptionHotel();
    
    
    echo '###### TEST CHAMBRE OPTION ######<br/>';
    $chambreOption = new ChambreOption($chambre->getIdChambre(), $optionHotel->getIdOption());
    ajoutChambreOption($chambreOption);
    echo $chambreOption;
    supprimerChambreOption($chambreOption);
    echo '###### FIN DU TEST ######<br/>';
    
    $chambre->supprimerChambre();
    $optionHotel->supprimerOptionHotel();
}

//testClasseChambreOption();
//------------------------------------------------------------------------------------------------------------------------//



//----------------------------------------Vérifications de la classe Reservation----------------------------------------//
include_once 'class/reservation.class.php';

function ajoutReservation($reservation)
{
    if($reservation->ajouterReservation())
        echo 'Ajout : GOOD<br/>';
    else
        echo 'Ajout : PAS GOOD<br/>';
}

function modifierReservation($reservation)
{
    $reservation->setAdresse("changement");
    $reservation->setCodePostal("27500");
    
    if($reservation->modifierReservation())
        echo 'Modification : GOOD<br/>';
    else
        echo 'Modification : PAS GOOD<br/>';
}

function supprimerReservation($reservation)
{
    if($reservation->supprimerReservation())
        echo 'Suppression : GOOD<br/>';
    else
        echo 'Suppression : PAS GOOD<br/>';
}

function testClasseReservation()
{
    $chambre = new Chambre("Claudy", "chambre de pervers", 15, "pas besoin", "pareil");
    $chambre->ajouterChambre();
    $typeSejour = new TypeSejour("sejour de fou");
    $typeSejour->ajouterTypeSejour();
    
    
    echo '###### TEST RESERVATION ######<br/>';
    $reservation = new Reservation("Trans", "Claudy", "Faucan", "0000000000", "claudy.faucan@gmail.com", "76600", "Le Havre", "Rue des pervers", date("Y-m-d"), 15, $chambre->getIdChambre(), $typeSejour->getIdType());
    ajoutReservation($reservation);
    echo $reservation;
    modifierReservation($reservation);
    echo $reservation;
    supprimerReservation($reservation);
    echo '###### FIN DU TEST ######<br/>'; 
    
    $chambre->supprimerChambre();
    $typeSejour->supprimerTypeSejour();
}

//testClasseReservation();
//------------------------------------------------------------------------------------------------------------------------//



//----------------------------------------Vérifications de la classe ReservationOptionHotel----------------------------------------//
include_once 'class/reservationOptionHotel.class.php';

function ajoutReservationOptionHotel($reservationOptionHotel)
{
    if($reservationOptionHotel->ajouterReservationOptionHotel())
        echo 'Ajout : GOOD<br/>';
    else
        echo 'Ajout : PAS GOOD<br/>';
}

function supprimerReservationOptionHotel($reservationOptionHotel)
{
    if($reservationOptionHotel->supprimerReservationOptionHotel())
        echo 'Suppression : GOOD<br/>';
    else
        echo 'Suppression : PAS GOOD<br/>';
}

function testClasseReservationOptionHotel()
{
    $chambre = new Chambre("Claudy", "chambre de pervers", 15, "pas besoin", "pareil");
    $chambre->ajouterChambre();
    $typeSejour = new TypeSejour("sejour de fou");
    $typeSejour->ajouterTypeSejour();
    $reservation = new Reservation("Trans", "Claudy", "Faucan", "0000000000", "claudy.faucan@gmail.com", "76600", "Le Havre", "Rue des pervers", date("Y-m-d"), 15, $chambre->getIdChambre(), $typeSejour->getIdType());
    $reservation->ajouterReservation();
    $optionHotel = new OptionHotel("option premium", 100);
    $optionHotel->ajouterOptionHotel();
    
    
    echo '###### TEST CHAMBRE OPTION ######<br/>';
    $reservationOptionHotel = new ReservationOptionHotel($reservation->getIdReservation(), $optionHotel->getIdOption());
    ajoutReservationOptionHotel($reservationOptionHotel);
    echo $reservationOptionHotel;
    supprimerReservationOptionHotel($reservationOptionHotel);
    echo '###### FIN DU TEST ######<br/>';
    
    $reservation->supprimerReservation();
    $optionHotel->supprimerOptionHotel();
    $chambre->supprimerChambre();
    $typeSejour->supprimerTypeSejour();
    
    //testClasseReservationOptionHotel();
}

//------------------------------------------------------------------------------------------------------------------------//


//testClasseChambre();
//testClassePrixChambre();
//testClasseChambreOption();
//testClasseOptionHotel();
//testClasseReservation();
//testClasseReservationOptionHotel();
//testClasseTypeSejour();




//-------------------------------------------------------------------------------------------------------------------------//
$where = "";
$tabParametres = array();

$tabTypeSejour = TypeSejour::getObjetsTypeSejour($where, $tabParametres);
foreach ($tabTypeSejour as $typeSejour)
    echo $typeSejour;


$tabChambre = Chambre::getObjetsChambre();
foreach ($tabChambre as $chambre)
    echo $chambre;


//-------------------------------------------------------------------------------------------------------------------------//

?>
