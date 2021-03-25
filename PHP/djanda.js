$(document).ready(function () {
    var Provjera = new RegExp(/^[0-9a-zA-Z.]+[@][a-zA-Z]+[.][a-zA-Z]+$/);
    $("#email").keyup(function () {
        var uneseno = $("#email").val();
        if (!Provjera.test(uneseno))
        {
            $("#email").css("background-color", "red");
            return false;
        } else {
            $("#email").css("background-color", "white");
        }
    });
    $("#potvrdalozinke").focusout(function () {
        var pass = $("#lozinka").val();
        var passok = $("#potvrdalozinke").val();
        if (pass !== passok) {
            $("#potvrdalozinke").css("background-color", "red");
            return;
        }
        if (pass === passok) {
            $("#potvrdalozinke").css("background-color", "white");
        }
    });
    $('#korime').focusout(function () {
        var korime = document.getElementById("korime").value;
        $.ajax({
            dataType: "json",
            url: "../PHP/korimeprovjera.php?korime=" + korime,
            type: "GET",
            success: function (data) {
                if (data) {
                    alert("Korisničko ime postoji!");
                }
            }
        });
    });
});

