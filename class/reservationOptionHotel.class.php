<?php

/**
 * Description of reservationOptionHotel
 *
 * @author jeremy
 */
class ReservationOptionHotel 
{
    private $m_reservation;
    private $m_optionHotel;
    private $m_bdd;
    
    /**
     * Prend en paramètre l'id de la reservation et l'id de l'OptionHotel pour créer une liaison entre ces deux éléments
     * @param int $idReservation 
     * @param int $idOption
     */
    function __construct($idReservation, $idOption)
    {
        $this->m_reservation    = new Reservation($idReservation);
        $this->m_optionHotel    = new OptionHotel($idOption);
        $this->m_bdd            = new BaseDeDonnees();
    }
    
    /**
     * Cette méthode vérifie si l'association a déjà été créée dans la bdd
     * @return boolean TRUE si l'association existe déjà, FALSE sinon
     */
    function existeDeja()
    {
        $requete        = 'SELECT * FROM reservationOptionHotel WHERE idOption_optionHotel = ? AND idReservation_reservation = ?';
        $tabParametres  = array($this->m_optionHotel->getIdOption(), $this->m_reservation->getIdReservation());
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Cette méthode ajoute une entrée OptionHotel/Reservation dans la bdd
     * @return boolean TRUE si la requête s'est correctement déroulée, FALSE sinon (FALSE si l'association existait déjà)
     */
    function ajouterReservationOptionHotel()
    {
        if(!$this->existeDeja())
        {
            $requete        = 'INSERT INTO reservationOptionHotel VALUES(?, ?)';
            $tabParametres  = array($this->m_reservation->getIdReservation(), $this->m_optionHotel->getIdOption());
            return $this->m_bdd->ajouter($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Cette méthode supprime une entrée OptionHotel/Reservation dans la bdd (table reservationOptionHotel)
     * @return boolean TRUE si la requête s'est correctement déroulée, FALSE sinon (FALSE si l'association n'existait pas)
     */
    function supprimerReservationOptionHotel()
    {
        if($this->existeDeja())
        {
            $requete        = 'DELETE FROM reservationOptionHotel WHERE idOption_optionHotel = ? AND idReservation_reservation = ?';
            $tabParametres  = array($this->m_optionHotel->getIdOption(), $this->m_reservation->getIdReservation());
            return $this->m_bdd->supprimer($requete, $tabParametres);
        }
        return FALSE;
    }
    
    function getOptionHotel()
    {
        return $this->m_optionHotel;
    }
    
    function getReservation()
    {
        return $this->m_reservation;
    }
    
    function __toString()
    {
        $str  = '===RESERVATION-OPTION_HOTEL===<br/>';
        $str .= 'ID RESERVATION : '.$this->m_reservation->getIdReservation().' --- ';
        $str .= 'ID OPTION HOTEL : '.$this->m_optionHotel->getIdOption().'<br/>';
        $str .= '==============================<br/>';
        return $str;
    }
}

?>
