<?php

/**
 * Cette classe est celle qui permet de gérer la table OptionHotel
 *
 * @author Jérémy Courel
 */
class OptionHotel 
{
    private $m_idOption;
    private $m_libelleOption;
    private $m_prixOption;
    private $m_bdd;
    
    
    /**
     * Construit un nouvel objet avec les paramètres passés, si un seul paramètre est passé alors on construit un objet avec les
     * données venant de la bdd
     */
    function __construct()
    {
        $this->m_bdd = new BaseDeDonnees();
        $nbParam    = func_num_args();
        $tabParam   = func_get_args();
        
        if($nbParam == 1)
            $this->constructId($tabParam[0]);
        elseif($nbParam == 2)
        {
            if(is_string($tabParam[0]))
            {
                $this->m_libelleOption  = $tabParam[0];
                $this->m_prixOption     = $tabParam[1];
            }
            else if(is_numeric($tabParam[0]))
            {
                $this->m_libelleOption  = $tabParam[1];
                $this->m_prixOption     = $tabParam[0];
            }
        }
    }
    
    /**
     * Construit l'objet avec les données venant de la bdd 
     * @param int $idOptionHotel identifiant de l'option hotel à récupérer
     */
    function constructId($idOptionHotel)
    {
        if(is_numeric($idOptionHotel))
        {
            $requete        = 'SELECT * FROM optionHotel WHERE idOption = ?';
            $tabParametres  = array($idOptionHotel);
            $tabResultats   = $this->m_bdd->selection($requete, $tabParametres);
            
            $this->m_idOption       = $tabResultats['idOption'];
            $this->m_libelleOption  = $tabResultats['libelleOption'];
            $this->m_prixOption     = $tabResultats['prixOption'];
        }
    }
    
    /**
     * Vérifie si l'option existe déjà dans la base de données en fonction du libellé des options
     * @return boolean TRUE si l'option existe déjà, FALSE sinon
     */
    function libelleExisteDeja()
    {
        $requete        = 'SELECT * FROM OptionHotel WHERE libelleOption = ?';
        $tabParametres  = array($this->m_libelleOption);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Vérifie si l'option existe déjà dans la base de données en fonction de l'id
     * @return boolean TRUE si l'option existe déjà, FALSE sinon
     */
    function idExisteDeja()
    {
        $requete        = 'SELECT * FROM OptionHotel WHERE idOption = ?';
        $tabParametres  = array($this->m_idOption);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Ajoute une option dans la table OptionHotel a condition que cette option n'existe pas déjà
     * @return boolean TRUE si l'ajout s'est bien déroulé, FALSE sinon (FALSE si l'option existait déjà)
     */
    function ajouterOptionHotel()
    {
        if(!$this->libelleExisteDeja())
        {
            $requete        = 'INSERT INTO OptionHotel VALUES ("", ?, ?)';
            $tabParametres  = array($this->m_libelleOption, $this->m_prixOption);
            return $this->m_bdd->ajouter($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Modifie une option a condition que cellle ci existe dans la bdd
     * @return boolean TRUE si la modification s'est bien passée, FALSE sinon
     */
    function modifierOptionHotel()
    {
        if($this->idExisteDeja())
        {
            $requete        = 'UPDATE OptionHotel SET libelleOption = ?, prixOption = ? WHERE idOption = ?';
            $tabParametres  = array($this->m_libelleOption, $this->m_prixOption, $this->m_idOption);
            return $this->m_bdd->modifier($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Supprime une option si l'option existe bien
     * @return boolean TRUE si la suppression s'est bien passée, FALSE sinon
     */
    function supprimerOptionHotel()
    {
        if($this->idExisteDeja())
        {
            $requete        = 'DELETE FROM OptionHotel WHERE idOption = ?';
            $tabParametres  = array($this->m_idOption);
            return $this->m_bdd->supprimer($requete, $tabParametres);
        }
        return FALSE;
    }
}

?>
