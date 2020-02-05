<?php

class captchaClass{
    
    public $id;
    public $path;
    public $result;
    
    function getId() {
        return $this->id;
    }

    function getPath() {
        return $this->path;
    }

    function getResult() {
        return $this->result;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setResult($result) {
        $this->result = $result;
    }

   
}