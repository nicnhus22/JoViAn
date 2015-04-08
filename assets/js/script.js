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

});

$(".activityTabAnalytics").click(function () {

    $(".tab").removeClass("active");
    $(".tab").removeClass("tab");
    $(this).closest("li").addClass("tab");
    $(this).closest("li").addClass("active");

    var type = $(this).attr("id");

    renderTableAnalytics(type);

    var $target = $('html,body');

});

$(".itemActivityTab").click(function () {

    $(".tab").removeClass("active");
    $(".tab").removeClass("tab");
    $(this).closest("li").addClass("tab");
    $(this).closest("li").addClass("active");

    var type = $(this).attr("id");


    getPartRecords($("#prodID").val(), type);

    var $target = $('html,body');

});


$("#goItemActivity").click(function () {


    var type = $(".tab").find("a").attr("id");

    getPartRecords($("#prodID").val(), type);

    var $target = $('html,body');

});

$("#goActivity").click(function () {


    var type = $(".tab").find("a").attr("id");

    renderTable(type);

    var $target = $('html,body');

});

function getPartRecords(id, type) {
    var beginDate = $("#beginDate").val();
    var endDate = $("#endDate").val();

    console.log(beginDate);
    console.log(endDate);

    var url = "../includes/getItemActivityRecords.php?&id="+id+"&type="+type+"&beginDate=" + beginDate + "&endDate=" + endDate;

    $.ajax({
        url:  url,
        cache: false,
        success: function(data) {

            var dataAsJson = JSON.parse(data);

            console.log(data);

            var buildTable;


            if (dataAsJson == "") {
                buildTable = '<thead><tr><td>No ' + type + 's to display!</td></tr></thead>';
            }
            else {

                var tHeadRows;
                var tBodyRows = '';

                if (type == "Sale") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Product ID</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        var productID  = dataAsJson[i].ProductID;
                        var employeeID = dataAsJson[i].EmployeeID;
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ProductID + '</td> +' +
                            '<td><button class="btn btn-xs btn-success"  data-toggle="modal" data-target="#serviceModal"  onclick="viewActivityDetails(1,'+productID+','+employeeID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';
                    }
                }
                else if (type == "OnlineSale") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Product ID</td><td>Store Name</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        var productID = dataAsJson[i].ProductID;
                        var employeeID = ((typeof dataAsJson[i].EmployeeID) == "object" ? -1 : dataAsJson[i].EmployeeID);
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + (employeeID == -1 ? '-' : employeeID) + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ProductID + '</td>' +
                            '<td>' + dataAsJson[i].StoreName + '</td>' +
                            '<td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#serviceModal"   onclick="viewActivityDetails(2,'+productID+','+employeeID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';
                    }
                }
                else if (type == "Repair") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Type</td><td>Service Cost</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        var productID = dataAsJson[i].ComputerID;
                        var employeeID = dataAsJson[i].EmployeeID;
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ComputerID + '</td>' +
                            '<td>' + dataAsJson[i].Type + '</td>' +
                            '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                            '<td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#serviceModal"   onclick="viewActivityDetails(3,'+productID+','+employeeID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

                    }
                }
                else if (type == "Upgrade") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Part ID</td><td>Service Cost</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        var productID = dataAsJson[i].ComputerID;
                        var employeeID = dataAsJson[i].EmployeeID;
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].ComputerID + '</td>' +
                            '<td>' + dataAsJson[i].PartID + '</td>' +
                            '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                            '<td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#serviceModal" onclick="viewActivityDetails(4,'+productID+','+employeeID+','+dataAsJson[i].PartID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

                    }
                }
                else if (type == "Install") {
                    tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Software ID</td><td>Service Cost</td><td></td></tr>';
                    for (var i = 0; i < dataAsJson.length; i++) {
                        var productID = dataAsJson[i].SoftwareID;
                        var employeeID = dataAsJson[i].EmployeeID;
                        tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                            '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                            '<td>' + dataAsJson[i].CName + '</td>' +
                            '<td>' + dataAsJson[i].SoftwareID + '</td>' +
                            '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                            '<td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#serviceModal" onclick="viewActivityDetails(5,'+productID+','+employeeID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

                    }
                }


                buildTable = '<thead>' +
                    tHeadRows +
                    '</thead>' +
                    '<tbody>' +
                    tBodyRows +
                    '</tbody>';
            }

            $("#activityTable").html(buildTable);

        }
    });
}

