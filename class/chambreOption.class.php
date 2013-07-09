<?php
/**
 * Cette classe est celle qui permet de gérer la table chambreOption
 *
 * @author Jérémy Courel
 */
class ChambreOption 
{
    private $m_optionHotel;
    private $m_chambre;
    private $m_bdd;
    
    /**
     * Prend en paramètre l'id de la Chambre et l'id de l'OptionHotel pour créer une liaison entre ces deux éléments
     * @param int $idChambre 
     * @param int $idOption
     */
    function __construct($idChambre, $idOption)
    {
        $this->m_chambre        = new Chambre($idChambre);
        $this->m_optionHotel    = new OptionHotel($idOption);
        $this->m_bdd            = new BaseDeDonnees();
    }
    
    /**
     * Cette méthode vérifie si l'association a déjà été créée dans la bdd
     * @return boolean TRUE si l'association existe déjà, FALSE sinon
     */
    function existeDeja()
    {
        $requete        = 'SELECT * FROM chambreOption WHERE idOption_optionHotel = ? AND idChambre_chambre = ?';
        $tabParametres  = array($this->m_optionHotel->getIdOption(), $this->m_chambre->getIdChambre());
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Cette méthode ajoute une entrée Option/Chambre dans la bdd
     * @return boolean TRUE si la requête s'est correctement déroulée, FALSE sinon (FALSE si l'association existait déjà)
     */
    function ajouterChambreOption()
    {
        if(!$this->existeDeja())
        {
            $requete        = 'INSERT INTO chambreOption VALUES(?, ?)';
            $tabParametres  = array($this->m_optionHotel->getIdOption(), $this->m_chambre->getIdChambre());
            return $this->m_bdd->ajouter($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Cette méthode supprime une entrée Option/Chambre dans la bdd (table chambreOption)
     * @return boolean TRUE si la requête s'est correctement déroulée, FALSE sinon (FALSE si l'association n'existait pas)
     */
    function supprimerChambreOption()
    {
        if($this->existeDeja())
        {
            $requete        = 'DELETE FROM chambreOption WHERE idOption_optionHotel = ? AND idChambre_chambre = ?';
            $tabParametres  = array($this->m_optionHotel->getIdOption(), $this->m_chambre->getIdChambre());
            return $this->m_bdd->supprimer($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Retourne l'objet OptionHotel courant
     * @return OptionHotel l'objet courant pour manipuler l'optionHotel
     */
    function getOptionHotel()
    {
        return $this->m_optionHotel;
    }
    
    /**
     * Retourne l'objet Chambre courant
     * @return Chambre l'objet pour manipuler la chambre
     */
    function getChambre()
    {
        return $this->m_chambre;
    }
    
    function __toString()
    {
        $str = '<dd>CHAMBRE : '.$this->m_chambre.'<br/>';
        $str .= 'OPTION HOTEL : '.$this->m_optionHotel.'</dd><br/>';
        return $str;
    }
}

?>
