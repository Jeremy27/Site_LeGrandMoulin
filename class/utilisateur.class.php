<?php

class Utilisateur {
    
    // Variables membres de la classe utilisateur
    /**
    * Id unique de l'utilisateur
    * @var int $m_idUtilisateur
    */
    private $m_idUtilisateur;
    /**
    * login de l'utilisateur
    * @var string $m_loginUtilisateur
    */
    private $m_loginUtilisateur;
    /**
    * mot de passe de l'utilisateur
    * @var string $m_mdpUtilisateur
    */
    private $m_mdpUtilisateur;
    /**
    * groupe de l'utilisateur
    * @var groupeUtilisateur $m_groupeUtilisateur
    */
    private $m_groupeUtilisateur;
    /**
    * base de données
    * @var baseDeDonnees $m_bdd
    */
    private $m_bdd;
    
    /* ------------------------------------------------- Getteurs ------------------------------------------------- */
    /**
    * Getteur de l'idUtilisateur
    * @return int $this->m_idUtilisateur valeur de l'id de l'utilisateur
    */
    public function getIdUtilisateur()
    {
        return $this->m_idUtilisateur;
    }
    /**
    * Getteur du login de l'utilisateur
    * @return string $this->m_loginUtilisateur valeur du login de l'utilisateur
    */
    public function getLoginUtilisateur()
    {
        return $this->m_loginUtilisateur;
    }
    /**
    * Getteur du mot de passe de l'utilisateur
    * @return string $this->m_mdpUtilisateur valeur du mot de passe de l'utilisateur
    */
    public function getMdpUtilisateur()
    {
        return $this->m_mdpUtilisateur;
    }
    /**
    * Getteur du groupe de l'utilisateur
    * @return groupeUtilisateur $this->m_groupeUtilisateur objet du groupe de l'utilisateur
    */
    public function getGroupeUtilisateur()
    {
        return $this->m_groupeUtilisateur;
    }
    
    /* ------------------------------------------------- Setteurs ------------------------------------------------- */
    /**
    * Setteur du login de l'utilisateur
    * @param string $loginUtilisateur Nouveau login de l'utilisateur
    */
    public function setLoginUtilisateur($loginUtilisateur)
    {
        $this->m_loginUtilisateur = $loginUtilisateur;
    }
    /**
    * Setteur du mot de passe de l'utilisateur
    * @param string $mdpUtilisateur Nouveau mot de passe de l'utilisateur
    */
    public function setMdpUtilisateur($mdpUtilisateur)
    {
        $this->m_mdpUtilisateur = $mdpUtilisateur;
    }
    /**
    * Setteur du groupe de l'utilisateur
    * @param GroupeUtilisateur $groupe Nouveau groupe de l'utilisateur
    */
    public function setGroupeUtilisateur($groupe)
    {
        $this->m_groupeUtilisateur = $groupe;
    }
    
    /* ------------------------------------------------- Constructeurs ------------------------------------------------- */
    /**
     * Construction de l'utilisateur grâce à l'Id de l'utilisateur via la base de données
     * 
     * @param int $idUtilisateur Id de l'utilisateur à aller chercher dans la base de données
     */
    public function constructId($idUtilisateur)
    {
        $this->m_idUtilisateur = $idUtilisateur;
        // Requête pour obtenir le login, le mot de passe et l'id du groupe utilisateur
        $requete = 'SELECT loginUtilisateur, mdpUtilisateur, idGroupe_groupeUtilisateur
                            FROM utilisateur
                            WHERE idUtilisateur = ?';
        // Paramètres nécessaires à la requête
        $tabParametres = array($idUtilisateur);
        
        // Exécution de la requête
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        // Attribution des valeurs aux variables membres
        $this->m_loginUtilisateur = $resultat[0]['loginUtilisateur'];
        $this->m_mdpUtilisateur = $resultat[0]['mdpUtilisateur'];
        $this->m_groupeUtilisateur = new GroupeUtilisateur($resultat[0]['idGroupe_groupeUtilisateur']);        
    }
    
    /**
     * Construction d'un nouvel utilisateur grâce aux informations fournies
     * 
     * @param string $loginUtilisateur Login du nouvel utilisateur
     * @param string $mdpUtilisateur Mot de passe du nouvel utilisateur
     */
    private function constructNew($loginUtilisateur, $mdpUtilisateur)
    {
        $this->m_loginUtilisateur = $loginUtilisateur;
        $this->m_mdpUtilisateur = $mdpUtilisateur;
        $this->m_groupeUtilisateur = new GroupeUtilisateur(2);
    }
    
    /**
     * Constructeur de la classe
     * Utilisateur provenant de la base de données: constructId($idUtilisateur)
     * Nouvel utilisateur créé via les paramètres donnés: constructNew($loginUtilisateur, $mdpUtilisateur)
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
     * Ajoute l'utilisateur dans la base de données
     * @return boolean Indiquant si l'ajout a bien été effectué ou pas
     */
    public function ajouterUtilisateur()
    {
        if(!$this->loginExisteDeja())
        {
            $requete = 'INSERT INTO utilisateur (loginUtilisateur, mdpUtilisateur, idGroupe_groupeUtilisateur)
                               VALUES (?, ?, ?)';
            $tabParametres = array($this->m_loginUtilisateur, $this->m_mdpUtilisateur ,$this->m_groupeUtilisateur->getIdGroupe());
            $resultat = $this->m_bdd->ajouter($requete, $tabParametres);
            if($resultat)
                $this->initialiserId ();
            return $resultat;
        }
        else
            return FALSE;
    }

    /**
     * Modification de l'utilisateur dans la base de données
     * @return boolean Indiquant si la modification a bien été effectué ou pas
     */
    public function modifierUtilisateur()
    {
        if($this->idExisteDeja())
        {
            $requete = 'UPDATE utilisateur
                                SET loginUtilisateur = ?, mdpUtilisateur = ?, idGroupe_groupeUtilisateur = ?
                                WHERE idUtilisateur = ?';
            $tabParametres = array($this->m_loginUtilisateur, $this->m_mdpUtilisateur, $this->m_groupeUtilisateur->getIdGroupe(), $this->m_idUtilisateur);

            $resultat = $this->m_bdd->modifier($requete, $tabParametres);

            return $resultat;
        }
        else
            return FALSE;
    }
    
    /**
     * Suppression de l'utilisateur dans la base de données
     * @return boolean Indiquant si la suppression a bien été effectué ou pas
     */
    public function supprimerUtilisateur()
    {
        if($this->idExisteDeja())
        {
            $requete = 'DELETE FROM utilisateur
                                WHERE idUtilisateur = ?';
            $tabParametres = array($this->m_idUtilisateur);

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
    private function loginExisteDeja()
    {
        $requete = 'SELECT *
                            FROM utilisateur
                            WHERE loginUtilisateur = ?';
        $tabParametres = array($this->m_loginUtilisateur);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        
        if(empty($resultat))
            return FALSE;
        else
            return TRUE;
    }
    
    /**
     * Fonction qui vérifie si l'utilisateur existe déjà dans la base de données
     * @return boolean Indiquant si le groupe existe ou pas
     */
    private function idExisteDeja()
    {
        $requete = 'SELECT *
                            FROM utilisateur
                            WHERE idUtilisateur = ?';
        $tabParametres = array($this->m_idUtilisateur);
        
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
        $requete = 'SELECT idUtilisateur
                            FROM utilisateur
                            WHERE loginUtilisateur = ?';
        $tabParametres = array($this->m_loginUtilisateur);
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        $this->m_idUtilisateur = $resultat[0]['idUtilisateur'];
        
    }
    
}
?>
