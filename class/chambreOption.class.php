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
    public function __construct($idChambre, $idOption)
    {
        $this->m_chambre        = new Chambre($idChambre);
        $this->m_optionHotel    = new OptionHotel($idOption);
        $this->m_bdd            = new BaseDeDonnees();
    }
    
    /**
     * Cette méthode vérifie si l'association a déjà été créée dans la bdd
     * @return boolean TRUE si l'association existe déjà, FALSE sinon
     */
    public function existeDeja()
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
    public function ajouterChambreOption()
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
    public function supprimerChambreOption()
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
    public function getOptionHotel()
    {
        return $this->m_optionHotel;
    }
    
    /**
     * Retourne l'objet Chambre courant
     * @return Chambre l'objet pour manipuler la chambre
     */
    public function getChambre()
    {
        return $this->m_chambre;
    }
    
    /**
     * Méthode permettant de renvoyer un tableau d'objets de type ChambreOption en fonction des conditions passées en parametre 
     * @param String $where (exemple : "WHERE idOption_optionHotel=? AND idChambre_chambre=?")
     * @param tableau $tabParametres (exemple : array(1, 1))
     * @return ChambreOption[]
     */
    static function getObjetsChambreOption($where, $tabParametres)
    {
        $bdd        = new BaseDeDonnees();
        $requete    = 'SELECT * FROM chambreOption '.$where;
        $tabRes     = $bdd->selection($requete, $tabParametres);
        $tabObjets  = array();
        
        for($i=0; $i<count($tabRes); $i++)
            $tabObjets[$i] = new ChambreOption($tabRes[$i]['idOption_optionHotel'], $tabRes[$i]['idChambre_chambre']);
        
        if(empty($tabObjets))
            return NULL;
        return $tabObjets;
    }
    
    public function __toString()
    {
        $str  = '===CHAMBRE-OPTION===<br/>';
        $str .= 'ID CHAMBRE : '.$this->m_chambre->getIdChambre().' --- ';
        $str .= 'ID OPTION HOTEL : '.$this->m_optionHotel->getIdOption().'<br/>';
        $str .= '====================<br/>';
        return $str;
    }
}

?>
