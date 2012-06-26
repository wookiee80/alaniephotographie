<?php
/**
 *Classe Album
 * @author: Wookiee
 * @version 1.01 
 * 
 **/
class Album
{
    //attributs:
    private $_id;
    private $_titre;
    private $_date;
    private $_intro;
    private $_dir;
    private $_categorie;
    
    //constructeur:
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    
    // fonction pour hydrater un objet:
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) 
        {
           $method = 'set'.ucfirst($key);
           
           if(method_exists($this, $method))
           {
               $this->$method($value);
           }
        }
    }

        //les accesseurs:
    public function id()
    {
        return $this->_id;
    }
    
    public function titre()
    {
        return $this->_titre;
    }
    
    public function date()
    {
        return $this->_date;
    }
    
    public function intro()
    {
        return $this->_intro;
    }
    
    public function dir()
    {
        return $this->_dir;
    }
    
    public function categorie()
    {
        return $this->_categorie;
    }

    public function setTitre($titre)
    {
        if(!is_string($titre))
        {
            trigger_error('Le Titre d\'un album doit être une chaine de caractères', E_USER_WARNING);
        }
        
        if(strlen($titre) > 255)
        {
            trigger_error('Le titre est trop long !', E_USER_WARNING);
        }
        
        $this->_titre = $titre;
    }
    
    public function setDate($date)
    {
        $this->_date = $date;
    }
    
    public function setIntro($intro)
    {
        $this->_intro = $intro;
    }
    
    public function setDir($dir)// $photos représente un tableau contenant toutes les photos d'un album
    {
        // on se sert d'une regex pour dans un 1er temps
        // supprimer les espaces, puis une seconde qui elle va
        // supprimer tout caractère spécial ou accentué.
        $regex = preg_replace('#\s+#', '', $dir);
        $regexbis = preg_replace('#\W+|ù|é|è|à#', '', $regex);
        $this->_dir = $regexbis;
    }
    
    public function setCategorie($categorie)
    {
        $this->_categorie = $categorie;
    }


    public function createDir()
    {
        if(!is_dir('server/php/'.$this->_dir))
        {
            $old = umask(0);
            mkdir('server/php/'.$this->_dir,0777);
            mkdir('server/php/'.$this->_dir.'/thumbnails',0777);
            umask($old); 
        }

    }
}