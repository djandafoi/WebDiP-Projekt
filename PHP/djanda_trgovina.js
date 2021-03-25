function kategorije() {
    $.ajax({
        dataType: "json",
        url: "./PHP/kategorije.php",
        type: "GET",
        success: function (data) {
            var kategorija = document.getElementById("kategorija");
            data.forEach(element => {
                kategorija.innerHTML +=
                        "<option value='" +
                        element["idkategorija_licence"] +
                        "'>" +
                        element["naziv"] +
                        "</option>";
            });
        }
    });
}
function pretrazi() {
    $.ajax({
        dataType: "json",
        url: "./PHP/licence.php",
        type: "GET",
        success: function (data) {
            var pretraga = document.getElementById("pretraga");
            pretraga.innerHTML = "";
            data.forEach(element => {
                pretraga.innerHTML +=
                        "<div class='regobr'><h3>" +
                        element["naziv"] +
                        "</h3><img style='border:0; margin:auto;' src='multimedija/" +
                        element["slika"] +
                        "' width='150'/>" +
                        "<p>Opis: " +
                        element["opis"] +
                        "<br>Kategorija: " +
                        element["kategorija"] +
                        "</div></p>";
            });
        }
    });
}

function filter() {
    var filter = document.getElementById("kategorija").value;
    $.ajax({
        dataType: "json",
        url:
                "./PHP/licence_filter.php?filter=" +
                filter,
        type: "GET",
        success: function (data) {
            var pretraga = document.getElementById("pretraga");
            pretraga.innerHTML = "";
            data.forEach(element => {
                pretraga.innerHTML +=
                        "<div class='regobr'><h3>" +
                        element["naziv"] +
                        "</h3><img style='border:0; margin:auto;' src='multimedija/" +
                        element["slika"] +
                        "' width='150'/>" +
                        "<p>Opis: " +
                        element["opis"] +
                        "<br>Kategorija: " +
                        element["kategorija"] +
                        "</div></p>";
            });
        }
    });
}
function pregled_zahtjeva(korime) {
    $.ajax({
        dataType: "json",
        url: "./PHP/pregled_zahtjeva.php?korime=" +
                korime,
        type: "GET",
        success: function (data) {
            var zahtjevi = document.getElementById("zahtjevi");
            var vracanje = document.getElementById("vracanje");
            zahtjevi.innerHTML = "";
            zahtjevi.innerHTML +=
                    "<tr><td>Naziv</td>" +
                    "<td>Kljuc</td>" +
                    "<td>Vrijedi do</td>" +
                    "<td>Status</td></tr>";
            data.forEach(element => {
                zahtjevi.innerHTML +=
                        "<tr><td>" +
                        element["naziv"] +
                        "</td><td>" +
                        element["kljuc"] +
                        "</td><td>" +
                        element["datum"] +
                        "</td><td>" +
                        element["status"] +
                        "</td></tr>";
                if (element["status"] == "aktivan" && element["istek"] > 3 ) {
                    vracanje.innerHTML +=
                            "<option value=" +
                            element["licence_idlicence"] +
                            ">" +
                            element["naziv"] +
                            "</option>";
                }
            });
        }
    });
}
function vrati(korime) {
    var idlicence = document.getElementById("vracanje").value;
    $.ajax({
        dataType: "json",
        url: "./PHP/vrati.php",
        type: "POST",
        data: {
            korime: korime,
            idlicence: idlicence
        },
    });
    window.location.href = "./profil.php";
}

function dostupne_licence() {
  $.ajax({
    dataType: "json",
    url: "./PHP/dostupne_licence.php",
    type: "POST",
    success: function(data) {
      var licenca = document.getElementById("licenca");
      data.forEach(element => {
        licenca.innerHTML +=
          "<option value=" +
          element["idlicence"] +
          ">" +
          element["naziv"] +
          " (" + element["dostupno"] +
          ")</option>";
      });
    }
  });
}

