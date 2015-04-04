$(document).ready(function () {

	/**                                *
     *            HANDLE ADD EMPLOYEE        *
     *                                */
    $('#add_employee_submit').click(function () {

    	var valid = true;

        var firstName 	= $("#employee_first_name").val();
        var lastName 	= $("#employee_last_name").val();
        var DOE 		= $("#employee_DOE").val();
        var commission  = $("#employee_commission").val();
        var annualPay  	= $("#employee_annual_pay").val();
        var seniority   = $("#privilege").val();

        if (firstName == "") {
        	$("#employee_first_name").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
        }else{
        	$("#employee_first_name").css("border","1px solid #ccc");
        } 
        if(lastName == ""){
        	$("#employee_last_name").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
        }else {
        	$("#employee_last_name").css("border","1px solid #ccc");
        }
        if (DOE == ""){
        	$("#employee_DOE").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
        }else {
        	$("#employee_DOE").css("border","1px solid #ccc")
        }
        if(!validNumbers(commission)){
        	$("#employee_commission").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
        }else {
        	$("#employee_commission").css("border","1px solid #ccc")
        }
        if(!validNumbers(annualPay)){
        	$("#employee_annual_pay").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
		}else {
			$("#employee_annual_pay").css("border","1px solid #ccc");
		}

		if(valid){
			var dataString = 'firstName=' + firstName + '&lastName=' + lastName+'&DOE=' + DOE + '&commission=' + commission+ '&annualPay=' + annualPay + '&seniority='+seniority;
			$.ajax({
				type: "POST",
				url: "../includes/addEmployee.php",
				data: dataString,
				cache: false,
				success: function(data){
					if (data == '1'){
						window.location.href = "employees.php";
					}else{
						$("#employee_add_failure").show();
					}
				}
			});
		} 

		return false;
	});

});

function validNumbers(number){
	if(isNaN(number) || number == ""){
		return false;
	} else {
		return number >= 0;
	}
}