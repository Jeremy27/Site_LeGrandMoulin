<?php

/**
 * Description of prixChambre
 *
 * @author jeremy
 */
class PrixChambre 
{
    private $m_chambre;
    private $m_type;
    private $m_prix;
    private $m_bdd;
    
    /**
     * Prend en paramètre l'id de la Chambre et l'id du Type de Sejour pour créer une liaison entre ces deux éléments
     * @param int $idChambre
     * @param int $idType
     */
    function __construct($idChambre, $idType)
    {
        $this->m_bdd        = new BaseDeDonnees();
        $this->m_chambre    = new Chambre($idChambre);
        $this->m_type       = new TypeSejour($idType);
    }
    
    /**
     * Cette méthode vérifie si l'association a déjà été créée dans la bdd
     * @return boolean TRUE si l'association existe déjà, FALSE sinon
     */
    function existeDeja()
    {
        $requete        = 'SELECT * FROM prixChambre WHERE idChambre_chambre = ? AND idType_typeSejour = ?';
        $tabParametres  = array($this->m_chambre->getIdChambre(), $this->m_type->getIdType());
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    /**
     * Cette méthode ajoute une entrée Chambre/TypeSejour dans la bdd
     * @return boolean TRUE si la requête s'est correctement déroulée, FALSE sinon (FALSE si l'association existait déjà)
     */
    function ajouterPrixChambre()
    {
        if(!$this->existeDeja())
        {
            $requete        = 'INSERT INTO prixChambre VALUES(?, ?, ?)';
            $tabParametres  = array($this->m_prix, $this->m_chambre->getIdChambre(), $this->m_type->getIdType());
            return $this->m_bdd->ajouter($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Cette méthode modifie le prix du couple idChambre/idType
     * @return boolean TRUE si la modification à bien eu lieu, FALSE sinon (FALSE si le couple idChambre/idType n'existe pas)
     */
    function modifierPrixChambre()
    {
        if($this->existeDeja())
        {
            $requete        = 'UPDATE prixChambre SET prix = ? WHERE idChambre_chambre = ? AND idType_typeSejour = ?';
            $tabParametres  = array($this->m_prix, $this->m_chambre->getIdChambre(), $this->m_type->getIdType());
            return $this->m_bdd->modifier($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Cette méthode supprime une entrée TypeSejour/Chambre dans la bdd (table prixChambre)
     * @return boolean TRUE si la requête s'est correctement déroulée, FALSE sinon (FALSE si l'association n'existait pas)
     */
    function supprimerPrixChambre()
    {
        if($this->existeDeja())
        {
            $requete        = 'DELETE FROM prixChambre WHERE idChambre_chambre = ? AND idType_typeSejour = ?';
            $tabParametres  = array($this->m_chambre->getIdChambre(), $this->m_type->getIdType());
            return $this->m_bdd->supprimer($requete, $tabParametres);
        }
        return FALSE;
    }
    
    function setPrix($prix)
    {
        $this->m_prix = $prix;
    }
            
    function getPrix()
    {
        return $this->m_prix;
    }
    
    /**
     * Retourne l'objet Chambre courant
     * @return Chambre l'objet pour manipuler la chambre
     */
    function getChambre()
    {
        return $this->m_chambre;
    }
    
    /**
     * Retourne l'objet TypeSejour courant
     * @return TypeSejour l'objet pour manipuler le type de sejour
     */
    function getTypeSejour()
    {
        return $this->m_type;
    }
    
    function __toString()
    {
        $str  = '===PRIX_CHAMBRE===<br/>';
        $str = 'ID CHAMBRE : '.$this->m_chambre->getIdChambre().' --- ';
        $str .= 'ID TYPE SEJOUR : '.$this->m_type->getIdType().' --- ';
        $str .= 'PRIX : '.$this->m_prix.'<br/>';
        $str .= '==================<br/>';
        return $str;
    }
}

?>
