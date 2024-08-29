function open_window(e) {
	var event = e? e: window.event
	if (event.shiftKey || event.altKey || event.ctrlKey || event.metaKey)
		return true;
	return window.open(this.href)? false: true
}

if (document.getElementById) window.onload = function() {
	var links = document.getElementsByTagName('a')
	for (var i = 0; i < links.length; ++i)
		if (links[i].className == "window") links[i].onclick = open_window
}
