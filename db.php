<?php

class db
{
    private $host;
    private $user;
    private $db;
    private $pass;
    private $conn;


    public function __construct($host, $user, $db, $pass)
    {
        $this->conn = new PDO('pgsql:dbname='.$db.' host='.$host.'', $user, $pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

     public function deleteChoriste($login)
    {
    $query = "DELETE FROM utilisateur
        WHERE login='$login'";
    $sth = $this->conn->prepare($query);
    $sth->execute();
    }
    public function setValidTresor($login)
    {
    $query = "UPDATE utilisateur
        SET valitresorier='t'
        WHERE login='$login'";
    $sth = $this->conn->prepare($query);
    $sth->execute();
    }
    public function setValidWebmaster($login)
    {
    $query = "UPDATE utilisateur
        SET valiwebmaster='t'
        WHERE login='$login'";
    $sth = $this->conn->prepare($query);
    $sth->execute();
    }
    public function getToValidTresorier()
    {
    $query = "SELECT * FROM utilisateur NATURAL JOIN choriste
        WHERE valitresorier='f' AND valiwebmaster='t' ";
    $sth = $this->conn->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll();
    return $result;
    }
    public function getToValidWebmaster()
    {
    $query = "SELECT * FROM utilisateur NATURAL JOIN choriste WHERE valiwebmaster='f'";
    $sth = $this->conn->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll();
    return $result;
    }
    public function setPassword($login, $pw)
    {
    $query = "UPDATE utilisateur
        SET motdepasse='".md5($pw)."'
        WHERE login='$login'";
    $sth = $this->conn->prepare($query);
    $sth->execute();
    }
    public function setProfil($login, $nom, $prenom, $ville, $tel)
    {
    $query = "UPDATE choriste
        SET nom='$nom', prenom='$prenom', ville='$ville', telephone='$tel'
        WHERE login='$login'";
    $sth = $this->conn->prepare($query);
    $sth->execute();
    }

    public function getProfil($login)
    {
    $query = "SELECT * FROM choriste WHERE login='".$login."'";
    $sth = $this->conn->prepare($query);
    $sth->execute();
    $result = $sth->fetch();
    return $result;
    }

    public function newChoriste($nom, $prenom, $voix, $ville, $tel, $login, $type)
    {
        $query = "INSERT INTO choriste(nom, prenom, idVoix, ville, telephone, login, idInscription) VALUES ('$nom', '$prenom', '$voix', '$ville', '$tel', '$login', '$type')";
        $sth = $this->conn->prepare($query);
        $sth->execute();
       
    }
    public function newUser($login, $pw)
    {
        $query = "INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier) VALUES ('$login', '$pw', false, false)";
        $sth = $this->conn->prepare($query);
        $sth->execute();
       
    }

    public function getTypeInscription()
    {
        $query = "SELECT * FROM inscription";
        $sth = $this->conn->prepare($query);
        $sth->execute();
       
        $result = $sth->fetchAll();
        return $result;
    }
    public function getVoix()
    {
        $query = "SELECT * FROM voix";
        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function getUtilisateur($login, $mdp)
    {
        $query = "SELECT * FROM utilisateur WHERE login='".$login."' AND motdepasse='".$mdp."'";
        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;
    }

    public function getAllChoristes()
    {
        $query = "SELECT choriste.nom, choriste.prenom, voix.typevoix,choriste.idvoix, array_agg(responsabilite.titre) as responsabilite
                  FROM voix NATURAL JOIN choriste NATURAL JOIN utilisateur
                  LEFT OUTER JOIN responsabilite ON utilisateur.login=responsabilite.login
                  GROUP BY choriste.nom, choriste.prenom, voix.typevoix, choriste.idvoix
                  ORDER BY idvoix,typevoix,nom,prenom;";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

    public function getStylesSaison($idSaison)
    {
        $query = "SELECT DISTINCT intitule FROM TypeEvt natural join evenement
                  INNER JOIN est_au_programme on idEvenement=Evenement.idEvenement
                  INNER JOIN oeuvre ON oeuvre.idOeuvre=idOeuvre
                  INNER JOIN style ON style.idStyle = oeuvre.idStyle
                  NATURAL JOIN statutOeuvre
                  WHERE typeevt LIKE 'Saison'and idEvenement='".$idSaison."'";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

    public function getTitreOeuvreByStyle($idSaison, $style)
    {
       $query = "SELECT DISTINCT titre
                 FROM est_au_programme NATURAL JOIN oeuvre
                 INNER JOIN style ON style.idStyle = oeuvre.idStyle
                 WHERE intitule='".$style."'
                 AND evenement_idEvenement = ".$idSaison."";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

     public function getConcerts()
    {
        $query = "(SELECT idevenement,nom, heureDate, lieu 
                  FROM Evenement NATURAL JOIN TypeEvt 
                  WHERE typeevt LIKE 'Concert' AND heureDate > NOW() 
                  ORDER BY heureDate) 
                  UNION ALL 
                  (SELECT idevenement,nom, heureDate, lieu 
                   FROM Evenement NATURAL JOIN TypeEvt 
                   WHERE typeevt LIKE 'Concert' AND heureDate < NOW() 
                   ORDER BY heureDate LIMIT 5);";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;        

    }

    public function getNbVoixByConcert($idevenement, $voix)
    {
        $query = "SELECT count(*) 
                  FROM choriste NATURAL JOIN voix INNER JOIN participe ON idchoriste=choriste_idchoriste INNER JOIN evenement ON idevenement=evenement_idevenement 
                  WHERE typevoix='".$voix."' AND idevenement=".$idevenement.";";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;
    }



    public function getAllSaisons()
    {
        $query = "SELECT idevenement, nom FROM evenement NATURAL JOIN TypeEvt WHERE typeevt LIKE 'Saison'";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

    public function getStatusOeuvre($oeuvre)
    {
        $query = "SELECT idstatut FROM oeuvre WHERE titre='".$oeuvre."'";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;
    }

    public function getStats()
    {
        $query = "(select a.idChoriste, a.nom, a.prenom, a.idvoix, a.ville, a.telephone, array_agg(responsabilite.titre) as responsabilite,
        (select count(idEvenement) 
        from choriste left outer join participe on idChoriste = choriste_idchoriste 
        left outer join evenement on evenement_idevenement=idevenement 
        natural join typeevt 
        where typeevt = 'Répétition' and idEvenement is not null and a.idchoriste=idchoriste and 
        indecis='False' and heureDate < now()) as nb_presence, 
        (select count(idevenement) from typeevt natural join evenement 
        inner join participe on idevenement=evenement_idevenement 
        where typeevt = 'Répétition' and heureDate < now()) as nb_repete 
        from choriste a inner join utilisateur on utilisateur.login=a.login left outer join responsabilite on responsabilite.login=utilisateur.login
        group by a.idChoriste) 
        ORDER BY idvoix;";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }



    public function getAllOeuvreSaisons($idSaison)
    {
        $query = "SELECT titre
                 FROM est_au_programme NATURAL JOIN oeuvre
                 WHERE evenement_idEvenement = ".$idSaison."";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;
    }

    public function getRepetitions($login)
    {
        $query = "SELECT idevenement,heuredate,lieu,evenement.nom,indecis,idchoriste
        FROM typeevt natural join evenement
        left outer join participe on idevenement=evenement_idevenement 
        left outer JOIN choriste ON choriste_idchoriste = idchoriste AND login = '".$login."'
        WHERE  typeevt LIKE 'Répétition' AND heureDate > NOW()
        ORDER BY heureDate;";
        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;        

    }

    public function getParticipe($idChoriste, $idEvent)
    {
        $query = "SELECT COUNT(*) FROM participe WHERE Choriste_idChoriste='".$idChoriste."' AND Evenement_IdEvenement='".$idEvent."';";
        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;     

    }

    public function setParticipe($idChoriste, $idEvent, $insert)
    {
        $query = "DELETE FROM participe WHERE Choriste_idChoriste='".$idChoriste."' AND Evenement_IdEvenement='".$idEvent."';";
        $sth = $this->conn->prepare($query);
        $sth->execute();
        if($insert != '')
        {
            $sth = $this->conn->prepare($insert);
            $sth->execute();  
        }
    }

    public function getChoristeId($login)
    {
        $query = "SELECT * FROM choriste WHERE login='".$login."';";
        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;
    }

    /* Modif pour les droits 14/04/2014 */
    public function getResponsabiliteByLogin($login, $responsabilite)
    {
        $query ="";

        if(strcmp($responsabilite, "Choriste") == 0)
        {
            $query = "SELECT count(*) as resp
                      FROM choriste
                      WHERE login ='".$login."';";
        }

        else
        {
            $query = "SELECT count(*) AS resp
                      FROM utilisateur NATURAL JOIN responsabilite
                      WHERE login='".$login."' AND titre like '".$responsabilite."';";
       }

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        if ($result["resp"] == 1) return true;
        else return false;            
    }

    /* Fin Modif */

        public function getChoriste($login)
    {
        $query = "SELECT * FROM utilisateur WHERE login='".$login."'";
        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;
    }

     public function getAllStyle()
    {
        $query = "SELECT * FROM style";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

    public function getStyle($idStyle)
    {
        $query = "SELECT intitule FROM style WHERE idStyle=".$idStyle."";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;

    }

    public function getAllTypeevt()
    {
        $query = "SELECT * FROM typeevt";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

    public function getTypeevt($concert, $repetition)
    {
        $query = "SELECT * FROM typeevt WHERE typeevt=".$concert." AND typeevt=".$repetition."";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

    public function getAllOeuvre()
    {
        $query = "SELECT * FROM oeuvre";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

    public function insertEvenement($idtypeevt, $nom, $heureDate, $lieu)
    {
        $query = "INSERT INTO evenement(idTypeEvt, heuredate, lieu, nom)
                              VALUES (:idtypeevt, :heuredate, :lieu, :nom) RETURNING idevenement";

        if($idtypeevt != 3)
        {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idtypeevt', $idtypeevt);
            $stmt->bindParam(':heuredate', $heureDate);
            $stmt->bindParam(':lieu', $lieu);
            $stmt->bindParam(':nom', $nom);
        }
        else
        {
            $null = NULL;
            $empty ='';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idtypeevt', $idtypeevt);
            $stmt->bindParam(':heuredate', $null);
            $stmt->bindParam(':lieu', $empty);
            $stmt->bindParam(':nom', $value);
        }

        $stmt->execute();
        $result = $stmt->fetchColumn();

        return $result;

    }

    public function addOeuvreToEvenement($idOeuvre, $idEvenement)
    {
        $query = "INSERT INTO est_au_programme(oeuvre_idoeuvre, evenement_idevenement)
                  VALUES (:idOeuvre, :idEvenement)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idOeuvre', $idOeuvre);
        $stmt->bindParam(':idEvenement', $idEvenement);

        $stmt->execute();
    }

    private function verifyStyle($style_name){
    
    if($style_name == "") {
        return 0 ;
    }

    $query = "SELECT idstyle FROM style WHERE intitule ='".$style_name."'";
        $sth = $this->conn->prepare($query);
        if($sth->execute()){
            $result = $sth->fetch();
    }
    
    else {
        $result = null ;
    }

        return $result;
  }

  public function InsertOeuvre($titre,$auteur,$partition,$duree,$id_statut,$style_name){

    $id_style = $this->verifyStyle($style_name) ;

    if($id_style == 0){
        return null;
    }

    //le style n'existe pas on l'insert
    if($id_style == null){
        $query = "INSERT INTO style (intitule) VALUES (:intitule) RETURNING idstyle" ;
        $sth = $this->conn->prepare($query);
        $sth->bindValue(':intitule',$style_name,PDO::PARAM_STR) ;
        $sth->execute();

        //récup nouveau id_style
        $id_style['idstyle'] = $sth->fetchColumn() ; 
    }
    
    $query = "INSERT INTO oeuvre (titre,auteur,partition,duree,idstyle,idstatut) VALUES (:titre,:auteur,:partition,:duree,:idstyle,:idstatut)" ;
        $sth = $this->conn->prepare($query);
    
    if($titre=="" || $auteur=="" || $partition=="" || $duree==""){
        return null ;
    }

        $sth->bindValue(':titre',$titre,PDO::PARAM_STR) ;
        $sth->bindValue(':auteur',$auteur,PDO::PARAM_STR) ;
        $sth->bindValue(':partition',$partition,PDO::PARAM_STR) ;
        $sth->bindValue(':duree',$duree,PDO::PARAM_INT) ;
        $sth->bindValue(':idstyle',$id_style['idstyle'],PDO::PARAM_INT) ;
        $sth->bindValue(':idstatut',$id_statut,PDO::PARAM_INT) ;
        $result = $sth->execute();
    return $result ;
  }

  public function getType($type)
    {
        $query = "SELECT * FROM typeevt WHERE typeevt='".$type."'";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetch();

        return $result;

    }

    public function insertSaison($idtypeevt, $nom)
    {
        $query = "INSERT INTO evenement(idTypeEvt, heuredate, lieu, nom)
                              VALUES (:idtypeevt, :heuredate, :lieu, :nom) RETURNING idevenement";
            $null = null;
            $empty = '';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idtypeevt', $idtypeevt);
            $stmt->bindParam(':heuredate', $null);
            $stmt->bindParam(':lieu', $empty);
            $stmt->bindParam(':nom', $nom);

            $stmt->execute();
            $result = $stmt->fetchColumn();

            return $result;

    }

        public function getAllOeuvreStyle()
    {
        $query = "SELECT *
                  FROM statutoeuvre NATURAL JOIN oeuvre
                  NATURAL JOIN style
                  ORDER BY titre";

        $sth = $this->conn->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }



}
