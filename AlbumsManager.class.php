<?php
/**
 *Classe AlbumsManager
 * @author: wookiee 
 **/
class AlbumsManager
{
    private $_db;
    
    //accesseurs:
    public function setDb($db)
    {
        $this->_db = $db;
    }
    
    //constructeur:
    public function __construct($db)
    {
        $this->setDb($db);
    }
    
    public function addAlbum(Album $album)
    {
        // On prépare la requète pour ajouter un album à la bdd:
        $q = $this->_db->prepare('INSERT INTO albums SET titre=:titre,
                                                         date=:date,
                                                         intro=:intro,
                                                         dir=:dir,
                                                         categorie=:categorie');
        
        // puis on assigne les valeurs de notre objet album:
        $q->bindValue('titre',$album->titre());
        $q->bindValue('date',$album->date());
        $q->bindValue('intro',$album->intro());
        $q->bindValue('dir',$album->dir());
        $q->bindValue('categorie',$album->categorie());
        
        // puis on execute la requète:
        $q->execute();
        $album->createDir();
        // on hydrate alors l'album passé en paramètre avec son id:
        $album->hydrate(array('id'=>  $this->_db->lastInsertId()));
    }
    
    public function updateAlbum(Album $album)
    {
        //pour modifier un album déjà créé:
        $q = $this->_db->prepare('UPDATE albums SET titre=:titre,
                                                    date=:date, 
                                                    intro=:intro,
                                                    categorie=:categorie,
                                   WHERE id=:id');
        
        $q->bindValue('titre',$album->titre());
        $q->bindValue('date',$album->date());
        $q->bindValue('intro',$album->intro());
        $q->binValue('categorie',$album->categorie());
        
        $q->execute();
    }
    
    public function deleteAlbum(Album $album)
    {
        $this->_db->exec('DELETE FROM albums WHERE id='.$album->id());
    }
    
    public function getAlbum($infos)
    {
        if(is_int($infos))
        {
        $q = $this->_db->prepare('SELECT id, titre, date, intro, dir, categorie
                                  FROM albums
                                  WHERE id='.$infos);
        
        $albumRecup = $q->fetch(PDO::FETCH_ASSOC);
        
        return new Album($albumRecup);
        }
        
        elseif (is_string($infos))
        {
            $q = $this->_db->prepare('SELECT id, titre, date, intro, dir, categorie
                                      FROM albums
                                      WHERE titre=:titre');
            $q->execute(array(':titre'=>$infos));
        
        return new Album($q->fetch(PDO::FETCH_ASSOC));
        
        }
    }
    
    public function getListAlbum()
    {
        $albums = array();
        
        $q = $this->_db->prepare('SELECT id, titre, date, intro, dir, categorie
                                  FROM albums 
                                  ORDER BY date DESC');
        $q->execute();
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            
            $albums[] = new Album($donnees);

        }
        return $albums;
    }
    
    public function existAlbum($titre)
    {
        // savoir si un album existe.
        // On veut voir si tel album avec tel titre existe
            
            $q = $this->_db->prepare('SELECT COUNT(*) FROM albums WHERE titre =:titre');
            $q->execute(array(':titre'=>$titre));
            
            return (bool) $q->fetchColumn();
            
            
    }
}
