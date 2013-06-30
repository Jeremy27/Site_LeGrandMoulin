<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utilisateur
 *
 * @author mathieu
 */
class utilisateur {
    
    // Variables membres de la classe utilisateur
    private $m_idUtilisateur;
    private $m_loginUtilisateur;
    private $m_mdpUtilisateur;
    private $m_groupeUtilisateur;
    private $m_bdd;
    
    /* ------------------------------------------------- Getteurs ------------------------------------------------- */
    public function getIdUtilisateur()
    {
        return $this->m_idUtilisateur;
    }
    
    public function getLoginUtilisateur()
    {
        return $this->m_loginUtilisateur;
    }
    
    public function getMdpUtilisateur()
    {
        return $this->m_mdpUtilisateur;
    }
    
    /* ------------------------------------------------- Setteurs ------------------------------------------------- */
    public function setLoginUtilisateur($loginUtilisateur)
    {
        $this->m_loginUtilisateur = $loginUtilisateur;
    }
    
    public function setMdpUtilisateur($mdpUtilisateur)
    {
        $this->m_mdpUtilisateur = $mdpUtilisateur;
    }
    
    /* ------------------------------------------------- Constructeurs ------------------------------------------------- */
    // Construction de l'utilisateur grâce à l'Id via la base de données
    public function constructId($idUtilisateur)
    {
        $this->m_idUtilisateur = $idUtilisateur;
        // Requête pour obtenir le login et mot de passe
        $requete = 'SELECT loginUtilisateur, mdpUtilisateur
                            FROM utilisateur
                            WHERE idUtilisateur =\''.$this->m_idUtilisateur.'\'';
        /*
         * 
         * 
         * 
         * 
         * 
         * 
         * 
         */
    }
    
    // Construction d'un nouvel utilisateur grâce aux informations fournies
    public function constructNew($loginUtilisateur, $mdpUtilisateur, $idGroupe)
    {
        $this->m_loginUtilisateur = $loginUtilisateur;
        $this->m_mdpUtilisateur = $mdpUtilisateur;
        $this->m_groupeUtilisateur = new groupeUtilisateur($idGroupe);
    }
    
    public function __construct()
    {
        // Création de la connexion à la base de données
        $this->m_bdd = new baseDeDonnees();
        
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
    // Ajout d'un nouvel utilisateur
    function ajouterUtilisateur()
    {
         /*
         * 
         * 
         */
    }
    
    // Modification de l'utilisateur
    function modifierUtilisateur()
    {
        /*
         * 
         * 
         */
    }
    
    // Suppression de l'utilisateur
    function supprimerUtilisateur()
    {
        /*
         * 
         * 
         */
    }  
        
}
?>
