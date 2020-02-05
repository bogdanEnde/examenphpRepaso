var data;
var img_id;
var captResultado;
var logedCheck = false;

$(document).ready(function () {
    sessionCheck();
    //carga img
    loadImage();
    //inicia sesion despues de hacer click a enviar
    $("#signIn").click(function () { conectCheck(); });
});
function loadImage() {

    var img;
    var num = Math.floor(Math.random() * 4) + 1; // rendom number 1--4

    img = "captcha" + num + ".png";

    $("#imgCaptcha").attr("src", "view/images/" + img);
    img_id = num;
    $.ajax({
        type: "POST",
        data: { 'img_id': img_id },
        url: "controller/cGetRes.php",
        dataType: "json",
        success: function (result) {
            captResultado = result.captchaRes;
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " PAPUA NUEVA GUINEA " + xhr.statusText);
        }
    });
}


function signIn() {

    var name = $("#inUser").val();
    var password = $("#inPass").val();
    $.ajax({
        type: "POST",
        data: { 'PHPSESSID': (sessionStorage.getItem('PHPSESSID') || ''), 'name': name, 'password': password, 'img_id': img_id },
        url: "controller/cSignIn.php",
        dataType: "json",
        success: function (result) {
            console.log(result);
            logedCheck = true;
            data = result;
            sessionStorage.setItem('PHPSESSID', result.$PHPSESSID || '');
            sessionLoader();
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " PAPUA NUEVA GUINEA " + xhr.statusText);
        }
    });
}
function conectCheck() {
    var resDeUusuario = $('#inResult').val();
    if (captResultado == resDeUusuario) {
        signIn();
    } else {
        alert("ERROR en captcha");
    }
}
function sessionLoader() {
    if (logedCheck != false) {
        if (!data.admin - 1) {
            location.href = "view/vCitiesList.html";
        } else {
            alert("Error al iniciar sesion");
        }
    }
    logedCheck = false;
}
function sessionCheck() {
    $.ajax({
        type: "GET",
        data: { 'PHPSESSID': (sessionStorage.getItem('PHPSESSID') || '') },
        url: "controller/cLoggedVerify.php",
        // "http://lmar.fpz1920.com/controller/cIndex.php",
        //url: "controller/cIndex.php", 
        dataType: "json",

        success: function (result) {
            console.log(result);
            userCheck(result);
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}
function userCheck(result) {
    if ((!result.name == "") || (result.name == null)) {
        //        if (result.admin == 1) {
    } else {
        location.href = "view/vCitiesList.html";
    }
    // } else {
    // 	alert("Error al iniciar sesion");
}
