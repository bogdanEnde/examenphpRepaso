
$(document).ready(function () {
    sessionCheck();

    $("#logout").click(function () {

        $.ajax({
            url: "../controller/cLogout.php",
            success: function (result) {

                sessionStorage.setItem('PHPSESSID', '');
                window.location.href = "../index.html";
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });
});
function citiesList(idUser, name) {

    $.ajax({
        type: "GET",
        data: { idUser, name },
        url: "../controller/cCitiesList.php",
        dataType: "json",

        success: function (result) {
            console.log(result);
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });

}

function sessionCheck() {
    $.ajax({
        type: "GET",
        data: { 'PHPSESSID': (sessionStorage.getItem('PHPSESSID') || '') },
        url: "../controller/cLoggedVerify.php",
        // "http://lmar.fpz1920.com/controller/cIndex.php",
        //url: "controller/cIndex.php", 
        dataType: "json",

        success: function (result) {
            console.log(result);
            userCheck(result);
            citiesList(result.idUser, result.name);
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function userCheck(result) {
    if ((!result.name == "") || (result.name == null)) {
    } else {
        location.href = "../index.html";
    }
}