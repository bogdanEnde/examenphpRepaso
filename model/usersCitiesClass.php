<?php

class usersCitiesClass {
    protected $id;
    protected $idUser;
    protected $idCity;
    protected $date;
    

    public function getId()
    {
        return $this->id;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getIdCity()
    {
        return $this->idCity;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    public function setIdCity($idCity)
    {
        $this->idCity = $idCity;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    function getObjectVars()
    {
        $vars = get_object_vars($this);
        return  $vars;
    }
   
    
}
