// Validating Empty Field
function check_empty() {
	if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
		alert("Fill All Fields !");
	} else {
		document.getElementById('form').submit();
		alert("Form Submitted Successfully...");
	}
}
//Function To Display Popup
function div_show() {
	document.getElementById('abc').style.display = "block";
}
function div1_show(){
	document.getElementById('del').style.display = "block";
}
function div2_show() {
        document.getElementById('edit').style.display = "block";
}
function div4_show() {
        document.getElementById('ent').style.display = "block";
}

//Function to Hide Popup
function div_hide(){
	document.getElementById('abc').style.display = "none";
}
function div1_hide(){
	document.getElementById('del').style.display = "none";
}
function div2_hide(){
        document.getElementById('edit').style.display = "none";
}
function div4_hide(){
        document.getElementById('ent').style.display = "none";
}

function div3_hide(){
        document.getElementById('update').style.display = "none";
	 window.location.assign("cashier.php");
}

function hide_products(){
	document.getElementById('abc').style.display = "none";
	window.location="adminproducts.php";
}
function hide_retailers(){
	document.getElementById('abc').style.display = "none";
	window.location="retailers.php";
}
function hide_expenditure(){
	document.getElementById('abc').style.display = "none";
	window.location="expenditure.php";
}
function hide_user(){
	document.getElementById('abc').style.display = "none";
	window.location="admin.php";
}

