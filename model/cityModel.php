<?php
include_once 'cityClass.php';
include_once 'countryModel.php';
include_once 'connect_data.php';

class cityModel extends cityClass{
    
    private $link;
    private $XXXXXXXXX;
    
   
    
    
    
    
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
    
    
    public function findIdCity() // fill city : $this
    {
      
        
        
        
        
        
        
    }
   
  
    function getObjCity() 
    {
         $vars = $this->getObjectVars();
        
         $vars['countryObject']= $this->countryObject->getObjectVars();
        return $vars;
    }
    
}
