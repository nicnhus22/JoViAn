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






    /**                                *
     *            HANDLE ADD EMPLOYEE        *
     *                                */
    $('#add_item_submit').click(function () {

        var valid = true;

        var item_type = $("#item_type").val();
        var dataString = "";

        switch(item_type){

            case "laptop":
                var laptop_name     = $("#laptop_name").val();
                var laptop_cpu      = $("#laptop_cpu").val();
                var laptop_ram      = $("#laptop_ram").val();
                var laptop_screen   = $("#laptop_screen").val();
                var laptop_hd       = $("#laptop_hd").val();
                var laptop_price    = $("#laptop_price").val();
                var laptop_quantity = $("#laptop_quantity").val();

                if (laptop_name == "") {
                    $("#laptop_name").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else{
                    $("#laptop_name").css("border","1px solid #ccc");
                } 
                if(!validNumbers(laptop_cpu)){
                    $("#laptop_cpu").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#laptop_cpu").css("border","1px solid #ccc")
                }
                if(!validNumbers(laptop_ram)){
                    $("#laptop_ram").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#laptop_ram").css("border","1px solid #ccc");
                }
                if(!validNumbers(laptop_hd)){
                    $("#laptop_hd").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#laptop_hd").css("border","1px solid #ccc")
                }
                if(!validNumbers(laptop_price)){
                    $("#laptop_price").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#laptop_price").css("border","1px solid #ccc");
                }
                if(!validNumbers(laptop_quantity)){
                    $("#laptop_quantity").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#laptop_quantity").css("border","1px solid #ccc");
                }
                 if(!validNumbers(laptop_screen)){
                    $("#laptop_screen").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#laptop_screen").css("border","1px solid #ccc");
                }
                break;
            case "pc":
                var pc_name     = $("#pc_name").val();
                var pc_cpu      = $("#pc_cpu").val();
                var pc_ram      = $("#pc_ram").val();
                var pc_hd       = $("#pc_hd").val();
                var pc_price    = $("#pc_price").val();
                var pc_quantity = $("#pc_quantity").val();

                if (pc_name == "") {
                    $("#pc_name").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else{
                    $("#pc_name").css("border","1px solid #ccc");
                } 
                if(!validNumbers(pc_cpu)){
                    $("#pc_cpu").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#pc_cpu").css("border","1px solid #ccc")
                }
                if(!validNumbers(pc_ram)){
                    $("#pc_ram").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#pc_ram").css("border","1px solid #ccc");
                }
                if(!validNumbers(pc_hd)){
                    $("#pc_hd").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#pc_hd").css("border","1px solid #ccc")
                }
                if(!validNumbers(pc_price)){
                    $("#pc_price").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#pc_price").css("border","1px solid #ccc");
                }
                if(!validNumbers(pc_quantity)){
                    $("#pc_quantity").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#pc_quantity").css("border","1px solid #ccc");
                }

                break;
            case "software":




                break;
            case "part":




                break;
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