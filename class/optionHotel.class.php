<?php

include_once 'baseDeDonnees.class.php';

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
     * Fonctionnement :
     * new OptionHotel(idOptionHotel)
     * new OptionHotel(libelleOption, prixOption)
     */
    function __construct()
    {
        $this->m_bdd = new BaseDeDonnees();
        $nbParam    = func_num_args();
        $tabParam   = func_get_args();
        
        if($nbParam == 1 && is_numeric($tabParam[0]))
            $this->constructId($tabParam[0]);
        elseif($nbParam == 2)
        {
            $this->m_libelleOption  = $tabParam[0];
            $this->m_prixOption     = $tabParam[1];
        }
    }
    
    /**
     * Construit l'objet avec les données venant de la bdd 
     * @param int $idOptionHotel identifiant de l'option hotel à récupérer
     */
    function constructId($idOptionHotel)
    {
        $requete        = 'SELECT * FROM optionHotel WHERE idOption = ?';
        $tabParametres  = array($idOptionHotel);
        $tabResultats   = $this->m_bdd->selection($requete, $tabParametres);

        $this->m_idOption       = $tabResultats[0]['idOption'];
        $this->m_libelleOption  = $tabResultats[0]['libelleOption'];
        $this->m_prixOption     = $tabResultats[0]['prixOption'];
    }
    
    /**
     * Vérifie si l'option existe déjà dans la base de données en fonction du libellé des options
     * @return boolean TRUE si l'option existe déjà, FALSE sinon
     */
    function libelleExisteDeja()
    {
        $requete        = 'SELECT * FROM optionHotel WHERE libelleOption = ?';
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
        $requete        = 'SELECT * FROM optionHotel WHERE idOption = ?';
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
            $requete        = 'INSERT INTO optionHotel VALUES ("", ?, ?)';
            $tabParametres  = array($this->m_libelleOption, $this->m_prixOption);
            $valRetour      = $this->m_bdd->ajouter($requete, $tabParametres);
            if($valRetour != FALSE)
                $this->initialiserId();
            return $valRetour;
        }
        return FALSE;
    }
    
    /**
     * Modifie une option a condition que cellle ci existe dans la bdd
     * @return boolean TRUE si la modification s'est bien passée, FALSE sinon
     */
    function modifierOptionHotel()
    {
        $this->initialiserId();
        if($this->idExisteDeja())
        {
            $requete        = 'UPDATE optionHotel SET libelleOption = ?, prixOption = ? WHERE idOption = ?';
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
        $this->initialiserId();
        if($this->idExisteDeja())
        {
            $requete        = 'DELETE FROM optionHotel WHERE idOption = ?';
            $tabParametres  = array($this->m_idOption);
            return $this->m_bdd->supprimer($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Fonction qui initialise l'idOption (elle sert quand on effectue un ajout et qu'on a toujours pas l'id de l'option)
     */
    function initialiserId()
    {
        if(empty($this->m_idOption))
        {
            $requete            = 'SELECT idOption FROM optionHotel WHERE libelleOption=? AND prixOption=?';
            $tabParametres      = array($this->m_libelleOption, $this->m_prixOption);
            $tabResultat        = $this->m_bdd->selection($requete, $tabParametres);
            $this->m_idOption   = $tabResultat[0]['idOption']; 
        }
    }
    
    /**
     * Retourne l'id de l'option courant, si celui-ci n'etait pas initialisé alors on récupère l'id dans la bdd
     * @return int l'id de l'option 
     */
    function getIdOption()
    {
        $this->initialiserId();
        return $this->m_idOption;
    }
    
    function getLibelleOption()
    {
        return $this->m_libelleOption;
    }
    
    function getPrixOption()
    {
        return $this->m_prixOption;
    }
    
    function setLibelleOption($libelleOption)
    {
        $ancienLibelle = $this->m_libelleOption;
        $this->m_libelleOption = $libelleOption;
        if($this->libelleExisteDeja())
            $this->m_libelleOption = $ancienLibelle;
    }
    
    function setPrixOption($prixOption)
    {
        $this->m_prixOption = $prixOption;
    }
    
    function __toString()
    {
        $str = '<dd>ID : '.$this->getIdOption().' --- ';
        $str .= 'Libelle : '.$this->getLibelleOption().' --- ';
        $str .= 'Prix : '.$this->getPrixOption().'</dd>';
        return $str;
    }
}

?>
