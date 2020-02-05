<?php
include_once '../model/userModel.php';
include_once '../model/captchaModel.php';

// $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
// $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
// $captchaImgFile = filter_input(INPUT_POST, 'captchaImgFile', FILTER_SANITIZE_SPECIAL_CHARS);
// $result = filter_input(INPUT_POST, 'result', FILTER_SANITIZE_SPECIAL_CHARS);

// $response = array();

// // user, password and captcha verify

// echo json_encode($response);
$PHPSESSID = filter_input(INPUT_POST, "PHPSESSID");
$name = filter_input(INPUT_POST, "name");
$password = filter_input(INPUT_POST, "password");


if ($PHPSESSID == null) {
    $PHPSESSID = filter_input(INPUT_GET, "PHPSESSID");
}
if ($PHPSESSID == ''/* || strlen($PHPSESSID) < 26*/) { // si llega PHPSESSID a '', crear session nueva, sino restaurar la que tiene que ser
    session_start();
    $PHPSESSID = session_id();
    $_SESSION['PHPSESSID'] = $PHPSESSID;
} else {

    session_id($PHPSESSID);
    $_SESSION['PHPSESSID'] = $PHPSESSID;
    session_start();
}

if (($name != null) && ($password != null)) {
    


    $user = new userModel();
    $user->setUsername($name);
    $user->setPassword($password);
    if ($user->findUserByUsername()) // si es correcto el userName y el password
    {
        // session_start();
        $_SESSION['name'] = $name;
        $_SESSION['admin'] = $user->getAdmin();
        $_SESSION['idUser'] = $user->getIdUser();
        
        // $_SESSION['idCategoria'] = $user->getIdCategoria();

        $obj['usuario'] = $_SESSION['name'];
        $obj['admin'] = $_SESSION['admin'];
       
        // $obj['idCategoria'] = $_SESSION['idCategoria'];

        $obj['$PHPSESSID'] = $_SESSION['PHPSESSID'];

        $objJson = json_encode($obj);
        echo $objJson;
    } else {
        echo - 1; // not correct user
    }
} else {
    echo - 1; // not filled user or password
}