/*!
 * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
 */
(function ($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);


/** PRINT ERROR MESSAGE IN HEADER MODAL */
function printErrorMsg(msg) {
    $(".print-error-msg")
        .find("ul")
        .html("");
    $(".print-error-msg").css("display", "block");
    $.each(msg, function (key, value) {
        $(".print-error-msg")
            .find("ul")
            .append("<li><small>" + value + "</small></li>");
    });
}

/** .input-daterange */
function input_daterange() {
    $(".input-daterange").datepicker({
        todayBtn: "linked",
        todayHighlight: true,
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "bottom"
    });
}

/** BUTTON HTML FOR FILTER AND SEARCH */
function daterange_button() {
    $("div.date_error").html(
        '<span class="alert alert-danger">Kedua kolom input tanggal harus diisi!.</span>'
    );

    $("div.filter").html(
        '<button type="submit" id="filter" name="filter" class="btn btn-success btn-sm ">Submit</button>'
    );
    $("div.refresh").html(
        '<button type="submit" id="refresh" name="refresh" class="btn btn-primary btn-sm ">Refresh</button>'
    );
    $("div.start_date").html(
        '<input type="text" id="start_date" name="start_date" class="form-control form-control-sm datepicker" placeholder="tanggal awal" autocomplete="off">'
    );
    $("div.end_date").html(
        '<input type="text" id="end_date" name="end_date" class="form-control form-control-sm datepicker" placeholder="tanggal akhir" autocomplete="off">'
    );
}

/** HEADER SEARCH BOX DATATABLE */
function header_search_box(id_table, var_table_name) {
    //insert search column in footer
    $(id_table + " tfoot th").each(function () {
        var title = $(this)
            .text()
            .replace(" ", "")
            .replace(".", "__");
        if (title == "No__Rek") {
            $(this).html(
                '<input type="text" class="search_box" placeholder="Search" id="' + title + '"/>'
            );
        } else {
            $(this).html(
                '<input tabindex="-1" type="text"  class="search_box" placeholder="Search" id="' +
                title +
                '"/>'
            );
        }
    });

    // insert tfoot before thead for the searching
    $(id_table + " tfoot").insertBefore(id_table + " thead");

    // Apply the search
    var_table_name.columns().every(function () {
        var that = this;
        $("input", this.footer()).on("keyup change clear", function (e) {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });
}

/** DATATABLE MUTASI DI PERCETAKAN */
function load_table_mutasi(table_name, id, trx_terakhir = 0) {
    var t = $(table_name).DataTable({
        processing: true,
        serverSide: true,
        tabIndex: -1,
        ajax: {
            url: "/get_mutasi_table", // Alamat json
            type: "POST", // tipe input
            data: { id: id, trx_terakhir: trx_terakhir }
        },
        pagingType: "full_numbers",
        //"pageLength": 5,
        dom:
            "t<'d-flex justify-content-between'<'small'i><'my-auto pagination-sm'p>>",
        language: {
            emptyTable: "Nasabah tidak memiliki data mutasi",
            lengthMenu: "_MENU_", // Edit tulisan pagelength
            paginate: {
                previous: "<", // Edit tulisan pagination
                next: ">",
                first: "<<",
                last: ">>"
            }
        },
        columns: [
            // load data
            { data: "DT_RowIndex", name: "DT_RowIndex", sortable: false },
            { data: "tanggal_trx", name: "tanggal_trx", sortable: false },
            {
                data: "jenis_transaksi",
                name: "jenis_transaksi",
                sortable: false
            },
            { data: "keterangan", name: "keterangan", sortable: false },
            { data: "nominal", name: "nominal", sortable: false }
        ]
    });
}

/** READ EACH TOTAL TO DISPLAY IN TOTAL ALL IN CENTER BELOW TABLE */
function read_total() {
    var x = document.getElementsByClassName("each_total");
    var total = 0;
    for (let index = 0; index < x.length; index++) {
        total += parseInt(x[index].value);
    }
    $("#sub_total").attr("value", total); //hidden input sub_total
    $(".total_semua").text(total); // text sub_total
}

function cetak(data) {
    qz.security.setCertificatePromise(function (resolve, reject) {
        fetch("/assets/signing/digital-certificate.txt", { cache: 'no-store', headers: { 'Content-Type': 'text/plain' } })
            .then(function (data) { data.ok ? resolve(data.text()) : reject(data.text()); });
    });
    qz.security.setSignatureAlgorithm("SHA512");
    qz.security.setSignaturePromise(function (toSign) {
        return function (resolve, reject) {
            fetch("/sign-print?request=" + toSign, { cache: 'no-store', headers: { 'Content-Type': 'text/plain' } })
                .then(function (data) { data.ok ? resolve(data.text()) : reject(data.text()); });
        };
    });
    qz.websocket.connect().then(() => {
        return qz.printers.find("SIBUHAR");
    }).then((found) => {
        var config = qz.configs.create(found);
        /** var data_print = [{
            type: 'pixel',
            format: 'html',
            flavor: 'plain', // or 'plain' if the data is raw HTML
            data: data,
            // options: { pageWidth: 8 , pageHeight: 11.5}
        }]; */
        data.unshift('\x1B' + '\x40');
        return qz.print(config, data);
    }).catch((e) => {
        alert(e);
    }).finally(() => {
        return qz.websocket.disconnect();
    });

}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}



