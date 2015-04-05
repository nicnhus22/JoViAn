
/**
 *  New employee event
 */
function route_newEmployee() {	window.location.href = "newemployee.php";	}
function route_viewEmployee(empID) {    window.location.href = "viewemployee.php?ID=" + empID;	}
function route_newItem() {	window.location.href = "newItem.php";	}
function route_editItem(id,type) {	window.location.href = "editItem.php?id="+id+"&type="+type;	}
function route_inventory() {	window.location.href = "inventory.php";	}