function trazi_zahtjev(korime) {
  var licenca = document.getElementById("licenca").value;
  $.ajax({
    dataType: "json",
    url: "./PHP/trazi_zahtjev.php?korime=" + korime + "&licenca=" + licenca,
    type: "GET",
    success: function(data) {
      window.location.href = "./profil.php";
    }
  });
}

function mod_odobravanje() {
    $.ajax({
        dataType: "json",
        url: "./PHP/mod_odobravanje.php",
        type: "GET",
        success: function (data) {
            var zahtjevi = document.getElementById("zahtjevi");
            zahtjevi.innerHTML = "";
            zahtjevi.innerHTML +=
                    "<tr><td>Naziv</td>" +
                    "<td>Kljuc</td>" +
                    "<td>Vrijedi do</td>" +
                    "<td>Status</td>" +
                    "<td>Korisnik</td>" +
                    "<td>Prihvati</td>" +
                    "<td>Odbij</td></tr>";
            data.forEach(element => {
                zahtjevi.innerHTML +=
                        "<tr><td>" +
                        element["naziv"] +
                        "</td><td>" +
                        element["kljuc"] +
                        "</td><td>" +
                        element["datum"] +
                        "</td><td>" +
                        element["status"] +
                        "</td><td>" +
                        element["korisnik"] +
                        "</td><td><input type='button' value='odobri' onclick='odobri("+ element["idvlasnistva"]
                        + ")'></td><td><input type='button' value='odbij' onclick='odbij("+ element["idvlasnistva"]
                        + ")'></td></tr>";                
                
            });
        }
    });
}
function odobri(idvlasnistva) {
  $.ajax({
    dataType: "json",
    url: "./PHP/odobri_korisniku.php?idvlasnistva=" + idvlasnistva,
    type: "GET",
    success: function(data) {
      window.location.href = "./moderator.php";
    }
  });
}

function odbij(idvlasnistva) {
  $.ajax({
    dataType: "json",
    url: "./PHP/odbij_korisniku.php?idvlasnistva=" + idvlasnistva,
    type: "GET",
    success: function(data) {
      window.location.href = "./moderator.php";
    }
  });
}

function admin_korisnici() {
    $.ajax({
        dataType: "json",
        url: "./PHP/admin_korisnici.php",
        type: "GET",
        success: function (data) {
            var zahtjevi = document.getElementById("zahtjevi");
            zahtjevi.innerHTML = "";
            zahtjevi.innerHTML +=
                    "<tr><td>Ime</td>" +
                    "<td>Prezime</td>" +
                    "<td>Korisnik</td>" +
                    "<td>Email</td>" +
                    "<td>Status</td>" +
                    "<td>Otključaj</td></tr>";
            data.forEach(element => {
                zahtjevi.innerHTML +=
                        "<tr><td>" +
                        element["ime"] +
                        "</td><td>" +
                        element["prezime"] +
                        "</td><td>" +
                        element["korisnicko_ime"] +
                        "</td><td>" +
                        element["email"] +
                        "</td><td>" +
                        element["blokiran"] +
                        "</td><td><input type='button' value='otključaj' onclick='otkljucaj("+ element["idkorisnik"]
                        + ")'></td></tr>";                
                
            });
        }
    });
}

function otkljucaj(idkorisnik) {
  $.ajax({
    dataType: "json",
    url: "./PHP/otkljucaj_korisniku.php?idkorisnik=" + idkorisnik,
    type: "GET",
    success: function(data) {
      window.location.href = "./administrator.php";
    }
  });
}

function blokiraj() {
    var korisnik = document.getElementById("korisnik").value;
  $.ajax({
    dataType: "json",
    url: "./PHP/blokiraj.php?korisnik=" + korisnik,
    type: "GET",
    success: function(data) {
      window.location.href = "./administrator.php";
    }
  });
}
