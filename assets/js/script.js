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
			beforeSend: function(){ $("#login_submit").val('Connecting...');},
			success: function(data){
				if(data == '1') {
					window.location.href = "views/dashboard.php";
				} else{
					$("#email").css("border","1px solid rgba(255,0,0,0.5)");
					$("#password").css("border","1px solid rgba(255,0,0,0.5)");
				}
			}
		});
		return false;
	});

    //initialize the date picker for date input
    $( ".datepicker" ).datepicker({dateFormat:'yy-mm-dd' });
});

function deleteRow(button) {
    button.closest('tr').remove();
}

$(".employeeTab").click(function(){

    $(".tab").removeClass("active");
    $(".tab").removeClass("tab");
    $(this).closest("li").addClass("tab");
    $(this).closest("li").addClass("active");


    var parent = $(this).nex
    var type = $(this).attr("id");
    var empID = $("#empID").text();
    var beginDate = $("#beginDate").val();
    var endDate = $("#endDate").val();

    $.ajax({
        url: "../includes/getEmployeeServiceRecords.php?id=" + empID + "&type=" + type + "&beginDate=" + beginDate + "&endDate=" + endDate,
        cache: false,
        success: function(data){
            console.log(data);
        }
    });

});


