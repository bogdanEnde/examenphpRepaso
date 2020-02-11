<?php
include_once 'cityClass.php';
include_once 'countryModel.php';
include_once 'connect_data.php';

class cityModel extends cityClass
{

    private $link;
    
    private $objCountry;



    public function getObjCountry()
    {
        return $this->objCountry;
    }

    public function setObjCountry($objCountry)
    {
        $this->objCountry = $objCountry;
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


    public function findIdCity() // fill city : $this
    {

        $this->OpenConnect();

        $ID = $this->ID;

        $sql = "call spFindIdCity($ID)";
        $result = $this->link->query($sql);


        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $this->setName($row['Name']);
            $this->setCountryCode($row['CountryCode']);
            $this->setPopulation($row['Population']);

            $countryCode=new countryModel();
            $countryCode->setCode($row['CountryCode']);
            $countryCode->findIdCountry();

            $this->setObjCountry($countryCode);

            //  array_push($this->list, $this);
        }

        mysqli_free_result($result);
        $this->CloseConnect();
    }


    function getObjCity()
    {
        $vars = $this->getObjectVars();

        $vars['countryObject'] = $this->countryObject->getObjectVars();
        return $vars;
    }
}
