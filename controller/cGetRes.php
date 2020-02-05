<?php
include_once '../model/captchaModel.php';
$img_id = filter_input(INPUT_POST, "img_id");
$img_result = new captchaModel();
$img_result->setId($img_id);
if ($img_result->findResultByImgId()) {
    $_SESSION['captchaRes'] = $img_result->getResult();
    $obj['captchaRes'] = $_SESSION['captchaRes'];
    $objJson = json_encode($obj);
    echo $objJson;
}