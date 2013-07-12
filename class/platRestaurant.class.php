<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of platRestaurant
 *
 * @author mathieu
 */
class PlatRestaurant 
{
    /**
     * Id unique du plat 
     * @var int $m_idPlat
     */
    private $m_idPlat;
    
    /**
     * Libelle du plat
     * @var string $m_libellePlat
     */
    private $m_libellePlat;
    
    /**
     * Prix du plat
     * @var double $m_prixPlat
     */
    private $m_prixPlat;
    
    /**
     * Type du plat
     * @var TypePlat $m_typePlat
     */
    private $m_typePlat;
    
    /**
     * Base de données
     * @var BaseDeDonnees $m_bdd;
     */
    private $m_bdd;
    
    /* ------------------------------------------------- Getteurs ------------------------------------------------- */
    /**
    * Getteur de l'idPlat
    * @return int $this->m_idPlat Valeur de l'id du plat
    */
    public function getIdPlat()
    {
        return $this->m_idPlat;
    }
    /**
     * Getteur du libelle du plat
     * @return string $this->m_libellePlat Libelle du plat
     */
    public function getLibellePlat()
    {
        return $this->m_libellePlat;
    }
    
    /**
     * Getteur du prix du plat
     * @var double $this->m_prixPlat Prix du plat
     */
    public function getPrixPlat()
    {
        return $this->m_prixPlat;
    }
    
    /**
     * Getteur du type de plat
     * @var TypePlat $this->m_typePlat
     */
    public function getTypePlat()
    {
        return $this->m_typePlat;
    }
    
    /* ------------------------------------------------- Setteurs ------------------------------------------------- */
    
    /**
     * Setteur du libelle du plat
     * @param string $libellePlat Nouveau libelle du plat
     */
    public function setLibellePlat($libellePlat)
    {
        $this->m_libellePlat = $libellePlat;
    }
    
    /**
     * Setteur du prix du plat
     * @param double Nouveau prix du plat
     */
    public function setPrixPlat($prixPlat)
    {
        $this->m_prixPlat = $prixPlat;
    }

    /**
     * Setteur du type de plat
     * @param TypePlat $typePlat Nouveau type de plat
     */
    public function setTypePlat($typePlat)
    {
        $this->m_typePlat = $typePlat;
    }
    
     /* ------------------------------------------------- Constructeurs ------------------------------------------------- */
    private function constructId($idPlat)
    {
        $requete = 'SELECT libelleType, prixPlat, idTypePlat_typePlat 
                            FROM platRestaurant
                            WHERE idPlat = ?';
        $tabParametres = array($idPlat);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        $this->m_libellePlat = $resultat[0]['libelleType'];
        $this->m_prixPlat = $resultat[0]['prixPlat'];
        $this->m_typePlat = new TypePlat($resultat[0]['idTypePlat_typePlat']);
    }
        
    private function constructNew($libellePlat, $prixPlat, $typePlat)
    {
        $this->m_libellePlat = $libellePlat;
        $this->m_prixPlat = $prixPlat;
        $this->m_typePlat = $typePlat;
    }
    
    /**
     * Constructeur de la classe
     * Plat provenant de la base de données: constructId($idPlat)
     * Nouveau plat crée via les paramètres données: constructNew($libellePlat, $prixPlat, $typePlat)
     */
    public function __construct() 
    {
        // Création de la connexion à la base de données
        $this->m_bdd = new BaseDeDonnees();
        
        // Choix du constructeur en fonction du nombre d'argument
        $numargs = func_num_args();
        $arg_list = func_get_args();
        
        if($numargs == 1)
        {
            $this->constructId($arg_list[0]);
        }
        elseif($numargs == 3)
        {
            $this->constructNew($arg_list[0], $arg_list[1], $arg_list[2]);
        }
    }
    
    /* ------------------------------------------------- Gestion base de données ------------------------------------------------- */
    /**
     * Ajouter le plat dans la base de données
     * @return boolean TRUE si l'ajout a réussi et FALSE si l'ajout a échoué
     */
    public function ajouterPlat()
    {
        if(!$this->platExisteDeja())
        {
        $requete = 'INSERT INTO platRestaurant(libellePlat, prixPlat, idTypePlat_typePlat) 
                            VALUES (?,?,?)';
        $tabParametres = array($this->m_libellePlat, $this->m_prixPlat, $this->m_typePlat->getIdTypePlat());
        
        $resultat = $this->m_bdd->ajouter($requete, $tabParametres);
        if($resultat)
            $this->initialiserId ();
        return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Modifier le plat dans la base de données
     * @return boolean TRUE si la modification a réussi et FALSE si la modification a échoué
     */
    public function modifierPlat()
    {
        if($this->idExisteDeja())
        {
            $requete = 'UPDATE platRestaurant
                                SET libellePlat = ?, prixPlat = ?, idTypePlat_typePlat = ?
                                WHERE idPlat = ?';
            $tabParametres = array($this->m_libellePlat, $this->m_prixPlat, $this->m_typePlat->getIdTypePlat(), $this->m_idPlat);
        
            $resultat = $this->m_bdd->modifier($requete, $tabParametres);
            return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Suppression du plat dans la base de données
     * @return boolean TRUE si la suppression a réussi et FALSE si la suppression a échoué
     */
    public function supprimerPlat()
    {
        if($this->idExisteDeja())
        {
            $requete = 'DELETE FROM platRestaurant
                                WHERE idPlat = ?';
            $tabParametres = array($this->m_idPlat);
            
            $resultat = $this->m_bdd->supprimer($requete, $tabParametres);
            return $resultat;;
        }
        else
            return FALSE;
    }
    /* ------------------------------------------------- Fonctions Privates ------------------------------------------------- */
    
    /**
     * Fonction vérifiant si l'id existe bien et que l'on peut ainsi le modifier ou le supprimer
     * @return boolean TRUE si le plat existe et FALSE si le plat n'existe pas dans la base de données
     */
    private function idExisteDeja()
    {
        $requete = 'SELECT * 
                            FROM platRestaurant
                            WHERE idPlat = ?';
        $tabParametres = array($this->m_idPlat);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        return $resultat;;
    }
    
    /**
     * Fonction vérifiant si un plat similaire n'existe pas déjà
     * @return boolean TRUE si un plat similaire existe et FALSE si il n'existe pas de plat similaire 
     */
    private function platExisteDeja()
    {
        $requete = 'SELECT *
                            FROM platRestaurant
                            WHERE libellePlat = ? AND prixPlat = ? AND idTypePlat_typePlat = ?';
        $tabParametres = array($this->m_libellePlat, $this->m_prixPlat, $this->m_typePlat->getIdTypePlat());
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        return $resultat;
    }
    
    /**
     * Fonction permettant l'initialisation de l'id à la suite de l'ajout en base de données
     */
    private function initialiserId()
    {
        $requete = 'SELECT idPlat
                            FROM platRestaurant
                            WHERE libellePlat = ? AND prixPlat = ? AND idTypePlat_typePlat = ?';
        $tabParametres = array($this->m_libellePlat, $this->m_prixPlat, $this->m_typePlat->getIdTypePlat());
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        $this->m_idPlat = $resultat[0]['idPlat'];
    }
}

?>
