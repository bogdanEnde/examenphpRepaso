<?php
include_once 'captchaClass.php';
include_once 'connect_data.php';

class captchaModel extends captchaClass
{

    private $link;

    private $list;

    public function OpenConnect()
    {
        $konDat = new connect_data();
        try {
            $this->link = new mysqli($konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8");
    }

    public function CloseConnect()
    {
        // mysqli_close ($this->link);
        $this->link->close();
    }

    public function findResultByImgId()
    {
        $this->OpenConnect();
        $CaptchaId = $this->id;

        $sql = "call spAllCaptcha('$CaptchaId')";

        $result = $this->link->query($sql);
        $CaptchaId = false;

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $this->setResult($row['result']);

            $CaptchaId = true;
        }
        return $CaptchaId;
        mysqli_free_result($result);
        $this->CloseConnect();
    }
}
