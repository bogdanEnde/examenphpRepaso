<?php
include_once 'countryClass.php';
include_once 'connect_data.php';

class countryModel extends countryClass{
    private $link;
    private $list=array();
    
    
    public function OpenConnect()
    {
        $konDat=new connect_data();
         try
        {
            $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
        }
        catch(Exception $e)
        {
             echo $e->getMessage();
         }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta 
        //                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }                   
    public function CloseConnect()
    {
         try
         { 
           $this->link->close();
         }
         catch(Exception $e)
        {
         echo $e->getMessage();
        }  
    } 
    
    
    function findIdCountry() // fill country : $this
    {
       
        $this->OpenConnect();

        $Code = $this->Code;

        $sql = "call spFindIdCountry('$Code')";
        $result = $this->link->query($sql);


        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $this->setName($row['Name']);
            $this->setContinent($row['Continent']);
            $this->setSurfaceArea($row['SurfaceArea']);
            $this->setIndepYear($row['IndepYear']);
            $this->setPopulation($row['Population']);
            $this->setLifeExpectancy($row['LifeExpectancy']);
            $this->setCapital($row['Capital']);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
         
    }
    
   
    
    
 
}
