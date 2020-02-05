
$(document).ready(function () {
    sessionCheck();

    $("#logout").click(function () {

        $.ajax({

            url: "../controller/cLogout.php",
            success: function (result) {

                window.location.href = "../index.html";
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });
});
function citiesList(idUser, userName) {
    $.ajax({

        // show the table



    });

}
function sessionLoader() {
    if (logedCheck != false) {
        if (!data.admin - 1) {
            location.href = "view/vCitiesList.html";
        } else {
            location.href = "../index.html";
        }
    }
    logedCheck = false;
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