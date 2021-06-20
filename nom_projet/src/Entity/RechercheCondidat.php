<?php 

namespace App\Entity;


class RechercheCondidat {
    private $id;
    
    private $status;

    public function getid (){
        return $this -> id ;
    }
    public function setid (int $id){
        $this->id = $id;
        return $this;
    }


    public function getStatus (){
        return $this -> status ;
    }
    public function setstatus (int $status){
        $this->status = $status;
        return $this;
    }
}
