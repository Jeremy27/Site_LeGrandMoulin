<?php

/**
 * Description of chambre
 *
 * @author jeremy
 */
class Chambre 
{
    private $m_idChambre;
    private $m_nomChambre;
    private $m_informationsChambre;
    private $m_capaciteChambre;
    private $m_wcChambre;
    private $m_sdbChambre;
    private $m_bdd;
    
    /**
     * Utiliser le constructeur soit comme cela :
     * new Chambre(nomChambre, informationsChambre, capacitéChambre, wc, sbd)
     * Ou :
     * new Chambre(idChambre)
     */
    function __construct()
    {
        $this->m_bdd = new BaseDeDonnees();
        $nbParam    = func_num_args();
        $tabParam   = func_get_args();
        
        if($nbParam == 1 && is_numeric($tabParam[0]))
            constructId($tabParam[0]);
        else if($nbParam == 5)
        {
            $this->m_nomChambre             = $tabParam[0];
            $this->m_informationsChambre    = $tabParam[1];
            $this->m_capaciteChambre        = $tabParam[2];
            $this->m_wcChambre              = $tabParam[3];
            $this->m_sdbChambre             = $tabParam[4];
        }
    }
    
    function constructId($idChambre)
    {
        $requete        = "SELECT * FROM chambre WHERE idChambre=?";
        $tabParametres  = array($idChambre);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        
        $this->m_idChambre              = $idChambre;
        $this->m_nomChambre             = $tabResultat["nomChambre"];
        $this->m_informationsChambre    = $tabResultat["informationsChambre"];
        $this->m_capaciteChambre        = $tabResultat["capaciteChambre"];
        $this->m_wcChambre              = $tabResultat["wc"];
        $this->m_sdbChambre             = $tabResultat["sdb"];
    }
    
    /**
     * Vérifie si la chambre existe déjà dans la base de données en fonction de son nom
     * @return boolean TRUE si la chambre existe déjà, FALSE sinon
     */
    function nomExisteDeja()
    {
        $requete        = 'SELECT * FROM chambre WHERE nomChambre = ?';
        $tabParametres  = array($this->m_nomChambre);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Vérifie si la chambre existe déjà dans la base de données en fonction de son id
     * @return boolean TRUE si la chambre existe déjà, FALSE sinon
     */
    function idExisteDeja()
    {
        $requete        = 'SELECT * FROM chambre WHERE idChambre = ?';
        $tabParametres  = array($this->m_idChambre);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Fonction qui initialise l'idChambre (elle sert quand on effectue un ajout et qu'on a toujours pas l'id de l'option)
     */
    function initialiserId()
    {
        if(empty($this->m_idChambre))
        {
            $requete            = 'SELECT idChambre FROM chambre WHERE nomChambre=? AND informationsChambre=? AND capaciteChambre=? AND wc=? AND sdb=?';
            $tabParametres      = array($this->m_nomChambre, $this->m_informationsChambre, $this->m_capaciteChambre, $this->m_wcChambre, $this->m_sdbChambre);
            $tabResultat        = $this->m_bdd->selection($requete, $tabParametres);
            $this->m_idChambre  = $tabResultat[0]['idChambre']; 
        }
    }
    
    /**
     * Ajoute une chambre dans la table chambre a condition que cette chambre n'existe pas déjà
     * @return boolean TRUE si l'ajout s'est bien déroulé, FALSE sinon (FALSE si la chambre existait déjà)
     */
    function ajouterChambre()
    {
        if(!$this->nomExisteDeja())
        {
            $requete        = 'INSERT INTO chambre VALUES ("", ?, ?, ?, ?, ?)';
            $tabParametres  = array($this->m_nomChambre, $this->m_informationsChambre, $this->m_capaciteChambre, $this->m_wcChambre, $this->m_sdbChambre);
            $valRetour      = $this->m_bdd->ajouter($requete, $tabParametres);
            if($valRetour != FALSE)
                $this->initialiserId();
            return $valRetour;
        }
        return FALSE;
    }
    
    /**
     * Modifie une chambre a condition que celle ci existe dans la bdd
     * @return boolean TRUE si la modification s'est bien passée, FALSE sinon
     */
    function modifierChambre()
    {
        $this->initialiserId();
        if($this->idExisteDeja())
        {
            $requete        = 'UPDATE chambre SET nomChambre=?, informationsChambre=?, capaciteChambre=?, wc=?, sdb=? WHERE idChambre = ?';
            $tabParametres  = array($this->m_nomChambre, $this->m_informationsChambre, $this->m_capaciteChambre, $this->m_wcChambre, $this->m_sdbChambre, $this->m_idChambre);
            return $this->m_bdd->modifier($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Supprime une chambre si elle existe bien
     * @return boolean TRUE si la suppression s'est bien passée, FALSE sinon
     */
    function supprimerChambre()
    {
        $this->initialiserId();
        if($this->idExisteDeja())
        {
            $requete        = 'DELETE FROM chambre WHERE idChambre = ?';
            $tabParametres  = array($this->m_idChambre);
            return $this->m_bdd->supprimer($requete, $tabParametres);
        }
        return FALSE;
    }
    
    function __toString()
    {
        $str = '<dd>ID : '.$this->m_idChambre.' --- ';
        $str .= 'NOM : '.$this->m_nomChambre.' --- ';
        $str .= 'INFORMATIONS : '.$this->m_informationsChambre.' --- ';
        $str .= 'CAPACITE : '.$this->m_capaciteChambre.' --- ';
        $str .= 'WC : '.$this->m_wcChambre.' --- ';
        $str .= 'SDB : '.$this->m_sdbChambre.'</dd>';
        return $str;
    }
    
    function setNomChambre($nomChambre)
    {
        $ancienNom          = $this->m_nomChambre;
        $this->m_nomChambre = $nomChambre;
        if($this->nomExisteDeja())
            $this->m_nomChambre = $ancienNom;
    }
    
    function setInformationsChambre($informationsChambre)
    {
        $this->m_informationsChambre = $informationsChambre;
    }
    
    function setCapaciteChambre($capaciteChambre)
    {
        $this->m_capaciteChambre = $capaciteChambre;
    }
    
    function setWcChambre($wcChambre)
    {
        $this->m_wcChambre = $wcChambre;
    }
    
    function setSdbChambre($sdbChambre)
    {
        $this->m_sdbChambre = $sdbChambre;
    }
    
    function getNomChambre()
    {
        return $this->m_nomChambre;
    }
    
    function getInformationsChambre()
    {
        return $this->m_informationsChambre;
    }
    
    function getCapaciteChambre()
    {
        return $this->m_capaciteChambre;
    }
    
    function getWcChambre()
    {
        return $this->m_wcChambre;
    }
    
    function getSdbChambre()
    {
        return $this->m_sdbChambre;
    }
}

?>
