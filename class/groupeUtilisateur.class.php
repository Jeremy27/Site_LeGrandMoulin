<?php

class GroupeUtilisateur 
{
    /**
    * Id unique du groupe
    * @var int $m_idGroupe
    */
    private $m_idGroupe;
    /**
    * Libelle du groupe
    * @var string $m_libelleGroupe
    */
    private $m_libelleGroupe;
    /**
    * Base de données
    * @var BaseDeDonnees $m_bdd
    */
    private $m_bdd;
    
    /* ------------------------------------------------- Getteurs ------------------------------------------------- */
    /**
    * Getteur de l'idGroupe
    * @return int $this->m_idGroupe valeur de l'id du groupe
    */
    public function getIdGroupe()
    {
        return $this->m_idGroupe;
    }
    /**
    * Getteur du libelleGroupe
    * @return string $this->libelleGroupe valeur du libelle du groupe
    */
    public function getLibelleGroupe()
    {
        return $this->m_libelleGroupe;
    }
    
    /* ------------------------------------------------- Setteurs ------------------------------------------------- */
    /**
    * Setteur du libelle du groupe
    * @param string $libelleGroupe Nouveau libelle du groupe
    */
    public function setLibelleGroupe($libelleGroupe)
    {
        $this->m_libelleGroupe = $libelleGroupe;
    }
    
    /* ------------------------------------------------- Constructeurs ------------------------------------------------- */
    /**
     * Construction du groupe grâce à l'Id via la base de données
     * @param int $idGroupe $idGroupe Id du groupe à aller chercher dans la base de données
     */
    private function constructId($idGroupe)
    {
        $this->m_idGroupe = $idGroupe;
        // Requête pour obtenir le libelle du groupe
        $requete = 'SELECT libelleGroupe
                            FROM groupeUtilisateur
                            WHERE idGroupe = ?';
        // Paramètres nécessaires à la requête
        $tabParametres = [$idGroupe];
        
        // Exécution de la requête
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        // Attribution de la valeur à la variable membre
        $this->m_libelleGroupe = $resultat[0]['libelleGroupe'];   
    }
    
    /**
     * Construction d'un nouveau groupe grâce aux informations fournies
     * 
     * @param string $libelleGroupe Libelle du nouveau groupe
     */
    private function constructNew($libelleGroupe)
    {
        $this->m_libelleGroupe = $libelleGroupe;
    }


    /**
     * Constructeur de la classe
     * Groupe provenant de la base de données: constructId($idGroupe)
     * Nouveau Groupe créé via les paramètres donnés: constructNew($libelleGroupe)
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
     * Ajoute le groupe dans la base de données
     * @return boolean Indiquant si l'ajout a bien été effectué ou pas
     */
    public function ajouterGroupe()
    {
        if(!$this->libelleExisteDeja())
        {
            $requete = 'INSERT INTO groupeUtilisateur (libelleGroupe)
                                VALUES (?)';
            $tabParametres = array($this->m_libelleGroupe);

            $resultat = $this->m_bdd->ajouter($requete, $tabParametres);
            if($resultat)
                $this->initialiserId ();

            return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Modification du groupe dans la base de données
     * @return boolean Indiquant si la modification a bien été effectué ou pas
     */
    public function modifierGroupe()
    {
        if($this->idExisteDeja())
        {
            $requete = 'UPDATE groupeUtilisateur
                                SET libelleGroupe = ?
                                WHERE idGroupe = ?';
            $tabParametres = array($this->m_libelleGroupe, $this->m_idGroupe);

            $resultat = $this->m_bdd->modifier($requete, $tabParametres);
            var_dump($resultat);
            return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Suppression du groupe dans la base de données
     * @return boolean Indiquant si la suppression a bien été effectué ou pas
     */
    public function supprimerGroupe()
    {
        if($this->idExisteDeja())
        {
            $requete = 'DELETE FROM groupeUtilisateur
                                WHERE idGroupe = ?';
            $tabParametres = array($this->m_idGroupe);

            $resultat = $this->m_bdd->supprimer($requete, $tabParametres);

            return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Fonction qui vérifie si ce libelle de groupe existe déjà dans la base de données
     * @return boolean Indiquant si le groupe existe ou pas
     */
    private function libelleExisteDeja()
    {
        $requete = 'SELECT *
                            FROM groupeUtilisateur
                            WHERE libelleGroupe = ?';
        $tabParametres = array($this->m_libelleGroupe);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        if(empty($resultat))
            return FALSE;
        else
            return TRUE;
    }
    
    /**
     * Fonction qui vérifie si le groupe existe déjà dans la base de données
     * @return boolean Indiquant si le groupe existe ou pas
     */
    private function idExisteDeja()
    {
        $requete = 'SELECT *
                            FROM groupeUtilisateur
                            WHERE idGroupe = ?';
        $tabParametres = array($this->m_idGroupe);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        if(empty($resultat))
            return FALSE;
        else
            return TRUE;
    }
    
    /**
     * Fonction d'initialisation de l'id du groupe suite à l'ajout du groupe en base de données
     */
    private function initialiserId()
    {
        $requete = 'SELECT idGroupe
                            FROM groupeUtilisateur
                            WHERE libelleGroupe = ?';
        $tabParametres = array($this->m_libelleGroupe);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        $this->m_idGroupe = $resultat[0]['idGroupe'];
    }
}

?>
