<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of baseDeDonnees
 *
 * @author mathieu
 */
class BaseDeDonnees
{
    private $m_nomBdd           = 'LeGrandMoulin';
    private $m_hoteBdd          = 'localhost';
    private $m_loginBdd         = 'LeGrandMoulin';
    private $m_motDePasseBdd    = 'lgm';
    private $m_connexion;
    private $m_email = 'mathieu.courel@gmail.com, courel.jeremy@gmail.com';
    
    public function __construct()
    {
        try  
        { 
            $this->m_connexion = new PDO($this->getDns(), $this->m_loginBdd, $this->m_motDePasseBdd);
            $this->m_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } 
        catch(PDOException $e) 
        { 
            echo 'catch';
            //On indique par email qu'on n'a plus de connection disponible 
            mail($this->m_email, 'Urgent: Problème de connexion à la Base de données', date('D/m/y').' à '.date("H:i:s").' : '.$e->getMessage());
        } 
    }
    
    // Renvoie le dns permettant la connexion à la base de données
    private function getDns()
    {
        $dns = "mysql:dbname=$this->m_nomBdd;host=$this->m_hoteBdd";
        return $dns;
    }
    
    /* ------------------------------------------------- Fonctions permettants le select, l'update et le delete ------------------------------------------------- */
    public function selection($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        $requetePreparee->execute($tabParametres);
        
        $tableau = array();
        while ($ligne = $requetePreparee->fetch())
            array_push ($tableau, $ligne);
        
        return $tableau;
    }
    
    public function ajouter($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        return $requetePreparee->execute($tabParametres);
    }
    
    public function modifier($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        return $requetePreparee->execute($tabParametres);
    }
  
    public function supprimer($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        return $requetePreparee->execute($tabParametres);
    }
    
    
}

?>
