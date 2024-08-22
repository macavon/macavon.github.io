function swap_image() {
	var me = this;
	var my_image = me.href;
	var the_image = document.getElementById("the_image");
	the_image.src = my_image;
	return false;
}

function attach_handlers() {
	var div = document.getElementById("thumbnails");
	var links = div.getElementsByTagName("a");
	for (var i = 0; i < links.length; ++i)
			links[i].onclick = swap_image;
}

if (document.getElementById) window.onload = attach_handlers;
