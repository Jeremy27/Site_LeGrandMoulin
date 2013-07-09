<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reservation
 *
 * @author jeremy
 */
class Reservation 
{
    private $m_idReservation;
    private $m_civilite;
    private $m_nom;
    private $m_prenom;
    private $m_telephone;
    private $m_email;
    private $m_codePostal;
    private $m_ville;
    private $m_adresse;
    private $m_dateDebut;
    private $m_nbNuit;
    private $m_chambre;
    private $m_typeSejour;
    
    /**
     * new Reservation(strCivilite, strNom, strPrenom, strTelephone, strEmail, strCodePostal, strVille, strAdresse, strDate, iNbNuit, idChambre, idTypeSejour)
     * new Reservation(idReservation)
     */
    function __construct()
    {
        $this->m_bdd = new BaseDeDonnees();
        $nbParam    = func_num_args();
        $tabParam   = func_get_args();
        
        if($nbParam == 1 && is_numeric($tabParam[0]))
            $this->constructId($tabParam[0]);
        else if($nbParam == 12)
        {
            $this->m_civilite   = $tabParam[0];
            $this->m_nom        = $tabParam[1];
            $this->m_prenom     = $tabParam[2];
            $this->m_telephone  = $tabParam[3];
            $this->m_email      = $tabParam[4];
            $this->m_codePostal = $tabParam[5];
            $this->m_ville      = $tabParam[6];
            $this->m_adresse    = $tabParam[7];
            $this->m_dateDebut  = $tabParam[8];
            $this->m_nbNuit     = $tabParam[9];
            $this->m_chambre    = new Chambre($tabParam[10]);
            $this->m_typeSejour = new TypeSejour($tabParam[11]);
        }
    }
    
    function constructId($idReservation)
    {
        $requete        = 'SELECT * FROM reservation WHERE idReservation = ?';
        $tabParametres  = array($idReservation);
        $tabResultats   = $this->m_bdd->selection($requete, $tabParametres);

        $this->m_idReservation  = $idReservation;
        $this->m_civilite       = $tabResultats[0]["civilite"];
        $this->m_nom            = $tabResultats[0]["nom"];
        $this->m_prenom         = $tabResultats[0]["prenom"];
        $this->m_telephone      = $tabResultats[0]["telephone"];
        $this->m_email          = $tabResultats[0]["email"];
        $this->m_codePostal     = $tabResultats[0]["codePostal"];
        $this->m_ville          = $tabResultats[0]["ville"];
        $this->m_adresse        = $tabResultats[0]["adresse"];
        $this->m_dateDebut      = $tabResultats[0]["dateDebut"];
        $this->m_nbNuit         = $tabResultats[0]["nbNuit"];
        $this->m_chambre        = new Chambre($tabResultats[0]["idChambre_chambre"]);
        $this->m_typeSejour     = new TypeSejour($tabResultats[0]["idType_typeSejour"]);
    }
    
    /**
     * Vérifie si la reservation existe déjà dans la base de données en fonction de l'id
     * @return boolean TRUE si la reservation existe déjà, FALSE sinon
     */
    function idExisteDeja()
    {
        $requete        = 'SELECT * FROM reservation WHERE idReservation = ?';
        $tabParametres  = array($this->m_idReservation);
        $tabResultat    = $this->m_bdd->selection($requete, $tabParametres);
        if(empty($tabResultat))
            return FALSE;
        return TRUE;
    }
    
    function reservationExisteDeja()
    {
        
    }
    
    /**
     * Fonction qui initialise l'idReservation (elle sert quand on effectue un ajout et qu'on a toujours pas l'id de l'option)
     */
    function initialiserId()
    {
        if(empty($this->m_idReservation))
        {
            $requete                = 'SELECT idReservation FROM reservation WHERE nom=? AND prenom=? AND dateDebut=? AND idChambre_chambre=? AND idType_typeSejour=?';
            $tabParametres          = array($this->m_nom, $this->m_prenom, $this->m_dateDebut, $this->m_chambre->getIdChambre(), $this->m_typeSejour->getIdType());
            $tabResultat            = $this->m_bdd->selection($requete, $tabParametres);
            $this->m_idReservation  = $tabResultat[0]['idReservation']; 
        }
    }
    
