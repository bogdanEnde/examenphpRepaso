<?php
header('Access-Control-Allow-Origin: *');
/*
 * header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
 * header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
 * header("Allow: GET, POST, OPTIONS, PUT, DELETE");
 * header('Access-Control-Allow-Credentials: false');
 * header('Access-Control-Max-Age: 86400');
 */

include_once '../model/userModel.php';

$PHPSESSID = (filter_input(INPUT_GET, "PHPSESSID"));

if ($PHPSESSID == null) {
    $PHPSESSID = filter_input(INPUT_POST, "PHPSESSID");
}
if ($PHPSESSID === ''/* || strlen($PHPSESSID) < 26*/) { // si llega PHPSESSID a '', crear session nueva, sino restaurar la que tiene que ser
    session_start();
    $PHPSESSID = session_id();
    $_SESSION['PHPSESSID'] = $PHPSESSID;
    // $objJson =  $PHPSESSID;
} else {
    session_id($PHPSESSID);
    $_SESSION['PHPSESSID'] = $PHPSESSID;
    session_start();
}


if ((isset($_SESSION['name']))  && (isset($_SESSION['admin']))){
    
    
    $obj['name']=$_SESSION['name'];
    $obj['admin']=$_SESSION['admin'];
//     $obj['idUsuario']=$_SESSION['idUsuario'];
    $obj['$PHPSESSID'] = $_SESSION['PHPSESSID'];
    
    $objJson = json_encode($obj);
    
    echo/* $GET['callblack'].'('.*/$objJson/*.')'*/;         // ver var session
    
} else{
    echo -1;
}