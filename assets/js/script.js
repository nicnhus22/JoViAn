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
    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd' ,
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

function renderTable (type) {


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

            if(dataAsJson == "") {
                buildTable = '<thead><tr><td>No ' + type +'s to display!</td></tr></thead>';
            }
            else {

            var tHeadRows;
            var tBodyRows = '';

            if(type == "Sale") {
                tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Product ID</td><td></td></tr>';
                for(var i = 0; i < dataAsJson.length; i++) {
                    tBodyRows += '<tr><td>' + dataAsJson[i].Date +'</td>' +
                        '<td>' + dataAsJson[i].EmployeeID +'</td>' +
                        '<td>' + dataAsJson[i].CName +'</td>' +
                        '<td>' + dataAsJson[i].ProductID +'</td> +' +
                        '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';
                }
            }
            else if (type == "OnlineSale") {
                tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Product ID</td><td>Store Name</td><td></td></tr>';
                for(var i = 0; i < dataAsJson.length; i++) {
                    tBodyRows += '<tr><td>' + dataAsJson[i].Date +'</td>' +
                        '<td>' + dataAsJson[i].EmployeeID +'</td>' +
                        '<td>' + dataAsJson[i].CName +'</td>' +
                        '<td>' + dataAsJson[i].ProductID +'</td>' +
                        '<td>' + dataAsJson[i].StoreName +'</td>' +
                        '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';
                }
            }
            else if (type == "Repair") {
                tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Type</td><td>Service Cost</td><td></td></tr>';
                for(var i = 0; i < dataAsJson.length; i++) {
                    tBodyRows += '<tr><td>' + dataAsJson[i].Date +'</td>' +
                        '<td>' + dataAsJson[i].EmployeeID +'</td>' +
                        '<td>' + dataAsJson[i].CName +'</td>' +
                        '<td>' + dataAsJson[i].ComputerID +'</td>' +
                        '<td>' + dataAsJson[i].Type +'</td>' +
                        '<td>' + dataAsJson[i].ServiceCost +'</td>' +
                        '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

                }
            }
            else if (type == "Upgrade") {
                tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Part ID</td><td>Service Cost</td><td></td></tr>';
                for(var i = 0; i < dataAsJson.length; i++) {
                    tBodyRows += '<tr><td>' + dataAsJson[i].Date +'</td>' +
                        '<td>' + dataAsJson[i].EmployeeID +'</td>' +
                        '<td>' + dataAsJson[i].CName +'</td>' +
                        '<td>' + dataAsJson[i].ComputerID +'</td>' +
                        '<td>' + dataAsJson[i].PartID +'</td>' +
                        '<td>' + dataAsJson[i].ServiceCost +'</td>' +
                        '<td><button class="btn btn-xs btn-success"><span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>View</button></td></tr>';

                }
            }
            else if (type == "Install") {
                tHeadRows = '<tr><td>Date</td><td>Employee ID</td><td>Customer Name</td><td>Computer ID</td><td>Software ID</td><td>Service Cost</td><td></td></tr>';
                for(var i = 0; i < dataAsJson.length; i++) {
                    tBodyRows += '<tr><td>' + dataAsJson[i].Date +'</td>' +
                        '<td>' + dataAsJson[i].EmployeeID +'</td>' +
                        '<td>' + dataAsJson[i].CName +'</td>' +
                        '<td>' + dataAsJson[i].ComputerID +'</td>' +
                        '<td>' + dataAsJson[i].SoftwareID +'</td>' +
                        '<td>' + dataAsJson[i].ServiceCost +'</td>' +
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


