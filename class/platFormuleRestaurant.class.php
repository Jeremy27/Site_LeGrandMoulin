<?php

class PlatFormuleRestaurant 
{
    /**
     * Objet PlatRestaurant 
     * @var PlatRestaurant $m_platRestaurant
     */
    private $m_platRestaurant;
    
    /**
     * Objet FormuleRestaurant
     * @var FormuleRestaurant $m_formuleRestaurant
     */
    private $m_formuleRestaurant;
    
    /**
     * Objet Base de données
     * @var BaseDeDonnees $m_bdd
     */
    private $m_bdd;
    
    /* ------------------------------------------------- Getteurs ------------------------------------------------- */
    /**
     * Getteur du plat du restaurant
     * @return PlatRestaurant $this->m_platRestaurant Plat du restaurant
     */
    public function getPlatRestaurant()
    {
        return $this->m_platRestaurant;
    }
    
    /**
     * Getteur de la formule du restaurant
     * @return FormuleRestaurant $this->m_formuleRestaurant Formule du restaurant
     */
    public function getFormuleRestaurant()
    {
        return $this->m_formuleRestaurant;
    }
    
    /* ------------------------------------------------- Constructeur ------------------------------------------------- */
    
    /**
     * Constructeur de la classe
     * 
     * @param int $idPlatRestaurant
     * @param int $idFormuleRestaurant
     */
    public function __construct($idPlatRestaurant, $idFormuleRestaurant) 
    {
        $this->m_bdd = new BaseDeDonnees();
        $this->m_platRestaurant = new PlatRestaurant($idPlatRestaurant);
        $this->m_formuleRestaurant = new FormuleRestaurant($idFormuleRestaurant);
    }
    
    /* ------------------------------------------------- Gestion base de données ------------------------------------------------- */
    
    /**
     * Ajout d'une association platRestaurant/formuleRestaurant dans la base de données
     * @return boolean TRUE si l'ajout a réussi et FALSE si l'ajout a échoué
     */
    public function ajouterPlatFormuleRestaurant()
    {
        if(!$this->existeDeja())
        {
            $requete = 'INSERT INTO platFormuleRestaurant (idPlat_platRestaurant, idFormule_formuleRestaurant)
                                VALUES (?, ?)';
            $tabParametres = array($this->m_platRestaurant->getIdPlat(), $this->m_formuleRestaurant->getIdFormule());

            $resultat = $this->m_bdd->ajouter($requete, $tabParametres);   
            return $resultat;
        }
    }
    /**
     * Suppression d'une association platRestaurant/formuleRestaurant dans la base de données
     * @return boolean TRUE si la suppression a réussi et FALSE si la suppression a échoué
     */
    public function supprimerPlatFormuleRestaurant()
    {
        if($this->existeDeja())
        {
            $requete = 'DELETE FROM platFormuleRestaurant
                                WHERE idPlat_platRestaurant = ? AND idFormule_formuleRestaurant = ?';
            $tabParametres = array($this->m_platRestaurant->getIdPlat(), $this->m_formuleRestaurant->getIdFormule());
            
            $resultat = $this->m_bdd->supprimer($requete, $tabParametres);
            return $resultat;
        }
    }
    
    /* ------------------------------------------------- Fonctions Privates ------------------------------------------------- */
    /**
     * Fonction permettant de vérifier si l'association existe déjà ou pas
     * @return boolean TRUE si l'association existe déjà et FALSE si l'association n'existe pas encore
     */
    private function existeDeja()
    {
        $requete = 'SELECT *
                            FROM platFormuleRestaurant
                            WHERE idPlat_platRestaurant = ? AND idFormule_formuleRestaurant = ?';
        $tabParametres = array($this->m_platRestaurant->getIdPlat(), $this->m_formuleRestaurant->getIdFormule());
        
        $resultat = $this->m_bdd->selection($requete, $tabParametres);
        return $resultat;
    }
}

?>
