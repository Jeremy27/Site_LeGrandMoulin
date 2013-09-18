<?php

include_once 'baseDeDonnees.class.php';

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
    public function __construct()
    {
        $this->m_bdd = new BaseDeDonnees();
        $nbParam    = func_num_args();
        $tabParam   = func_get_args();
        
        if($nbParam == 1 && is_numeric($tabParam[0]))
            $this->constructId($tabParam[0]);
        else if($nbParam == 5)
        {
            $this->m_nomChambre             = $tabParam[0];
            $this->m_informationsChambre    = $tabParam[1];
            $this->m_capaciteChambre        = $tabParam[2];
            $this->m_wcChambre              = $tabParam[3];
            $this->m_sdbChambre             = $tabParam[4];
        }
    }
    
    private function constructId($idChambre)
    {
        $requete        = "SELECT * FROM chambre WHERE idChambre=?";
        $tabParametres  = array($idChambre);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        
        $this->m_idChambre              = $idChambre;
        $this->m_nomChambre             = $tabResultat[0]["nomChambre"];
        $this->m_informationsChambre    = $tabResultat[0]["informationsChambre"];
        $this->m_capaciteChambre        = $tabResultat[0]["capaciteChambre"];
        $this->m_wcChambre              = $tabResultat[0]["wc"];
        $this->m_sdbChambre             = $tabResultat[0]["sdb"];
    }
    
    /**
     * Vérifie si la chambre existe déjà dans la base de données en fonction de son nom
     * @return boolean TRUE si la chambre existe déjà, FALSE sinon
     */
    public function nomExisteDeja()
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
    public function idExisteDeja()
    {
        $this->initialiserId();
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
    private function initialiserId()
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
    public function ajouterChambre()
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
    public function modifierChambre()
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
    public function supprimerChambre()
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
    
    /**
     * Méthode permettant de renvoyer un tableau d'objets de type Chambre en fonction des conditions passées en parametre 
     * @param String $where (exemple : "WHERE idChambre=?")
     * @param tableau $tabParametres (exemple : array(2))
     * @return Chambre[]
     */
    static function getObjetsChambre($where="", $tabParametres=null)
    {
        $bdd        = new BaseDeDonnees();
        $requete    = 'SELECT idChambre FROM chambre '.$where;
        $tabRes     = $bdd->selection($requete, $tabParametres);
        $tabObjets  = array();
        
        for($i=0; $i<count($tabRes); $i++)
            $tabObjets[$i] = new Chambre($tabRes[$i]['idChambre']);
        
        if(empty($tabObjets))
            return NULL;
        return $tabObjets;
    }
    
    public function setNomChambre($nomChambre)
    {
        $ancienNom          = $this->m_nomChambre;
        $this->m_nomChambre = $nomChambre;
        if($this->nomExisteDeja())
            $this->m_nomChambre = $ancienNom;
    }
    
    public function setInformationsChambre($informationsChambre)
    {
        $this->m_informationsChambre = $informationsChambre;
    }
    
    public function setCapaciteChambre($capaciteChambre)
    {
        $this->m_capaciteChambre = $capaciteChambre;
    }
    
    public function setWcChambre($wcChambre)
    {
        $this->m_wcChambre = $wcChambre;
    }
    
    public function setSdbChambre($sdbChambre)
    {
        $this->m_sdbChambre = $sdbChambre;
    }
    
    public function getNomChambre()
    {
        return $this->m_nomChambre;
    }
    
    public function getInformationsChambre()
    {
        return $this->m_informationsChambre;
    }
    
    public function getCapaciteChambre()
    {
        return $this->m_capaciteChambre;
    }
    
    public function getWcChambre()
    {
        return $this->m_wcChambre;
    }
    
    public function getSdbChambre()
    {
        return $this->m_sdbChambre;
    }
    
    public function getIdChambre()
    {
        $this->initialiserId();
        return $this->m_idChambre;
    }
    
    public function __toString()
    {
        $str  = '===CHAMBRE===<br/>';
        $str .= 'ID : '.$this->m_idChambre.' --- ';
        $str .= 'NOM : '.$this->m_nomChambre.' --- ';
        $str .= 'INFORMATIONS : '.$this->m_informationsChambre.' --- ';
        $str .= 'CAPACITE : '.$this->m_capaciteChambre.' --- ';
        $str .= 'WC : '.$this->m_wcChambre.' --- ';
        $str .= 'SDB : '.$this->m_sdbChambre.'<br/>';
        $str .= '=============<br/>';
        return $str;
    }
}

?>
