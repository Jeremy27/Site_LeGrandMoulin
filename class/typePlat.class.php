<?php

class TypePlat {
    /**
    * Id unique du type de plat
    * @var int $m_idTypePlat
    */
    private $m_idTypePlat;
    /**
    * Libelle du type de plat
    * @var string $m_libelleTypePlat
    */
    private $m_libelleTypePlat;
    /**
    * Base de données
    * @var BaseDeDonnees $m_bdd
    */
    private $m_bdd;
    
    /* ------------------------------------------------- Getteurs ------------------------------------------------- */
    /**
    * Getteur de l'idTypePlat
    * @return int $this->m_idTypePlat valeur de l'id du type de plat
    */
    public function getIdTypePlat()
    {
        return $this->m_idTypePlat;
    }
    /**
    * Getteur du libelleTypePlat
    * @return string $this->libelleTypePlat valeur du libelle du type de plat
    */
    public function getLibelleTypePlat()
    {
        return $this->m_libelleTypePlat;
    }
    
    /* ------------------------------------------------- Setteurs ------------------------------------------------- */
    /**
    * Setteur du libelle du type de plat
    * @param string $libelleTypePlat Nouveau libelle du type de plat
    */
    public function setLibelleTypePlat($libelleTypePlat)
    {
        $this->m_libelleTypePlat = $libelleTypePlat;
    }
    
    /* ------------------------------------------------- Constructeurs ------------------------------------------------- */
    /**
     * Construction du type de plat grâce à l'Id via la base de données
     * @param int $idTypePlat Id du type de plat à aller chercher dans la base de données
     */
    private function constructId($idTypePlat)
    {
        $this->m_idTypePlat = $idTypePlat;
        // Requête pour obtenir le libelle du type de plat
        $requete = 'SELECT libelleTypePlat
                            FROM typePlat
                            WHERE idTypePlat = ?';
        // Paramètres nécessaires à la requête
        $tabParametres = array($idTypePlat);
        
        // Exécution de la requête
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        // Attribution de la valeur à la variable membre
        $this->m_libelleTypePlat = $resultat[0]['libelleTypePlat'];   
    }
    
    /**
     * Construction d'un nouveau type de plat grâce aux informations fournies
     * 
     * @param string $libelleTypePlat Libelle du nouveau type de plat
     */
    private function constructNew($libelleTypePlat)
    {
        $this->m_libelleTypePlat = $libelleTypePlat;
    }


    /**
     * Constructeur de la classe
     * Type de plat provenant de la base de données: constructId($idTypePlat)
     * Nouveau type de plat créé via les paramètres donnés: constructNew($libelleTypePlat)
     */
    public function __construct()
    {
        // Création de la connexion à la base de données
        $this->m_bdd = new BaseDeDonnees();
        
        // Choix du constructeur en fonction du nombre d'argument
        $arg_list = func_get_args();
        
        // Choix du constructeur en fonction du type de l'argument
        if(is_numeric($arg_list[0]))
        {
            $this->constructId($arg_list[0]);
        }
        elseif(is_string($arg_list[0]))
        {
            $this->constructNew($arg_list[0]);
        }        
    }
    
    /* ------------------------------------------------- Gestion base de données ------------------------------------------------- */
    
    /**
     * Ajoute le type de plat dans la base de données
     * @return boolean Indiquant si l'ajout a bien été effectué ou pas
     */
    public function ajouterTypePlat()
    {
        if(!$this->libelleExisteDeja())
        {
            $requete = 'INSERT INTO typePlat (libelleTypePlat)
                                VALUES (?)';
            $tabParametres = array($this->m_libelleTypePlat);

            $resultat = $this->m_bdd->ajouter($requete, $tabParametres);
            if($resultat)
                $this->initialiserId ();
            return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Modification du type de plat dans la base de données
     * @return boolean Indiquant si la modification a bien été effectué ou pas
     */
    public function modifierTypePlat()
    {
        if($this->idExisteDeja())
        {
            $requete = 'UPDATE typePlat
                                SET libelleTypePlat = ?
                                WHERE idTypePlat = ?';
            $tabParametres = array($this->m_libelleTypePlat, $this->m_idTypePlat);

            $resultat = $this->m_bdd->modifier($requete, $tabParametres);

            return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Suppression du type de plat dans la base de données
     * @return boolean Indiquant si la suppression a bien été effectué ou pas
     */
    public function supprimerTypePlat()
    {
        if($this->idExisteDeja())
        {
            $requete = 'DELETE FROM typePlat
                                WHERE idTypePlat = ?';
            $tabParametres = array($this->m_idTypePlat);

            $resultat = $this->m_bdd->supprimer($requete, $tabParametres);

            return $resultat;
        }
        else
            return FALSE;
    }
    
    /* ------------------------------------------------- Fonctions Privates ------------------------------------------------- */
    
    /**
     * Fonction qui vérifie si le libellé du type de plat existe déjà dans la base de données
     * @return boolean Indiquant si le type de plat existe ou pas
     */
    private function libelleExisteDeja()
    {
        $requete = 'SELECT *
                            FROM typePlat
                            WHERE libelleTypePlat = ?';
        $tabParametres = array($this->m_libelleTypePlat);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        if(empty($resultat))
            return FALSE;
        else
            return TRUE;
    }
    
    /**
     * Fonction qui vérifie si l'id du type de plat existe déjà dans la base de données
     * @return boolean Indiquant si le type de plat existe ou pas
     */
    private function idExisteDeja()
    {
        $requete = 'SELECT * 
                            FROM typePlat
                            WHERE idTypePlat = ?';
        $tabParametres = array($this->m_idTypePlat);
        
        $resulat = $this->m_bdd->selection($requete, $tabParametres);
        
        if(empty($resulat))
            return FALSE;
        else
            return TRUE;
    }
    
    /**
     * Fonction d'initialisation de l'id du type de plat suite à l'ajout du groupe en base de données
     */
    private function initialiserId()
    {
        $requete = 'SELECT idTypePlat
                            FROM typePlat
                            WHERE libelleTypePlat = ?';
        $tabParametres = array($this->m_libelleTypePlat);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        $this->m_idTypePlat= $resultat[0]['idTypePlat'];
    }
}

?>