    /**
     * Ajoute un reservation dans la table reservation a condition que celle ci n'existe pas déjà
     * @return boolean TRUE si l'ajout s'est bien déroulé, FALSE sinon
     */
    function ajouterReservation()
    {
        $requete        = 'INSERT INTO reservation VALUES ("", ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $tabParametres  = array($this->m_civilite, $this->m_nom, $this->m_prenom, $this->m_telephone, $this->m_email, $this->m_codePostal, $this->m_ville, 
                                $this->m_adresse, $this->m_dateDebut, $this->m_nbNuit, $this->m_chambre->getIdChambre(), $this->m_typeSejour->getIdType());
        $valRetour      = $this->m_bdd->ajouter($requete, $tabParametres);
        if($valRetour != FALSE)
            $this->initialiserId();
        return $valRetour;
    }
    
    /**
     * Modifie une reservation a condition que celle-ci existe dans la bdd
     * @return boolean TRUE si la modification s'est bien passée, FALSE sinon
     */
    function modifierReservation()
    {
        $this->initialiserId();
        if($this->idExisteDeja())
        {
            $requete        = 'UPDATE reservation SET civilite=?, nom=?, prenom=?, telephone=?, email=?, codePostal=?, ville=?, adresse=?, 
                                dateDebut=?, nbNuit=?, idChambre_chambre=?, idType_typeSejour=? WHERE idReservation=?';
            $tabParametres  = array($this->m_civilite, $this->m_nom, $this->m_prenom, $this->m_telephone, $this->m_email, $this->m_codePostal, $this->m_ville, 
                                $this->m_adresse, $this->m_dateDebut, $this->m_nbNuit, $this->m_chambre->getIdChambre(), $this->m_typeSejour->getIdType(), 
                                $this->m_idReservation);
            return $this->m_bdd->modifier($requete, $tabParametres);
        }
        return FALSE;
    }
    
    /**
     * Supprime une reservation si elle existe bien
     * @return boolean TRUE si la suppression s'est bien passée, FALSE sinon
     */
    function supprimerReservation()
    {
        $this->initialiserId();
        if($this->idExisteDeja())
        {
            $requete        = 'DELETE FROM reservation WHERE idReservation = ?';
            $tabParametres  = array($this->m_idReservation);
            return $this->m_bdd->supprimer($requete, $tabParametres);
        }
        return FALSE;
    }
    
    function getIdReservation()
    {
        $this->initialiserId();
        return $this->m_idReservation;
    }
    
    function getCivilite()
    {
        return $this->m_civilite;
    }
    
    function getNom()
    {
        return $this->m_nom;
    }
    
    function getPrenom()
    {
        return $this->m_prenom;
    }
    
    function getTelephone()
    {
        return $this->m_telephone;
    }
    
    function getEmail()
    {
        return $this->m_email;
    }
    
    function getCodePostal()
    {
        return $this->m_codePostal;
    }
    
    function getVille()
    {
        return $this->m_ville;
    }
    
    function getAdresse()
    {
        return $this->m_adresse;
    }
    
    function getDateDebut()
    {
        return $this->m_dateDebut;
    }
    
    function getNbNuit()
    {
        return $this->m_nbNuit;
    }
    
    function getChambre()
    {
        return $this->m_chambre;
    }
    
    function getTypeSejour()
    {
        return $this->m_typeSejour;
    }
    
    function setCivilite($civilite)
    {
        $this->m_civilite = $civilite;
    }
    
    function setNom($nom)
    {
        $this->m_nom = $nom;
    }
    
    function setPrenom($prenom)
    {
        $this->m_prenom = $prenom;
    }
    
    function setTelephone($telephone)
    {
        $this->m_telephone = $telephone;
    }
    
    function setEmail($email)
    {
        $this->m_email = $email;
    }
    
    function setCodePostal($codePostal)
    {
        $this->m_codePostal = $codePostal;
    }
    
    function setVille($ville)
    {
        $this->m_ville = $ville;
    }
    
    function setAdresse($adresse)
    {
        $this->m_adresse = $adresse;
    }
    
    function setDateDebut($dateDebut)
    {
        $this->m_dateDebut = $dateDebut;
    }
    
    function setNbNuit($nbNuit)
    {
        $this->m_nbNuit = $nbNuit;
    }
    
    function setChambre($chambre)
    {
        $this->m_chambre = $chambre;
    }
    
    function setTypeSejour($typeSejour)
    {
        $this->m_typeSejour = $typeSejour;
    }
    
    function __toString()
    {
        $str = '<dd>ID : '.$this->m_idReservation.' --- ';
        $str .= 'CIVILITE : '.$this->m_civilite.' --- ';
        $str .= 'NOM : '.$this->m_nom.' --- ';
        $str .= 'PRENOM : '.$this->m_prenom.' --- ';
        $str .= 'TELEPHONE : '.$this->m_telephone.' --- ';
        $str .= 'EMAIL : '.$this->m_email.' --- ';
        $str .= 'CP : '.$this->m_codePostal.' --- ';
        $str .= 'VILLE : '.$this->m_ville.' --- ';
        $str .= 'ADRESSE : '.$this->m_adresse.' --- ';
        $str .= 'DATE DEBUT : '.$this->m_dateDebut.' --- ';
        $str .= 'NB NUIT : '.$this->m_nbNuit.' --- ';
        $str .= 'ID CHAMBRE : '.$this->m_chambre->getIdChambre().' --- ';
        $str .= 'ID TYPESEJOUR : '.$this->m_typeSejour->getIdType().'</dd>';
        return $str;
    }
}

?>
