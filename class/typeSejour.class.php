<?php

/**
 * Description of typeSejour
 *
 * @author jeremy
 */
class TypeSejour 
{
    private $m_idType;
    private $m_libelleType;
    private $m_bdd;
    
    /**
     * Construit un nouvel objet avec les paramètres passés
     * Fonctionnement :
     * new TypeSejour(idType)
     * new TypeSejour(libelleType)
     */
    function __construct()
    {
        $this->m_bdd = new BaseDeDonnees();
        $tabParam   = func_get_args();
        
        if(is_numeric($tabParam[0]))
            $this->constructId($tabParam[0]);
        else
            $this->m_libelleType = $tabParam[0];
    }
    
    /**
     * Construit l'objet via l'id passé en paramètre
     * @param int $idType
     */
    function constructId($idType)
    {
        $requete        = 'SELECT * FROM typeSejour WHERE idType = ?';
        $tabParametres  = array($idType);
        $tabResultats   = $this->m_bdd->selection($requete, $tabParametres);

        $this->m_idType       = $tabResultats[0]['idType'];
        $this->m_libelleType  = $tabResultats[0]['libelleType'];
    }
    
    /**
     * Vérifie si le typeSejour existe déjà dans la base de données en fonction du libellé
     * @return boolean TRUE si le typeSejour existe déjà, FALSE sinon
     */
    function libelleExisteDeja()
    {
        $requete        = 'SELECT * FROM typeSejour WHERE libelleType = ?';
        $tabParametres  = array($this->m_libelleType);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Vérifie si le typeSejour existe déjà dans la base de données en fonction de l'id
     * @return boolean TRUE si l'option existe déjà, FALSE sinon
     */
    function idExisteDeja()
    {
        $requete        = 'SELECT * FROM typeSejour WHERE idType = ?';
        $tabParametres  = array($this->m_idType);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Fonction qui initialise l'idtype (elle sert quand on effectue un ajout et qu'on a toujours pas l'id de l'option)
     */
    function initialiserId()
    {
        if(empty($this->m_idType))
        {
            $requete            = 'SELECT idType FROM typeSejour WHERE libelleType=?';
            $tabParametres      = array($this->m_libelleType);
            $tabResultat        = $this->m_bdd->selection($requete, $tabParametres);
            $this->m_idType     = $tabResultat[0]['idType']; 
        }
    }
    
    /**
     * Ajoute un type de sejour dans la table typeSejour a condition que celui ci n'existe pas déjà
     * @return boolean TRUE si l'ajout s'est bien déroulé, FALSE sinon (FALSE si le type de sejour existait déjà)
     */
    function ajouterTypeSejour()
    {
        if(!$this->libelleExisteDeja())
        {
            $requete        = 'INSERT INTO typeSejour VALUES ("", ?)';
            $tabParametres  = array($this->m_libelleType);
            $valRetour      = $this->m_bdd->ajouter($requete, $tabParametres);
            if($valRetour != FALSE)
                $this->initialiserId();
            return $valRetour;
        }
        return FALSE;
    }
    
    /**
     * Modifie un type de sejour a condition que celui-ci existe dans la bdd
     * @return boolean TRUE si la modification s'est bien passée, FALSE sinon
     */
    function modifiertypeSejour()
    {
        $this->initialiserId();
        if($this->idExisteDeja())
        {
            $requete        = 'UPDATE typeSejour SET libelleType = ? WHERE idType = ?';
            $tabParametres  = array($this->m_libelleType, $this->m_idType);
            return $this->m_bdd->modifier($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Supprime un type de sejour s'il existe bien
     * @return boolean TRUE si la suppression s'est bien passée, FALSE sinon
     */
    function supprimerTypeSejour()
    {
        $this->initialiserId();
        if($this->idExisteDeja())
        {
            $requete        = 'DELETE FROM typeSejour WHERE idType = ?';
            $tabParametres  = array($this->m_idType);
            return $this->m_bdd->supprimer($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Méthode permettant de renvoyer un tableau d'objets de type TypeSejour en fonction des conditions passées en parametre 
     * @param String $where (exemple : "WHERE idType=?")
     * @param tableau $tabParametres (exemple : array(2))
     * @return TypeSejour[]
     */
    static function getObjetsTypeSejour($where, $tabParametres)
    {
        $bdd        = new BaseDeDonnees();
        $requete    = 'SELECT idType FROM typeSejour '.$where;
        $tabRes     = $bdd->selection($requete, $tabParametres);
        $tabObjets  = array();
        
        for($i=0; $i<count($tabRes); $i++)
            $tabObjets[$i] = new TypeSejour($tabRes[$i]['idType']);
        
        if(empty($tabObjets))
            return NULL;
        return $tabObjets;
    }
    
    function getIdType()
    {
        $this->initialiserId();
        return $this->m_idType;
    }
    
    function getLibelleType()
    {
        return $this->m_libelleType;
    }
    
    function setLibelleType($libelleType)
    {
        $ancienLibelle = $this->m_libelleType;
        $this->m_libelleType = $libelleType;
        if($this->libelleExisteDeja())
            $this->m_libelleType = $ancienLibelle;
    }
    
    function __toString()
    {
        $str  = '===TYPE_SEJOUR===<br/>';
        $str .= 'ID : '.$this->m_idType.' --- ';
        $str .= 'LIBELLE : '.$this->m_libelleType.'<br/>';
        $str .= '=================<br/>';
        return $str;
    }
}

?>
