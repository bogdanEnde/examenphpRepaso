<?php
include_once 'usersCitiesClass.php';
include_once 'userModel.php';
include_once 'cityModel.php';
include_once 'countryModel.php';
include_once 'connect_data.php';

class usersCitiesModel extends usersCitiesClass{
    
    private $link;
    private $list=array();
    private $XXXXXXX;
    private $YYYYYYY;
    

   
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
    
    public function setListUserCities()
    {
       
        
        // get user visited cities
        
        
        
    }
    function getArrUsersCities()   
    {
        
        $arr=array();
        
        foreach ($this->list as $object)
        {
            $vars = $object->getObjectVars();
            
            $vars['cityObject']= $object->getCityObject()->getObjCity();
            
            array_push($arr, $vars);
        }
        return $arr;
    }
    

}