function renderActivityHtml (data, type) {
    var dataAsJson = JSON.parse(data);
    var buildTable;


    if (dataAsJson == "") {
        buildTable = '<thead><tr><td>No ' + type + 's to display!</td></tr></thead>';
    }
    else {

        var tHeadRows;
        var tBodyRows = '';

        if (type == "Sale") {
            tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Product ID</td><td></td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                var productID  = dataAsJson[i].ProductID;
                var employeeID = dataAsJson[i].EmployeeID;
                tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                    '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                    '<td>' + dataAsJson[i].CName + '</td>' +
                    '<td>' + dataAsJson[i].ProductID + '</td> +' +
                    '<td><button class="btn btn-xs btn-success"  data-toggle="modal" data-target="#serviceModal"  onclick="viewActivityDetails(1,'+productID+','+employeeID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';
            }
        }
        else if (type == "OnlineSale") {
            tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Product ID</td><td>Store Name</td><td></td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                var productID = dataAsJson[i].ProductID;
                var employeeID = ((typeof dataAsJson[i].EmployeeID) == "object" ? -1 : dataAsJson[i].EmployeeID);
                tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                    '<td>' + (employeeID == -1 ? '-' : employeeID) + '</td>' +
                    '<td>' + dataAsJson[i].CName + '</td>' +
                    '<td>' + dataAsJson[i].ProductID + '</td>' +
                    '<td>' + dataAsJson[i].StoreName + '</td>' +
                    '<td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#serviceModal"   onclick="viewActivityDetails(2,'+productID+','+employeeID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';
            }
        }
        else if (type == "Repair") {
            tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Type</td><td>Service Cost</td><td></td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                var productID = dataAsJson[i].ComputerID;
                var employeeID = dataAsJson[i].EmployeeID;
                tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                    '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                    '<td>' + dataAsJson[i].CName + '</td>' +
                    '<td>' + dataAsJson[i].ComputerID + '</td>' +
                    '<td>' + dataAsJson[i].Type + '</td>' +
                    '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                    '<td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#serviceModal"   onclick="viewActivityDetails(3,'+productID+','+employeeID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

            }
        }
        else if (type == "Upgrade") {
            tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Part ID</td><td>Service Cost</td><td></td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                var productID = dataAsJson[i].ComputerID;
                var employeeID = dataAsJson[i].EmployeeID;
                tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                    '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                    '<td>' + dataAsJson[i].CName + '</td>' +
                    '<td>' + dataAsJson[i].ComputerID + '</td>' +
                    '<td>' + dataAsJson[i].PartID + '</td>' +
                    '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                    '<td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#serviceModal" onclick="viewActivityDetails(4,'+productID+','+employeeID+','+dataAsJson[i].PartID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

            }
        }
        else if (type == "Install") {
            tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Software ID</td><td>Service Cost</td><td></td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                var productID = dataAsJson[i].SoftwareID;
                var employeeID = dataAsJson[i].EmployeeID;
                tBodyRows += '<tr><td>' + dataAsJson[i].Date + '</td>' +
                    '<td>' + dataAsJson[i].EmployeeID + '</td>' +
                    '<td>' + dataAsJson[i].CName + '</td>' +
                    '<td>' + dataAsJson[i].SoftwareID + '</td>' +
                    '<td>' + dataAsJson[i].ServiceCost + '</td>' +
                    '<td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#serviceModal" onclick="viewActivityDetails(5,'+productID+','+employeeID+')"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

            }
        }


        buildTable = '<thead>' +
            tHeadRows +
            '</thead>' +
            '<tbody>' +
            tBodyRows +
            '</tbody>';
    }

    $("#activityTable").html(buildTable);

}

