<?php

include_once '../model/usersCitiesModel.php';

 $response = array();


$idUser = filter_input(INPUT_GET, "idUser");
$name = filter_input(INPUT_GET, "name");

$response =new usersCitiesModel();
$response->setIdUser($idUser);
$response->findDataByIdUser();

echo $response->getArrUsersCities();