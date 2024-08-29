<?php
function extract_data($s) {
	$a = array();
	$items = split('&', $s);
	foreach ($items as $i) {
		$it = split('=', $i);
		$name = urldecode($it[0]);
		$value = empty($it[1])? '': urldecode($it[1]);
		if (isset($a[$name])) 
			if (is_array($a[$name]))
				$a[$name][] = $value;
			else {
				$x = $a[$name];
				$a[$name] = array();
				$a[$name][] = $x;
				$a[$name][] = $value;
			}
		else $a[$name] = $value;
	}
	return $a;
}

function do_array_rows($k, $a) {
	$n = count($a);
	$v1 = $a[0];
	echo("<tr><td rowspan=\"$n\">$k</td><td>$v1</td></tr>\n");
	for ($i=1; $i<$n; $i++) {
		$vi = $a[$i];
		echo("<tr><td>$vi</td></tr>\n");
	}
}

function format_data_string($ds) {
	return str_replace('&', "&<br />", $ds);
}

$method = $_SERVER['REQUEST_METHOD'];
$data_string = $method == 'GET'? $_SERVER['QUERY_STRING']:
               file_get_contents("php://input");
$request_data = extract_data($data_string);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="../../../styles.css" type="text/css" media="screen" title="default styles" charset="utf-8" />
<link rel="icon" href="../../../favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon" />
<title>Digital Media Tools -- Form Variable Dump</title>




<style type="text/css" media="screen">
	th, tr {
		padding: 0.25em 2em;
		border: solid 1px #5d9282;
	}
</style>

</head>

<body>

<div class="ident">
<div class="blobs">
	<span class="blob1">&nbsp;</span>
	<span class="blob2">&nbsp;</span>
	<span class="blob3">&nbsp;</span>
</div><a accesskey="1" tabindex="0" href="/">digital<span id="media">media</span>tools</a>
<ul class="accessnavbar">
<li><a tabindex="1" accesskey="S" href="#main">Skip To Content</a></li>
<li><a tabindex="2" accesskey="3" href="../../../Info/sitemap.html">Site Map</a></li>
<li><a tabindex="3" accesskey="0" href="../../../Info/accessibility.html">Accessibility Statement</a></li>
</ul>
</div>





<ul class="navbar">
   <li><a accesskey="1" href="../../../index.html">The Book</a></li>
   <li><a href="../../../Book/index.html">Resources</a></li>
   <li><a href="../../../Info/index.html">Information</a></li>
   <li><a href="../../../OurBooks/webdesign.html">Other Books</a></li>
   
</ul>





<ul class="navbar navbar2">
	<li><a href="../../../Book/index.html">Teaching and Learning</a></li>
	<li><a href="../../../Book/Glossary/index.php">Glossary</a></li>
	<li><a href="../../../Book/Tips/index.html">Hints and Tips</a></li>
	<li><a href="../../../Book/Projects/index.html">Projects</a></li>
	<li><a href="../../../Book/Samples/index.html">Sample Material</a></li>
</ul>





<div id="main">
<div id="ie6fix">&nbsp;</div>
	

<div class="leftpane">
<a href="../../../index.html" class="unstyled"><img src="../../../Resources/Digital-Media-Tools-small-cover.jpg" width="130" height="162" alt="Digital Media Tools Small Cover" /></a>

<p id="amazon">See the book at <a href="http://www.amazon.co.uk/gp/product/0470012277?ie=UTF8">amazon.co.uk</a> or <a href="http://www.amazon.com/gp/product/0470012277">amazon.com</a></p>

<p class="copyright">The authors are not responsible for the content of any external sites linked to from digitalmediatools.org</p>
<p class="copyright">All material on this site is &copy;2007–2010 <a href="http://macavonmedia.com/">MacAvon Media</a> and may not be reproduced without permission.</p>
</div>



<h1>Form Variables</h1>

<p>The form variables were sent in the following query string (newlines have been added after &amp; characters to avoid excessively long line):</p>
<p>

	<?= format_data_string($data_string) ?>
</p>
<p>Here are the decoded values of the variables submitted from your form.</p>

<p>
	<table>
		<tr><th>Name</th><th>Value</th></tr>
<?php
foreach ($request_data as $k => $v)	
	if (is_array($v))
		do_array_rows($k, $v);
	else
		echo("<tr><td>$k</td><td>$v</td></tr>\n");

?>
	</table>
</p>

</div>
</body>
</html>
