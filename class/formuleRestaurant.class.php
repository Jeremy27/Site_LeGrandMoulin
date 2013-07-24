<?php

class formuleRestaurant 
{
    /**
     * Id unique de la formule
     * @var int $m_idFormule
     */
    private $m_idFormule;
    
    /**
     * Libelle de la formule
     * @var string $libelleFormule
     */
    private $m_libelleFormule;
    
    /**
     * Prix de la formule
     * @var double $m_prixFormule
     */
    private $m_prixFormule;
    
    /**
     * Base de données
     * @var BaseDeDonnees $m_bdd
     */
    private $m_bdd;
    
     /* ------------------------------------------------- Getteurs ------------------------------------------------- */
    /**
     * Getteur de l'id de la formule
     * @return int $this->m_idFormule Id de la formule
     */
    public function getIdFormule()
    {
        return $this->m_idFormule;
    }
    /**
     * Getteur du libellé de la formule
     * @return string $this->m_libelleFormule Libellé de la formule
     */
    public function getLibelleFormule()
    {
        return $this->m_libelleFormule;
    }
    /**
     * Getteur du prix de la formule
     * @return double $this->m_prixFormule Prix de la formule
     */
    public function getPrixFormule()
    {
        return $this->m_prixFormule;
    }
    
     /* ------------------------------------------------- Setteurs ------------------------------------------------- */
    /**
     * Setteur du libelle de la formule
     * @param string $libelleFormule Nouveau libelle de la formule
     */
    public function setLibelleFormule($libelleFormule)
    {
        $this->m_libelleFormule = $libelleFormule;
    }
    
    /**
     * Setteur du prix de la formule
     * @param string $prixFormule Nouveau prix de la formule
     */
    public function setPrixFormule($prixFormule)
    {
        $this->m_prixFormule = $prixFormule;
    }
    
     /* ------------------------------------------------- Constructeurs ------------------------------------------------- */
   
    private function constructId($idFormule)
    {
        $requete = 'SELECT libelleFormule, prixFormule
                            FROM formuleRestaurant
                            WHERE idFormule = ?';
        $tabParametres = array($idFormule);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        $this->m_libelleFormule = $resultat[0]['libelleFormule'];
        $this->m_prixFormule = $resultat[0]['prixFormule'];
    }
    
    private function constructNew($libelleFormule, $prixFormule)
    {
        $this->m_libelleFormule = $libelleFormule;
        $this->m_prixFormule = $prixFormule;
    }
    /**
     * Constructeur de la classe
     * Formule provenant de la base de données: constructId($idFormule)
     * Nouvelle formule créée via les paramètres données: constructNew($libelleFormule, $prixFormule)
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
        elseif($numargs == 2)
        {
            $this->constructNew($arg_list[0], $arg_list[1]);
        }
    }
    
    /* ------------------------------------------------- Gestion base de données ------------------------------------------------- */
    /**
     * Ajouter la formule dans la base de données
     * @return boolean TRUE si l'ajout a réussi et FALSE si l'ajout a échoué
     */
    public function ajouterFormule()
    {
        if(!$this->formuleExisteDeja())
        {
            $requete = 'INSERT INTO formuleRestaurant (libelleFormule, prixFormule)
                                VALUES (?,?)';
            $tabParametres = array($this->m_libelleFormule, $this->m_prixFormule);
            
            $resultat = $this->m_bdd->ajouter($requete, $tabParametres);
            if($resultat)
                $this->initialiserId ();
            return $resultat;
        }
        else
            return FALSE;
    }    
    
    /**
     * Modifier la formule dans la base de données
     * @return boolean TRUE si la modification a réussi et FALSE si la modification a échoué
     */
    public function modifierFormule()
    {
        if($this->idExisteDeja())
        {
            $requete = 'UPDATE formuleRestaurant
                                SET libelleFormule = ?, prixFormule = ?
                                WHERE idFormule = ?';
            $tabParametres = array($this->m_libelleFormule, $this->m_prixFormule, $this->m_idFormule);
            $resultat = $this->m_bdd->modifier($requete, $tabParametres);
            return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Suppression de la formule dans la base de données
     * @return boolean TRUE si la suppression a réussi et FALSE si la suppression a échoué
     */
    public function supprimerFormule()
    {
        if($this->idExisteDeja())
        {
            $requete = 'DELETE FROM formuleRestaurant
                                WHERE idFormule = ?';
            $tabParametres = array($this->m_idFormule);
            
            $resultat = $this->m_bdd->supprimer($requete, $tabParametres);
            return $resultat;
        }
        else
            return FALSE;
        
    }
    
    /* ------------------------------------------------- Fonctions Privates ------------------------------------------------- */
    /**
     * Fonction vérifiant si l'id existe bien et que l'on peut ainsi le modifier ou le supprimer
     * @return boolean TRUE si la formule existe et FALSE si la formule n'existe pas dans la base de données
     */
    private function idExisteDeja()
    {
        $requete = 'SELECT  * 
                            FROM formuleRestaurant
                            WHERE idFormule = ?';
        $tabParametres = array($this->m_idFormule);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        return $resultat;        
    }
    
    /**
     * Fonction vérifiant si une formule similaire n'existe pas déjà
     * @return boolean TRUE si une formule similaire existe et FALSE si il n'existe pas de formule similaire 
     */
    private function formuleExisteDeja()
    {
        $requete = 'SELECT * 
                            FROM formuleRestaurant
                            WHERE libelleFormule = ? AND prixFormule = ?';
        $tabParametres = array($this->m_libelleFormule, $this->m_prixFormule);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        return $resultat;
    }
    
    /**
     * Fonction permettant l'initialisation de l'id à la suite de l'ajout en base de données
     */
    private function initialiserId()
    {
        $requete = 'SELECT idFormule
                            FROM formuleRestaurant
                            WHERE libelleFormule = ? AND prixFormule = ?';
        $tabParametres = array($this->m_libelleFormule, $this->m_prixFormule);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        $this->m_idFormule = $resultat[0]['idFormule'];
    }
}

?>
