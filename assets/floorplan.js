function addListener(el, event_name, listener) {
  if (el.addEventListener)
    el.addEventListener(event_name, listener, false)
  else
    el.attachEvent('on'+event_name, listener)
}

function clear_it(d) {
  var the_content = d.firstChild
  if (the_content) d.removeChild(the_content)
  
}

function show_link(e) {
    var a = e.target || e.srcElement
    var dest = a.href
    var the_div = document.getElementById("linkdisplay")
    clear_it(the_div)
    the_div.appendChild(document.createTextNode(dest))
    if (e.preventDefault) {
      e.stopPropagation()
      e.preventDefault()
    }
    else {
      e.cancelBubble = true
      e.returnValue = false
    }
}

function clear_link(e) {
    clear_it(document.getElementById("linkdisplay"))
}

function setup() {
    var areas = document.getElementsByTagName('area')
    for (var i = 0; i < areas.length; ++i) {
        var a = areas[i]
        addListener(a, "click", show_link)
    }
    
    var fp = document.getElementById("floorplangif")
    addListener(fp, "click", clear_link)
}


if (document.getElementById) setup()
;