function renderActivityHtmlAnalytics (data, type) {
    var dataAsJson = JSON.parse(data);
    var buildTable;


    if (dataAsJson == "") {
        buildTable = '<thead><tr><td>No ' + type + 's to display!</td></tr></thead>';
    }
    else {

        var tHeadRows;
        var tBodyRows = '';

        if (type == "Sale") {
            tHeadRows = '<tr><td>Product ID</td><td>Product Name</td><td>Product Price</td><td>Quantity Sold</td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                tBodyRows +=
                    '<td>' + dataAsJson[i].ProductID + '</td>' +
                    '<td>' + dataAsJson[i].ProductName + '</td>' +
                    '<td>' + dataAsJson[i].ProductPrice + '</td> +'+
                    '<td>' + dataAsJson[i].Qauntity + '</td> +';
            }
        }
        else if (type == "OnlineSale") {
            tHeadRows = '<tr><td>Product ID</td><td>Product Name</td><td>Product Price</td><td>Quantity Sold</td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                tBodyRows +=
                    '<td>' + dataAsJson[i].ProductID + '</td>' +
                    '<td>' + dataAsJson[i].ProductName + '</td>' +
                    '<td>' + dataAsJson[i].ProductPrice + '</td> +'+
                    '<td>' + dataAsJson[i].Qauntity + '</td> +';
            }
        }
        else if (type == "Repair") {
            tHeadRows = '<tr><td>Product ID</td><td>Product Name</td><td>Product Price</td><td>Quantity Sold</td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                tBodyRows +=
                    '<td>' + dataAsJson[i].ProductID + '</td>' +
                    '<td>' + dataAsJson[i].ProductName + '</td>' +
                    '<td>' + dataAsJson[i].ProductPrice + '</td> +'+
                    '<td>' + dataAsJson[i].Qauntity + '</td> +';
            }
        }
        else if (type == "Upgrade") {
            tHeadRows = '<tr><td>Product ID</td><td>Product Name</td><td>Product Price</td><td>Quantity Sold</td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                tBodyRows +=
                    '<td>' + dataAsJson[i].ProductID + '</td>' +
                    '<td>' + dataAsJson[i].ProductName + '</td>' +
                    '<td>' + dataAsJson[i].ProductPrice + '</td> +'+
                    '<td>' + dataAsJson[i].Qauntity + '</td> +';
            }
        }
        else if (type == "Install") {
            tHeadRows = '<tr><td>Product ID</td><td>Product Name</td><td>Product Price</td><td>Quantity Sold</td></tr>';
            for (var i = 0; i < dataAsJson.length; i++) {
                tBodyRows +=
                    '<td>' + dataAsJson[i].ProductID + '</td>' +
                    '<td>' + dataAsJson[i].ProductName + '</td>' +
                    '<td>' + dataAsJson[i].ProductPrice + '</td> +'+
                    '<td>' + dataAsJson[i].Qauntity + '</td> +';
            }
        }


        buildTable = '<thead>' +
            tHeadRows +
            '</thead>' +
            '<tbody>' +
            tBodyRows +
            '</tbody>';
    }

    $("#activityTable").html(buildTable);

}


function renderTable(type) {

    var beginDate = $("#beginDate").val();
    var endDate = $("#endDate").val();

    var url = "../includes/getEmployeeServiceRecords.php?&type=" + type + "&beginDate=" + beginDate + "&endDate=" + endDate;

    if($("#empID").length > 0) {
        var empID = $("#empID").val();
        url+= "&id=" + empID;
        console.log(url);
    }

    $.ajax({
        url:  url,
        cache: false,
        success: function(data) {
            renderActivityHtml(data, type);
        }
    });

}

function renderTableAnalytics(type) {

    var beginDate = $("#beginDate").val();
    var endDate = $("#endDate").val();

    var url = "../includes/getEmployeeServiceRecords2.php?&type=" + type;

    if($("#empID").length > 0) {
        var empID = $("#empID").val();
        url+= "&id=" + empID;
        console.log(url);
    }

    $.ajax({
        url:  url,
        cache: false,
        success: function(data) {
            renderActivityHtmlAnalytics(data, type);
        }
    });

}


