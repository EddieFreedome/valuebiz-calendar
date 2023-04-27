$(function () {
    let availability = true; //default sempre disponibile

    //per cambiare anno devo cambiare la variabile t
    // console.log(t+1); ogni volta che premo il pulsantino di increment_year

    function c() {
        //STEP #1 [OK]
        //crea giorni della settimana abbreviati nel container weekdays
        p();
        //-----------------------

        //STEP #2 - per ogni giorno (a partire dal primo) crea un array di oggetti unendo ogni giorno al suo nome nella settimana
        //calcola n. totale gg in mese
        //calcola per ogni giorno l'indice nella settimana
        //per ogni giorno (che ha un indice) gli viene associato un nome nel giorno della settimana
        // e = [{day:1, weekday: sabato}, ...]

        var e = h();
        //-----------------------

        var r = 0;

        //booleano di controllo
        var u = false;

        //svuota il container dei giorni del calendario
        l.empty();

        //SEZIONE PER ASSEGNARE LE CASELLE VUOTE PRIMA DEL PRIMO GIORNO DEL MESE
        //finche' u = true
        //se il primo giorno della settimana (domenica) e' uguale al valore della chiave weekday del primo oggetto (dell'array e)
        //u diventa true
        //altrimenti continua a pushare div vuoti con classe blank nel container dei giorni (l) scalando giorno (r)

        while (!u) {
            if (s[r] == e[0].weekday) {
                u = true;
            } else {
                l.append('<div class="blank"></div>');
                r++;
            }
        }

        //SEZIONE PER ASSEGNARE LE CASELLE VUOTE DOPO L' ULTIMO GIORNO DEL MESE
        //(cicla su 42 caselle totali)
        //(il primo valore di r sara' l'indice del primo giorno della settimana che trova, spostando quindi u a true)
        //(per ciascuna casella [42 - r perche' toglie i giorni in eccesso dal totale])

        //se c e' maggiore o uguale alla lunghezza dell'array di tutti i giorni del mese
        //appendi una casella con classe vuota
        //altrimenti il giorno corrente sara' "pieno"

        for (var c = 0; c < 42 - r; c++) {
            if (c >= e.length) {
                l.append('<div class="blank"></div>');
            } else {
                var v = e[c].day; //assegnazione numero giorno normale

                //assegnazione classe giorno normale + giorno oggi
                //m e' il tag del div iniziale di apertura che viene aperto con la class="today" se trova la corrispondenza con la data corrente,
                // altrimenti apre solo un tag <div>
                let f = z(new Date(t, n - 1, v)); //prende la data di una casella da y()
                var m = g(new Date(t, n - 1, v))
                    ? `<div class="day today" date="${f}">`
                    : `<div class='day' date="${f}">`; //crea il div in stringa

                // console.log(m);

                l.append(m + "" + v + "</div>"); // chiude il tag div e lo appende per intero
                // console.log(f);
            }
        }
        // console.log(a);

        //CAMBIO CSS HEADER
        var y = o[n - 1];
        a.css("background-color", y)
            .find("h1")
            .text(i[n - 1] + " " + t);
        f.find("div").css("color", y);

        //CAMBIO CSS DAY ,
        if (availability === true) {
            l.find(".day")
                .css("color", "787878")
                .css("background-color", "lightgreen")
                .css("border", `1px solid ${y}`);
        } else {
            l.find(".day")
                .css("color", "#f8f8f8")
                .css("background-color", "lightcoral")
                .css("border", `1px solid ${y}`);
        }

        l.find(".today")
            .css("background-color", "lightgreen")
            .css("border", `6px solid ${y}`)
            .css("color", "#787878");
        d();
    }

    //STEP #1a [OK] (viene invocala all'inizio del codice) - Crea giorni della settimana
    function p() {
        //svuota il container con tutti i giorni della settimana
        f.empty();

        //dall'array dei nomi dei giorni della settimana (s), li cicla e li abbrevia col substring (fino a 3 caratteri) e li mette in un div
        for (var e = 0; e < 7; e++) {
            f.append("<div>" + s[e].substring(0, 3) + "</div>");
        }
    }

    //STEP #2a - [OK]
    function h() {
        var e = [];
        //e = anno selezionato (nella funzione v)
        // console.log(v(t, n)) = n. di giorni su mese selezionato in certo anno
        //v() estrapola il numero di giorni presenti in un mese di un certo anno

        //cicla sul n. di giorni del mese nell'anno corrispondente.
        for (var r = 1; r < v(t, n) + 1; r++) {
            //pusha nell'array e il n. di giorno associato al suo nome nella settimana, a partire dal primo giorno del mese
            //m() estrapola per ogni giorno del mese l'indice corrispondente all'array dei giorni della settimana s
            //es. m = 6, in s[6] il giorno sara' sabato.
            //{day : 1, weekday : sabato}
            e.push({ day: r, weekday: s[m(t, n, r)] });
        }
        return e;
    }

    //STEP #2aa - [OK] - ritorna il numero di giorni di un mese di un anno (con getDate)
    function v(e, t) {
        return new Date(e, t, 0).getDate();
    }

    function d() {
        var t;
        var n = $("#calendar").css("width", e + "px");
        n.find((t = "#calendar_weekdays, #calendar_content"))
            .css("width", e + "px")
            .find("div")
            .css({
                width: e / 7 + "px",
                height: e / 7 + "px",
                "line-height": e / 7 + "px",
            });
        n.find("#calendar_header")
            .css({ height: e * (1 / 7) + "px" })
            .find('i[class^="icon-chevron"]')
            .css("line-height", e * (1 / 7) + "px");
    }

    //STEP #2 b - [OK] - Ritorna per ciascun giorno del mese corrispondente l'indice del giorno collocato nella settimana (es: sabato = 6, domenica = 0, lunedi' = 1, ...)
    function m(e, t, n) {
        return new Date(e, t - 1, n).getDay();
    }

    function g(e) {
        //g richiama tutte le date mensili da y (che le assembla), per ogni valore da y trasforma
        //il formato in Data e fa un controllo per matchare il valore con la data odierna

        //ritorna (ciclando nel for precedente) se la data del giorno corrente e' uguale a quella
        //di ogni giorno del mese (formattato come data da y(e))
        return y(new Date()) == y(e); //y(e) = data formattata di ogni giorno del mese
    }

    //funzione identica a g per ritornare pero' le sole date
    function z(e) {
        return y(e); //y(e) = data formattata di ogni giorno del mese
    }

    // crea l'oggetto data per ogni singolo giorno con mese e anno
    function y(e) {
        // console.log(e.getFullYear() + "/" + (e.getMonth() + 1) + "/" + e.getDate());
        return e.getFullYear() + "/" + (e.getMonth() + 1) + "/" + e.getDate();
    }

    function b() {
        var e = new Date();
        t = e.getFullYear();

        // console.log(e, t);

        n = e.getMonth() + 1;
    }

    let dates = [];

    var e = 480;
    var t = 2013;
    var n = 9;
    var r = [];
    var i = [
        "JANUARY",
        "FEBRUARY",
        "MARCH",
        "APRIL",
        "MAY",
        "JUNE",
        "JULY",
        "AUGUST",
        "SEPTEMBER",
        "OCTOBER",
        "NOVEMBER",
        "DECEMBER",
    ];

    //array giorni della settimana
    var s = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
    var o = [
        "#16a085",
        "#1abc9c",
        "#c0392b",
        "#27ae60",
        "#FF6860",
        "#f39c12",
        "#f1c40f",
        "#e67e22",
        "#2ecc71",
        "#e74c3c",
        "#d35400",
        "#2c3e50",
    ];

    //targetta l'elemento calendario
    var u = $("#calendar");

    //targetta l'header del calendario
    var a = u.find("#calendar_header");

    //targetta il container delle settimane del calendario
    var f = u.find("#calendar_weekdays");

    //targetta il container giorni del calendario
    var l = u.find("#calendar_content");

    b();
    c();

    //al click delle chevron
    a.find('i[class^="icon-chevron"]').on("click", function () {
        var e = $(this);
        var r = function (e) {
            n = e == "next" ? n + 1 : n - 1;

            //se il mese e' minore di uno, il mese ritorna a 12 con l'anno diminuito
            if (n < 1) {
                n = 12;
                t--;
            } else if (n > 12) {
                n = 1;
                t++;
            }
            c();
        };
        if (e.attr("class").indexOf("left") != -1) {
            r("previous");
        } else {
            r("next");
        }
    });

    //script per salvare in array i giorni cliccati (solo di un mese al momento) e chiamata ajax per salvare la data
    $(".day").on("click", function (e) {
      e.preventDefault();

        // console.log(e);
        let date = $(this).attr("date");

        //CHIAMATA AJAX
        // Cambio CSS se Success AJAX

        var form = new FormData();
        form.append("availability", availability);
        form.append("date", date);

        var settings1 = {
          "method": "POST",
          "url": "/store",
          "timeout": 0,
          "headers": {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
          },
          "processData": false,
          "mimeType": "multipart/form-data",
          "contentType": false,
          "data": form

        }

        $.ajax(settings1).done(function (response) {
          
          switch (availability) {
            case true:
                if (dates.includes(this) === false) {
                    dates.push(this);
                    $(this).css("background-color", "lightcoral");
                } else {
                    dates.splice($.inArray(this, dates), 1);
                    $(this).css("background-color", "lightgreen");
                }

                break;

            case false:
                if (dates.includes(this) === false) {
                    dates.push(this);
                    $(this).css("background-color", "lightgreen");
                } else {
                    dates.splice($.inArray(this, dates), 1);
                    $(this).css("background-color", "lightcoral");
                }
                break;

          default:
              break;
        }

          alert(response);
        });

        // switch (availability) {
        //   case true:


              // $.ajax({
              //     type: "POST",
              //     url: "{{ route('availabilities.store') }}",
              //     data: {
              //         'availability' : availability,
              //         'date' : date,
              //     },
              //     dataType: "json",
              //     success: function (response) {
              //       alert('successo');
              //     },
              // });

        //       break;
        //   case false:

        //   default:
        //       console.log("Errore del salvataggio al click del giorno");
        //       break;
        // }

        //switch di prova!!
        // switch (availability) {
        //   case true:
        //       if (dates.includes(this) === false) {
        //           dates.push(this);
        //           $(this).css("background-color", "lightcoral");
        //       } else {
        //           dates.splice($.inArray(this, dates), 1);
        //           $(this).css("background-color", "lightgreen");
        //       }

        //       break;

        //   case false:
        //       if (dates.includes(this) === false) {
        //           dates.push(this);
        //           $(this).css("background-color", "lightgreen");
        //       } else {
        //           dates.splice($.inArray(this, dates), 1);
        //           $(this).css("background-color", "lightcoral");
        //       }
        //       break;

        //   default:
        //       break;
        // }

        //OLD_VERSION (BEFORE SWITCH)
        // if (dates.includes(this) === false && availability === true ) {

        //   dates.push(this);
        //   $(this).css('background-color', "lightcoral");
        //   // this.classList.add('unavailable');

        //   //chiamata ajax di salvataggio

        // } else if (dates.includes(this) === true && availability === true){

        //   dates.splice( $.inArray(this, dates), 1 );
        //   $(this).css('background-color', "lightgreen");
        //   // this.classList.add('available');

        //   //chiamata ajax di update sul campo spunta
        //   //availabilities.update

        // }

        // !! Devo prima prendere la data in una variabile --> Date

        // $.ajax({
        //   type: "POST",
        //   url: "{{ route('availabilities.store') }}",
        //   data: {
        //     // 'availability_status' : true/false,
        //     // 'date' : date,
        //   },
        //   dataType: "json",
        //   success: function (response) {

        //   }
        // });

        // console.log(this.classList.toggle('bg-primary'));
    });

    let days = $("#calendar_content").find(".day");

    $("#available").on("click", function () {
        availability = true;
        alert("yes");
    });

    $("#unavailable").on("click", function () {
        //1. Cambia availability da tue a false
        availability = false;

        //2. chiamata ajax forceDelete
        //2. se success, cambia colore di tutte le caselle

        days.css("background-color", "lightcoral");
    });
});
