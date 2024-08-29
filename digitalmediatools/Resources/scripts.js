function getRequestObject() {
	return window.XMLHttpRequest?
		new XMLHttpRequest():
		new ActiveXObject("Msxml2.XMLHTTP");
}

var the_request;

function get_price() {
	the_request = getRequestObject();
	var the_url = "/webdesignbook/Resources/amazon.php";
	the_request.onreadystatechange = handle_response;
	the_request.open(the_url);
	the_request.send(null);
}

function handle_response() {
	if (the_request.readyState == 4 &&
			the_request.status == 200) {
		build_price(the_request.responseXML)
	}
}

function build_price(xml_data) {
	var the_para = document.getElementById("amazon");
	var t = document.createTextNode("XXXXX");
	the_para.appendChild(t);
}

if (document.getElementById)
	window.onload = get_price;