function updateServiceModal(id, type, isRepair) {


    $.ajax({
        url: "../includes/getItem.php?id=" + id + "&type=" + type,
        cache: false,
        success: function (data) {
            var item = JSON.parse(data);

            var detailTrs = '';
            var saleTrs = '';
            var price;
            var pst;
            var gst;
            var total;
            var salesPanelTitle;
            var modalFooter;

            $("#myModalLabel").html('<h3>' + item.Name + '</h3>')

            if (type == "Laptop" || type == "PC" || isRepair) {
                detailTrs += '<tr><td>Processor</td><td>' + item.CPU + ' Ghz</td></tr>';
                detailTrs += '<tr><td>RAM</td><td>' + item.RAM + ' G</td></tr>';
                detailTrs += '<tr><td>HD</td><td>' + item.HD + ' G</td></tr>';
                detailTrs += '<tr><td>Screen</td><td>' + item.Screen + ' in</td></tr>';
            }

            if (type == "Software") {
                detailTrs += '<tr><td>Category</td><td>' + item.Type + '</td></tr>';
                detailTrs += '<tr><td>Size</td><td>' + item.Size + ' G</td></tr>';
                detailTrs += '<tr><td></td><td><div class="checkbox" style="margin: 0;"><label><input id="service" type="checkbox" value="Install">Install</label></div></td></tr>';

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
                detailTrs += '<tr><td></td><td><div class="checkbox" style="margin: 0;"><label><input id="service" type="checkbox" value="Upgrade">Upgrade Existing Computer</label></div></td></tr>';
            }

            if(isRepair) {
                price = 49.99;
                pst = getPst(price);
                gst = getGst(price);
                total = price + gst + pst;
                salesPanelTitle = "Repair Summary";
                saleTrs += '<tr><td>' +
                    '<select id="repairSelect" class="">' +
                        '<option>Hardware: CPU Replacement</option>' +
                        '<option>Hardware: Mother</option>' +
                        '<option>Hardware: Graphic Card Ventilator Replacement</option>' +
                        '<option>Hardware: HD Replacement</option>' +
                        '<option>Software: Malware Clean up</option>' +
                        '<option>Software: Virus Clean up</option>' +
                        '<option>Software: OS Reinstall</option>' +
                        '<option>Software: OS Reinstall</option>' +
                    '</select>'

                    +
                    '</td><td><button onclick="refreshSale()" class="btn btn-xs btn-success"><span class="fa fa-fw fa-refresh" style="vertical-align:middle"></span></button></td><td>$ <input style="width:50px; margin:0; border: none;" type="text" id="serviceCost" value="49.99"></td></tr>';

                    modalFooter =   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                                    '<button onclick="sellItem(' + id + ',&#39' + type + '&#39, true)" id="processBtn" type="button" class="btn btn-primary">Process</button>';

            }
            else {

                price = parseFloat(item.Price);
                pst = getPst(price);
                gst = getGst(price);
                total = price + gst + pst;
                salesPanelTitle = "Sale Summary";

                saleTrs += '<tr><td>' + item.Name + '</td><td></td><td>$ ' + '<span id="price">' +item.Price + '</span></td></tr>';

                modalFooter =   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                    '<button onclick="sellItem(' + id + ',&#39' + type + '&#39, false)" id="processBtn" type="button" class="btn btn-primary">Process</button>';

            }

            saleTrs += '<tr id="pst"><td></td><td>PST</td><td>$ ' + '<span id="pstTax">'+pst.toFixed(2) + '</span></td></tr>';
            saleTrs += '<tr><td></td><td>GST</td><td>$ ' + '<span id="gstTax">'+gst.toFixed(2) + '</span></td></tr>';
            saleTrs += '<tr><td></td><td>Total</td><td>$ ' + '<span id="total">'+total.toFixed(2) + '</span></td></tr>';



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
                    '<h3 class="panel-title">'+salesPanelTitle+'</h3>' +
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
                    '<div id="custInfoWrapper" class="col-lg-6">' +
                    '<div>' +
                    '<input class="form-control" placeholder="Customer Address" id="caddr" name="caddr">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
            );

            $(".modal-footer").html(modalFooter);
        }


    });




}

