$(document).ready(function () {

    /**                                *
     *            HANDLE LOGIN        *
     *                                */
    $('#login_submit').click(function () {

        var email = $("#email").val();
        var password = $("#password").val();
        var dataString = 'email=' + email + '&password=' + password;


        $.ajax({
            type: "POST",
            url: "includes/login.php",
            data: dataString,
            cache: false,
            beforeSend: function () {
                $("#login_submit").val('Connecting...');
            },
            success: function (data) {
                if (data == '1') {
                    window.location.href = "views/dashboard.php";
                } else {
                    $("#email").css("border", "1px solid rgba(255,0,0,0.5)");
                    $("#password").css("border", "1px solid rgba(255,0,0,0.5)");
                }
            }
        });
        return false;
    });

    //initialize the date picker for date input
    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true});


});

$(".activityTab").click(function () {

    $(".tab").removeClass("active");
    $(".tab").removeClass("tab");
    $(this).closest("li").addClass("tab");
    $(this).closest("li").addClass("active");

    var type = $(this).attr("id");

    renderTable(type);

    var $target = $('html,body');
    $target.animate({scrollTop: $target.height()}, 1000);

});


$("#goActivity").click(function () {


    var type = $(".tab").find("a").attr("id");

    renderTable(type);

    var $target = $('html,body');
    $target.animate({scrollTop: $target.height()}, 1000);

});

function renderTable(type) {


    var empID = $("#empID").text();
    var beginDate = $("#beginDate").val();
    var endDate = $("#endDate").val();
    var buildTable;

    $.ajax({
        url: "../includes/getEmployeeServiceRecords.php?id=" + empID + "&type=" + type + "&beginDate=" + beginDate + "&endDate=" + endDate,
        cache: false,
        success: function (data) {
            var dataAsJson = JSON.parse(data);

            console.log(dataAsJson);

            if (dataAsJson == "") {
                buildTable = '<thead><tr><td>No ' + type + 's to display!</td></tr></thead>';
            }
            else {

                var tHeadRows;
                var tBodyRows = '';

                if (type == "Sale") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Product ID</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ProductID + '</td> +' +
                            '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';
                    }
                }
                else if (type == "OnlineSale") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Product ID</td><td>Store Name</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ProductID + '</td>' +
                            '<td>' + dataAsJson[i].StoreName + '</td>' +
                            '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';
                    }
                }
                else if (type == "Repair") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Type</td><td>Service Cost</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ComputerID + '</td>' +
                            '<td>' + dataAsJson[i].Type + '</td>' +
                            '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                            '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

                    }
                }
                else if (type == "Upgrade") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Part ID</td><td>Service Cost</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ComputerID + '</td>' +
                            '<td>' + dataAsJson[i].PartID + '</td>' +
                            '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                            '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

                    }
                }
                else if (type == "Install") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Software ID</td><td>Service Cost</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ComputerID + '</td>' +
                            '<td>' + dataAsJson[i].SoftwareID + '</td>' +
                            '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                            '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

                    }
                }


                buildTable = '<thead>' +
                    tHeadRows +
                    '</thead>' +
                    '<tbody>' +
                    tBodyRows +
                    '</tbody>';

                console.log(buildTable);
            }

            $("#activityTable").html(buildTable);

        }


    });

}

