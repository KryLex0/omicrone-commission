<?php

class consultantn {
    private $_id;
    private $_nom;
    private $_prenom;
    private $_tel;
    private $_email;
    private $_adr;
    private $_ville;
    private $_cp;

    public function __construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel, $unEmail)
    {
        $this->_nom = $unNom;
        $this->_prenom=$unPrenom;
        $this->_adr=$uneAdresse;
        $this->_ville=$uneVille;
        $this->_cp=$unCp;
        $this->_tel=$unTel;
        $this->_email=$unEmail;   
    }
    
        public function getId(){
            return $this->_id;
        }
        public function getNom(){
            return($this->_nom);
        }
            
        public function getPrenom(){
            return($this->_prenom);
        }
        public function getAdresse(){
            return($this->_adr);
        }
        public function getVille(){
            return($this->_ville);
        }
        public function getCp(){
            return($this->_cp);
        }
        public function getTel(){
            return($this->_tel);
        }
        public function getEmail(){
            return($this->_email);
        }
    
}

class consultantDao {
        public function add($consultant){

        
        $nom= $consultant->getNom();
        $prenom= $consultant->getPrenom();
        $adr=$consultant->getAdresse();
        $ville=$consultant->getVille();
        $cp=$consultant->getCp();
        $tel= $consultant->getTel();
        $email= $consultant->getEmail();

        $leconsultant = R::dispense('consultant'); // on crée un consultant
        $leconsultant->nom = $nom; // on lui donne les champs
        $leconsultant->prenom = $prenom;
        $leconsultant->adr=$adr;
        $leconsultant->ville=$ville;
        $leconsultant->cp=$cp;
        $leconsultant->tel=$tel;
        $leconsultant->email=$email;
        
        R::store($leconsultant); // on le sauvegarde en BDD
        
    }
    public function getCollectionConsultant()/*retourne une collection de consultants*/ 
        {
            $lesConsultant=array();
            $les = R::getAll('select nom, prenom , adr, ville, cp, tel, email from consultant where cacher = false order by id desc');
            foreach ($les as $depe){
                $uncons=new consultant($depe["nom"],$depe["prenom"],$depe["adr"],$depe["ville"],$depe["cp"],$depe["tel"],$depe["email"]);
                $lesConsultant[]=$uncons;
            }
            return($lesConsultant);
        }

       public function getIdConsultantFromobject($consultant){

        $nom= $consultant->getNom();
        $prenom= $consultant->getPrenom();
        $adr=$consultant->getAdresse();
        $ville=$consultant->getVille();
        $cp=$consultant->getCp();
        $tel= $consultant->getTel();
        $email= $consultant->getEmail();

        $id=r::find('consultant', 'nom = ? and prenom = ? and adr = ? and ville = ? and cp = ? and tel = ? and email = ? ',
        array($nom,$prenom,$adr,$ville,$cp,$tel,$email));

        foreach($id as $unid){
            return($unid->id);
        }
        }
       
        public function getConsultantfromId($idC){
            $req = R::getAll('select nom, prenom, adr, ville, cp, tel, email from consultant where consultant.id='.$idC.'');
            foreach($req as $laligne){
            $consultant=new consultant($laligne['nom'],$laligne['prenom'],$laligne['adr'],$laligne['ville'],$laligne['cp'],$laligne['tel'],$laligne['email']);
            return($consultant);
            }
        }

        public function update($consultant,$idC){
        
            $nom= $consultant->getNom();
            $prenom= $consultant->getPrenom();
            $adr=$consultant->getAdresse();
            $ville=$consultant->getVille();
            $cp=$consultant->getCp();
            $tel= $consultant->getTel();
            $email= $consultant->getEmail();

            $consultant=r::load('consultant',$idC);// on recupere le consultant
            $consultant->nom = $nom; // on lui donne les champs
            $consultant->prenom = $prenom;
            $consultant->adr=$adr;
            $consultant->ville=$ville;
            $consultant->cp=$cp;
            $consultant->tel=$tel;
            $consultant->email=$email;
            $consultant->cacher = FALSE;
            R::store($consultant); // on le sauvegarde en BDD

            }

        public function delete($consultant){
            $id=$this->getIdConsultantFromobject($consultant);
            $consultant=r::load('consultant',$id);
            $consultant->cacher=true;
            r::store($consultant);
            
        }
        
}   
?>