function sellItem(id, type, isRepair) {

    var valid = true;
    var focus = "";
    var cname = $("#cname").val();
    var caddr = $("#caddr").val();
    var service;

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
        dataString = "id=" + id + "&type=" + type + "&cname=" + cname + "&caddr=" + caddr;


        if($("#service").is(':checked')) {
            service = $("#service").val();
            dataString += "&service=" + service + "&serviceCost=" + parseFloat($("#serviceCost").val());

            if($("#service").val() == "Upgrade") {
                console.log($("#computerSelect").val());
                dataString += "&compID=" + $("#computerSelect").val();
            }

        }

        if(isRepair) {
            console.log(isRepair);
            dataString += "&service=Repair&serviceCost=" + parseFloat($("#serviceCost").val());
            dataString += "&desc=" + $( "#repairSelect option:selected").text();
        }





        $.ajax({
            type: "POST",
            url: "../includes/sellItem.php",
            data: dataString,
            cache: false,
            success: function (data) {
                console.log(data);
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

$(document).on('change', '#service', function() {
    if($("#service").is(':checked')) {

        var price = parseFloat($("#price").html()) + 14.99;
        var pst = getPst(price);
        var gst = getGst(price)
        var total = price + gst + pst;

        if($("#service").val() == "Install") {
            console.log("install");
            $('<tr id="serviceRow"><td>Install</td><td>' +
                ' <button onclick="refreshSale()" class="btn btn-xs btn-success"><span class="fa fa-fw fa-refresh" style="vertical-align:middle"></span></button>' +
                '</td><td>$ <input style="width:50px; margin:0; border: none;" type="text" id="serviceCost" value="2.99"></td></tr>').insertBefore('#pst');
        }
        else if ($("#service").val() == "Upgrade") {
            console.log("Upgrade");
            $('<tr id="serviceRow"><td>Upgrade</td><td>' +
                ' <button onclick="refreshSale()" class="btn btn-xs btn-success"><span class="fa fa-fw fa-refresh" style="vertical-align:middle"></span></button>' +
                '</td><td>$ <input style="width:50px; margin:0; border: none;" type="text" id="serviceCost" value="14.99"></td></tr>').insertBefore('#pst');

            $.ajax({
                type: "GET",
                url: "../includes/getComputers.php",
                cache: false,
                success: function (data) {
                    var dataAsJson = JSON.parse(data);

                    var computerOptions = '<div class="col-lg-12"><select id="computerSelect" class="form-control" style="margin-top: 15px;">';

                    for(var i = 0; i < dataAsJson.length; i++)
                        computerOptions+= '<option value="'+dataAsJson[i].ID+'">'+dataAsJson[i].Name+'</option>';

                    computerOptions+='</select></div>';

                    $(computerOptions).insertAfter("#custInfoWrapper");
                }
            });
        }

        $("#pstTax").html(pst.toFixed(2));
        $("#gstTax").html(gst.toFixed(2));
        $("#total").html(total.toFixed(2));

    }
    else {

        var price = parseFloat($("#price").html());
        var pst = getPst(price);
        var gst = getGst(price)
        var total = price + gst + pst;

        $('#serviceRow').remove();

        if($("#service").val() == "Upgrade") {
            $("#computerSelect").remove();
        }

        $("#pstTax").html(pst.toFixed(2));
        $("#gstTax").html(gst.toFixed(2));
        $("#total").html(total.toFixed(2));
    }
});

function getPst(price) {
    return price * (9.975/100);
}

function getGst(price) {
    return price * (5/100);
}

function refreshSale() {
    var price;

    if($("#price").length) {
        price = parseFloat($("#price").html()) + parseFloat($("#serviceCost").val());
    }
    else {
        price = parseFloat($("#serviceCost").val());
    }
    var pst = getPst(price);
    var gst = getGst(price)
    var total = price + gst + pst;

    $("#pstTax").html(pst.toFixed(2));
    $("#gstTax").html(gst.toFixed(2));
    $("#total").html(total.toFixed(2));

}



function viewActivityDetails(type,productID,employeeID,partID){

    switch(type){
        // Sale
        case 1:
            $.ajax({
                type: "GET",
                url: "../includes/getSales.php?ProductID="+productID+"&EmployeeID="+employeeID,
                cache: false,
                success: function (data) {
                    var dataAsJson = JSON.parse(data);

                    $("#activity_title").html("Sale - ProductID#"+productID);

                    $(".modal-body").html(   

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-green">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Product Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Product Name</td><td>'+ dataAsJson.Product.Name+'</td></tr>'+
                                            '<tr><td>Product Price</td><td>'+dataAsJson.Product.Price+'$</td></tr>'+
                                            '<tr><td>Employee Comission</td><td>'+parseFloat(parseFloat(dataAsJson.Employee.Commission)*parseFloat(dataAsJson.Product.Price)/100).toFixed(2)+'$</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-red">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Employee Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Employee Name</td><td>'+ dataAsJson.Employee.Name+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-primary">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">General Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Client Name</td><td>'+ dataAsJson.Sale.CName+'</td></tr>'+
                                            '<tr><td>Client Address</td><td>'+ dataAsJson.Sale.CAddress+'</td></tr>'+
                                            '<tr><td>Sale Date</td><td>'+ dataAsJson.Sale.Date+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'

                    );


                    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');

                }
            });
            break;
        // Online Sale
        case 2:
            if(employeeID != -1) 
                var ajaxUrl = "../includes/getOnlineSales.php?ProductID="+productID+"&EmployeeID="+employeeID;
            else
                var ajaxUrl = "../includes/getOnlineSales.php?ProductID="+productID;
            $.ajax({
                type: "GET",
                url: ajaxUrl,
                cache: false,
                success: function (data) {
                    var dataAsJson = JSON.parse(data);

                    $("#activity_title").html("OnlineSale - ProductID#"+productID);

                    $(".modal-body").html(   

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-green">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Product Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Product Name</td><td>'+ dataAsJson.Product.Name+'</td></tr>'+
                                            '<tr><td>Product Price</td><td>'+dataAsJson.Product.Price+'$</td></tr>'+
                                            '<tr><td>Employee Comission</td><td>'+parseFloat(parseFloat(dataAsJson.Employee.Commission)*parseFloat(dataAsJson.Product.Price)/100).toFixed(2)+'$</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-red">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Employee Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Employee Name</td><td>'+ (employeeID == -1 ? "No employee for this online sale." : dataAsJson.Employee.Name)+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-primary">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">General Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Client Name</td><td>'+ dataAsJson.OnlineSale.CName+'</td></tr>'+
                                            '<tr><td>Client Address</td><td>'+ dataAsJson.OnlineSale.CAddress+'</td></tr>'+
                                            '<tr><td>Sale Date</td><td>'+ dataAsJson.OnlineSale.Date+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'

                    );


                    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');

                }
            });
            break;
        // Repair
        case 3:
            $.ajax({
                type: "GET",
                url: "../includes/getRepairs.php?ProductID="+productID+"&EmployeeID="+employeeID,
                cache: false,
                success: function (data) {
                    var dataAsJson = JSON.parse(data);

                    $("#activity_title").html("Repair - ProductID#"+productID);

                    $(".modal-body").html(   

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-green">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Product Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Product Name</td><td>'+ dataAsJson.Product.Name+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-red">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Employee Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Employee Name</td><td>'+dataAsJson.Employee.Name+'</td></tr>'+
                                            '<tr><td>Service Cost</td><td>'+dataAsJson.Repair.ServiceCost+' $</td></tr>'+
                                            '<tr><td>Employee Comission</td><td>'+parseFloat(parseFloat(dataAsJson.Employee.Commission)*parseFloat(dataAsJson.Repair.ServiceCost)/100).toFixed(2)+'$</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-primary">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">General Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Repair Type</td><td>'+ dataAsJson.Repair.Type+'</td></tr>'+
                                            '<tr><td>Client Name</td><td>'+ dataAsJson.Repair.CName+'</td></tr>'+
                                            '<tr><td>Client Address</td><td>'+ dataAsJson.Repair.CAddress+'</td></tr>'+
                                            '<tr><td>Sale Date</td><td>'+ dataAsJson.Repair.Date+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'

                    );


                    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');

                }
            });
            break;
        // Upgrade
        case 4:
            $.ajax({
                type: "GET",
                url: "../includes/getUpgrades.php?ProductID="+productID+"&EmployeeID="+employeeID+"&PartID="+partID,
                cache: false,
                success: function (data) {
                    var dataAsJson = JSON.parse(data);

                    $("#activity_title").html("Upgrade - ProductID#"+productID);

                    $(".modal-body").html(   

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-green">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Product Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Product Name</td><td>'+ dataAsJson.Product.Name+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-red">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Employee Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Employee Name</td><td>'+dataAsJson.Employee.Name+'</td></tr>'+
                                            '<tr><td>Service Cost</td><td>'+dataAsJson.Upgrade.ServiceCost+' $</td></tr>'+
                                            '<tr><td>Employee Comission</td><td>'+parseFloat(parseFloat(dataAsJson.Employee.Commission)*parseFloat(dataAsJson.Upgrade.ServiceCost)/100).toFixed(2)+'$</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-primary">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">General Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Upgraded Part</td><td>'+ dataAsJson.Part.Name+'</td></tr>'+
                                            '<tr><td>Part Price</td><td>'+ dataAsJson.Part.Price+' $</td></tr>'+
                                            '<tr><td>Client Name</td><td>'+ dataAsJson.Upgrade.CName+'</td></tr>'+
                                            '<tr><td>Client Address</td><td>'+ dataAsJson.Upgrade.CAddress+'</td></tr>'+
                                            '<tr><td>Sale Date</td><td>'+ dataAsJson.Upgrade.Date+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'

                    );


                    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');

                }
            });
            break;
        // Install
        case 5:
            $.ajax({
                type: "GET",
                url: "../includes/getInstall.php?ProductID="+productID+"&EmployeeID="+employeeID,
                cache: false,
                success: function (data) {
                    var dataAsJson = JSON.parse(data);

                    $("#activity_title").html("Install - ProductID#"+productID);

                    $(".modal-body").html(   

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-green">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Product Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Product Name</td><td>'+ dataAsJson.Software.Name+'</td></tr>'+
                                            '<tr><td>Product Price</td><td>'+dataAsJson.Software.Price+'$</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-red">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">Employee Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Employee Name</td><td>'+dataAsJson.Employee.Name+'</td></tr>'+
                                            '<tr><td>Service Cost</td><td>'+dataAsJson.Install.ServiceCost+'</td></tr>'+
                                            '<tr><td>Employee Comission</td><td>'+parseFloat(parseFloat(dataAsJson.Employee.Commission)*parseFloat(dataAsJson.Install.ServiceCost)/100).toFixed(2)+'$</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'+

                    '<div class="col-lg-12">' +
                        '<div class="panel panel-primary">' +
                            '<div class="panel-heading">' +
                                '<h3 class="panel-title">General Information</h3>' +
                            '</div>' +
                            '<div class="panel-body" style="padding: 0;">' +
                                '<div class="table-responsive">' +
                                    '<table class="table table-hover table-striped" style="margin: 0">' +
                                        '<tbody>' +
                                            '<tr><td>Client Name</td><td>'+ dataAsJson.Install.CName+'</td></tr>'+
                                            '<tr><td>Client Address</td><td>'+ dataAsJson.Install.CAddress+'</td></tr>'+
                                        '</tbody>' +
                                    '</table>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'

                    );


                    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');

                }
            });
            break;
    }

}


function renderMap () {

        var mapOptions = {
            center: { lat: -34.397, lng: 150.644},
            zoom: 5
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

    $.ajax({
        type: "GET",
        url: "../includes/getPostalCodes.php",
        cache: false,
        success: function (data) {
            var postalCodes = [];
            dataAsJson = JSON.parse(data);

            for(var i = 0; i < dataAsJson.length; i++) {


                $.ajax({
                    type: "GET",
                    url: "https://maps.googleapis.com/maps/api/geocode/json?address="+ dataAsJson[i].CAddress.split(",")[3] +"&key=AIzaSyBKccuEfSB_LplDy-S43ALZ1acme0xmk2k",
                    cache: false,
                    success: function (location) {

                        if(location.status == "OK") {

                               var myLatlng = new google.maps.LatLng(location.results[0].geometry.location.lat, location.results[0].geometry.location.lng);

                            map.setCenter(myLatlng);
                            var marker = new google.maps.Marker({
                                   position: myLatlng
                               });
                               marker.setMap(map);

                    }
                }
                });


            }
        }
    });
}