function updateServiceModal(id, type) {


    $.ajax({
        url: "../includes/getItem.php?id=" + id + "&type=" + type,
        cache: false,
        success: function (data) {
            var item = JSON.parse(data);

            var detailTrs = '';
            var saleTrs = '';
            var price = parseFloat(item.Price);
            var pst = (9.975 / 100) * price;
            var gst = (5 / 100) * price;
            var total = price + gst + pst;

            $("#myModalLabel").html('<h3>' + item.Name + '</h3>')

            if (type == "Laptop" || type == "PC") {
                detailTrs += '<tr><td>Processor</td><td>' + item.CPU + ' Ghz</td></tr>';
                detailTrs += '<tr><td>RAM</td><td>' + item.RAM + ' G</td></tr>';
                detailTrs += '<tr><td>HD</td><td>' + item.HD + ' G</td></tr>';
                detailTrs += '<tr><td>Screen</td><td>' + item.Screen + ' in</td></tr>';
            }

            if (type == "Software") {
                detailTrs += '<tr><td>Category</td><td>' + item.Type + '</td></tr>';
                detailTrs += '<tr><td>Size</td><td>' + item.Size + ' G</td></tr>';
            }

            if (type == "Part") {
                detailTrs += '<tr><td>Type</td><td>' + item.Type + '</td></tr>';
                if (item.Type == "CPU") {
                    detailTrs += '<tr><td>Speed</td><td>' + item.Value + ' GHz</td></tr>';
                }
                if (item.Type == "RAM" || item.Type == "HD") {
                    detailTrs += '<tr><td>Capacity</td><td>' + item.Value + ' G</td></tr>';
                }
                if (item.Type == "Screen") {
                    detailTrs += '<tr><td>Size</td><td>' + item.Value + ' in</td></tr>';
                }
            }

            saleTrs += '<tr><td>' + item.Name + '</td><td></td><td>$ ' + item.Price + '</td></tr>';
            saleTrs += '<tr><td></td><td>PST</td><td>$ ' + pst.toFixed(2) + '</td></tr>';
            saleTrs += '<tr><td></td><td>GST</td><td>$ ' + gst.toFixed(2) + '</td></tr>';
            saleTrs += '<tr><td></td><td>Total</td><td>$ ' + total.toFixed(2) + '</td></tr>';

            $(".modal-body").html(
                '<div class="modal-body col-lg-12">' +
                    '<div class="col-lg-4">' +
                    '<img class="img-responsive" src="../assets/img/10361863.jpg">' +
                    '</div>' +
                    '<div class="col-lg-8">' +
                    '<div class=" panel panel-primary">' +
                    '<div class="panel-heading">' +
                    '<h3 class="panel-title">Details</h3>' +
                    '</div>' +
                    '<div class="panel-body" style="padding: 0;">' +
                    '<div class="table-responsive">' +
                    '<table class="table table-hover table-striped" style="margin: 0">' +
                    '<tbody>' +

                    detailTrs +

                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-12">' +
                    '<div class="panel panel-green">' +
                    '<div class="panel-heading">' +
                    '<h3 class="panel-title">Sale Summary</h3>' +
                    '</div>' +
                    '<div class="panel-body" style="padding: 0;">' +
                    '<div class="table-responsive">' +
                    '<table class="table table-hover table-striped" style="margin: 0">' +
                    '<tbody>' +

                    saleTrs +

                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +

                    '<div class="col-lg-12">' +
                    '<div class="panel panel-red">' +
                    '<div class="panel-heading">' +
                    '<h3 class="panel-title">Customer Info</h3>' +
                    '</div>' +
                    '<div class="panel-body">' +

                    '<div class="col-lg-6">' +
                    '<div>' +
                    '<input class="form-control" placeholder="Customer Name" id="cname" name="cname">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-6">' +
                    '<div>' +
                    '<input class="form-control" placeholder="Customer Address" id="caddr" name="caddr">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
            );


        }
    });

    $(".modal-footer").html(

        '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button onclick="sellItem(' + id + ',&#39' + type + '&#39)" id="processBtn" type="button" class="btn btn-primary">Process</button>'
    );


}

function sellItem(id, type) {

    var valid = true;
    var focus = "";

    var cname = $("#cname").val();
    var caddr = $("#caddr").val();

    if (cname == "") {
        $("#cname").css("border", "1px solid rgba(255,0,0,0.5)");
        valid = false;
        focus = "#cname";
    } else {
        $("#cname").css("border", "1px solid #ccc");
    }

    if (caddr == "") {
        $("#caddr").css("border", "1px solid rgba(255,0,0,0.5)");
        valid = false;
        if (focus == "") focus = "#caddr";
    } else {
        $("#caddr").css("border", "1px solid #ccc");
    }

    if (valid) {
        $.ajax({
            type: "POST",
            url: "../includes/sellItem.php",
            data: "id=" + id + "&type=" + type + "&cname=" + cname + "&caddr=" + caddr,
            cache: false,
            success: function (data) {
                if(data == 1) {
                    $(".modal-footer").html(
                        '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                            '<button onclick="sellItem(' + id + ',&#39' + type + '&#39)" id="processBtn" type="button" class="btn btn-danger">Retry</button>'
                    );
                }
                else {
                    $(".modal-body").html("Sale succesfully processed!");
                    $("#processBtn").remove();
                }
            }
        });
    }
    else {
        $(focus).focus();
    }

}




