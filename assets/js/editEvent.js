$(document).ready(function () {

    /**                                *
     *            HANDLE ADD EMPLOYEE        *
     *                                */
    $('#edit_item_submit').click(function () {

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
                var laptop_id       = $("#laptop_id").val();

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

                if(valid){
                    var dataString = 'laptop_id=' + laptop_id + '&laptop_name=' + laptop_name + '&laptop_cpu=' + laptop_cpu+'&laptop_ram=' + laptop_ram + 
                                    '&laptop_screen=' + laptop_screen+ '&laptop_hd=' + laptop_hd + '&laptop_price='+laptop_price+ '&laptop_quantity='+laptop_quantity;
                    $.ajax({
                        type: "POST",
                        url: "../includes/items/editLaptop.php",
                        data: dataString,
                        cache: false,
                        success: function(data){
                            if (data == '1'){
                                window.location.href = "inventory.php";
                            }else{
                                $("#employee_add_failure").html(data);
                            }
                        }
                    });
                } 

                break;
            case "pc":
                var pc_name     = $("#pc_name").val();
                var pc_cpu      = $("#pc_cpu").val();
                var pc_ram      = $("#pc_ram").val();
                var pc_hd       = $("#pc_hd").val();
                var pc_price    = $("#pc_price").val();
                var pc_quantity = $("#pc_quantity").val();
                var pc_id       = $("#pc_id").val();

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

                if(valid){
                    var dataString = 'pc_id=' + pc_id + '&pc_name=' + pc_name + '&pc_cpu=' + pc_cpu+'&pc_ram=' + pc_ram + 
                                    '&pc_hd=' + pc_hd+ '&pc_price=' + pc_price + '&pc_quantity='+pc_quantity;
                    $.ajax({
                        type: "POST",
                        url: "../includes/items/editPC.php",
                        data: dataString,
                        cache: false,
                        success: function(data){
                            if (data == '1'){
                                window.location.href = "inventory.php";
                            }else{
                                $("#employee_add_failure").show();
                            }
                        }
                    });
                } 

                break;
            case "software":
                var software_name     = $("#software_name").val();
                var software_type     = $("#software_type").val();
                var software_price    = $("#software_price").val();
                var software_size     = $("#software_size").val();
                var software_quantity = $("#software_quantity").val();
                var software_id       = $("#software_id").val();

                if (software_name == "") {
                    $("#software_name").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else{
                    $("#software_name").css("border","1px solid #ccc");
                } 
                if(software_type == ""){
                    $("#software_type").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#software_type").css("border","1px solid #ccc")
                }
                if(!validNumbers(software_price)){
                    $("#software_price").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#software_price").css("border","1px solid #ccc");
                }
                if(!validNumbers(software_size)){
                    $("#software_size").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#software_size").css("border","1px solid #ccc")
                }
                if(!validNumbers(software_quantity)){
                    $("#software_quantity").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#software_quantity").css("border","1px solid #ccc");
                }

                if(valid){
                    var dataString = 'software_id=' + software_id + '&software_name=' + software_name + '&software_type=' + software_type+'&software_price=' + software_price + 
                                    '&software_size=' + software_size+ '&software_quantity=' + software_quantity;
                    $.ajax({
                        type: "POST",
                        url: "../includes/items/editSoftware.php",
                        data: dataString,
                        cache: false,
                        success: function(data){
                            if (data == '1'){
                                window.location.href = "inventory.php";
                            }else{
                                $("#employee_add_failure").show();
                            }
                        }
                    });
                } 

                break;
            case "part":
                var part_name     = $("#part_name").val();
                var part_value    = $("#part_value").val();
                var part_type     = $("#part_type").val();
                var part_price    = $("#part_price").val();
                var part_quantity = $("#part_quantity").val();

                if (part_name == "") {
                    $("#part_name").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else{
                    $("#part_name").css("border","1px solid #ccc");
                } 
                if(part_type == ""){
                    $("#pc_ram").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#pc_ram").css("border","1px solid #ccc");
                }
                if(!validNumbers(part_value)){
                    $("#part_value").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#part_value").css("border","1px solid #ccc")
                }
                if(!validNumbers(part_price)){
                    $("#part_price").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#part_price").css("border","1px solid #ccc")
                }
                if(!validNumbers(part_quantity)){
                    $("#part_quantity").css("border","1px solid rgba(255,0,0,0.5)"); valid = false;
                }else {
                    $("#part_quantity").css("border","1px solid #ccc");
                }

                if(valid){
                    // var dataString = 'part_name=' + part_name + '&part_type=' + part_type+'&part_value=' + part_value + 
                    //                 '&part_price=' + part_price+ '&part_quantity=' + part_quantity;
                    // $.ajax({
                    //     type: "POST",
                    //     url: "../includes/items/addPart.php",
                    //     data: dataString,
                    //     cache: false,
                    //     success: function(data){
                    //         if (data == '1'){
                    //             window.location.href = "inventory.php";
                    //         }else{
                    //             $("#employee_add_failure").html(data);
                    //             $("#employee_add_failure").show();
                    //         }
                    //     }
                    // });
                }  

                break;
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