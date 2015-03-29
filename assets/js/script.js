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
                    window.location.href = "protected.php";
                } else {
                    $("#email").css("border", "1px solid rgba(255,0,0,0.5)");
                    $("#password").css("border", "1px solid rgba(255,0,0,0.5)");
                }
            }
        });
        return false;
    });

<<<<<<< HEAD
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
=======
>>>>>>> 4a93e134a00f1ea91ee8343fff31708e929b3ed1

});

$("#new-employee-btn").click(function () {
    window.location.href = "newemployee.php";
});