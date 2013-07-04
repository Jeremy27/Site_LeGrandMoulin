<?php

class GroupeUtilisateur 
{
    private $m_idGroupe;
    private $m_libelleGroupe;
    private $m_bdd;
    
    /* ------------------------------------------------- Getteurs ------------------------------------------------- */
    
    public function getIdGroupe()
    {
        return $this->m_idGroupe;
    }
    
    public function getLibelleGroupe()
    {
        return $this->m_libelleGroupe;
    }
    
    /* ------------------------------------------------- Constructeurs ------------------------------------------------- */
    // Construction du groupe grâce à l'Id via la base de données
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
    
    // Construction d'un nouveau groupe grâce aux informations fournies
    private function constructNew($libelleGroupe)
    {
        $this->m_libelleGroupe = $libelleGroupe;
    }


    // Constructeur
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
}

?>
