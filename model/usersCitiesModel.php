<?php
include_once 'usersCitiesClass.php';
include_once 'userModel.php';
include_once 'cityModel.php';
include_once 'countryModel.php';
include_once 'connect_data.php';

class usersCitiesModel extends usersCitiesClass
{

    private $link;
    private $list = array();
    private $objCity;
    private $YYYYYYY;

    public function getObjCity()
    {
        return $this->objCity;
    }
    public function setObjCity($objCity)
    {
        $this->objCity = $objCity;
    }
    public function OpenConnect()
    {
        $konDat = new connect_data();
        try {
            $this->link = new mysqli($konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta 
        //                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }
    public function CloseConnect()
    {
        try {
            $this->link->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findDataByIdUser()
    {

        $this->OpenConnect();
        $idUser = $this->idUser;

        $sql = "call spUsersCities($idUser)";
        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // $ciudadVisitada=new usersCitiesModel();
            $this->setId($row['id']);
            $this->setIdUser($row['idUser']);
            $this->setIdCity($row['idCity']);
            $this->setDate($row['date']);



            $nombreCiudadVisitada = new cityModel();
            $nombreCiudadVisitada->setID($row['idCity']);
            $nombreCiudadVisitada->findIdCity();


            $this->setObjCity($nombreCiudadVisitada);

            array_push($this->list, $this);
        }

        mysqli_free_result($result);
        $this->CloseConnect();
    }
    function getArrUsersCities()
    {

        $vars = $this->getObjectVars();

        if ($this->getObjCity() != null) {
            $vars['objCiudades'] = $this->getObjCity()->getObjectVars();
            if (($this->getObjCity()->getObjCountry() != null)) {
                $vars['objPaises']=$this->getObjCity()->getObjCountry()->getObjectVars();
            }
        }
        return json_encode($vars);
    }
}
