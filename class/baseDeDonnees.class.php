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
class baseDeDonnees extends PDO {
    private $m_nomBdd = 'LeGrandMoulin';
    private $m_hoteBdd = 'localhost';
    private $m_loginBdd = 'LeGrandMoulin';
    private $m_motDePasseBdd = 'lgm';
    private $m_connexion;
    private $m_email = 'mathieu.courel@gmail.com, courel.jeremy@gmail.com';
    
    public function __construct()
    {
        try  
        { 
            $this->m_connexion = parent::__construct($this->getDns(), $this->m_loginBdd, $this->m_motDePasseBdd); 
            // pour mysql on active le cache de requête 
            if($this->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') 
                $this->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); 
            return $this->m_connexion; 
        } 
        catch(PDOException $e) 
        { 
            echo 'catch';
            //On indique par email qu'on n'a plus de connection disponible 
            mail($this->m_email, 'Urgent; Problème de connexion à la Base de données', date('D/m/y').' à '.date("H:i:s").' : '.$e->getMessage());
        } 
    }
    
    // Renvoie le dns permettant la connexion à la base de données
    private function getDns()
    {
        return 'mysql:dbname='.$this->m_nomBdd.';host='.$this->m_hoteBdd;
    }
    
    /* ------------------------------------------------- Fonctions permettants le select, l'update et le delete ------------------------------------------------- */
    public function selection($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        $i = 0;
        foreach ($tabParametres as $parametre) 
        {
            $requetePreparee->bindParam($i, $parametre);
            $i++;            
        }
        $requetePreparee->execute();
        
        return $requetePreparee->fetch(PDO::FETCH_ASSOC);
    }
    
    public function modifier($requete, $tabParametres)
    {
        
    }
  
    public function supprimer($requete, $tabParametres)
    {
        
    }
}

?>
