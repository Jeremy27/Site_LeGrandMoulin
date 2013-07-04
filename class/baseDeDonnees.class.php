<?php

class BaseDeDonnees
{
    private $m_nomBdd           = 'LeGrandMoulin';
    private $m_hoteBdd          = 'localhost';
    private $m_loginBdd         = 'LeGrandMoulin';
    private $m_motDePasseBdd    = 'lgm';
    private $m_connexion;
    private $m_email = 'mathieu.courel@gmail.com, courel.jeremy@gmail.com';
    
    /**
     * Création de la connexion
     * Si une erreur survient alors un mail sera envoyé aux deux admin
     */
    public function __construct()
    {
        try  
        { 
            $this->m_connexion = new PDO($this->getDns(), $this->m_loginBdd, $this->m_motDePasseBdd);
            $this->m_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } 
        catch(PDOException $e) 
        { 
            mail($this->m_email, 'Urgent: Problème de connexion à la Base de données', date('D/m/y').' à '.date("H:i:s").' : '.$e->getMessage());
        } 
    }
    
    /**
     * @return String : dns permettant la connexion à la base de données
     */
    private function getDns()
    {
        $dns = "mysql:dbname=$this->m_nomBdd;host=$this->m_hoteBdd";
        return $dns;
    }
    
    /**
     * Cette méthode prend en paramètres la requête à executer et le tableau de paramètre pour la requête préparée, elle est utilisée pour 
     * lire des données dans la base de donnnées
     * @param String $requete ce paramètre correspond à la requête au format préparé (contenant donc des `?`)
     * @param array $tabParametres ce paramètre correspond aux valeur à insérer dans la requête préparée
     * @return array un tableau multidimensionnel contenant les resultats de la requete
     */
    public function selection($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        $requetePreparee->execute($tabParametres);
        
        $tableau = array();
        while ($ligne = $requetePreparee->fetch())
            array_push ($tableau, $ligne);
        
        return $tableau;
    }
  
    /**
     * Cette méthode prend en paramètres la requête à executer et le tableau de paramètre pour la requête préparée, elle est utilisée pour 
     * ajouter un élément dans la bdd
     * @param String $requete ce paramètre correspond à la requête au format préparé (contenant donc des `?`)
     * @param array $tabParametres ce paramètre correspond aux valeur à insérer dans la requête préparée
     * @return boolean retourne TRUE ou FALSE en fonction de si la requete s'est bien passée ou pas
     */
    public function ajouter($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        return $requetePreparee->execute($tabParametres);
    }
    
    /**
     * Cette méthode prend en paramètres la requête à executer et le tableau de paramètre pour la requête préparée, elle est utilisée pour 
     * modifier un élément déjà existant dans la bdd
     * @param String $requete ce paramètre correspond à la requête au format préparé (contenant donc des `?`)
     * @param array $tabParametres ce paramètre correspond aux valeur à insérer dans la requête préparée
     * @return boolean retourne TRUE ou FALSE en fonction de si la requete s'est bien passée ou pas
     */
    public function modifier($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        return $requetePreparee->execute($tabParametres);
    }
  
    /**
     * Cette méthode prend en paramètres la requête à executer et le tableau de paramètre pour la requête préparée, elle est utilisée pour 
     * supprimer un élément existant dans la bdd
     * @param String $requete ce paramètre correspond à la requête au format préparé (contenant donc des `?`)
     * @param array $tabParametres ce paramètre correspond aux valeur à insérer dans la requête préparée
     * @return boolean retourne TRUE ou FALSE en fonction de si la requete s'est bien passée ou pas
     */
    public function supprimer($requete, $tabParametres)
    {
        $requetePreparee = $this->m_connexion->prepare($requete);
        return $requetePreparee->execute($tabParametres);
    }
}

?>
