<head>
<meta charset="ISO-8859-1">
<title>Clock-In</title>
<link rel="stylesheet" href="_stile.css" type="text/css">
<style type="text/css">
div#container {
	width:				800px;
	margin:				50px auto;
	padding:			50px;
	background-color:	rgb(245,245,245);
	text-align:			center;
}

fieldset {
	width:				700px;
	margin:				0 auto;
	padding:			50px;
	font-size:			2.5em;
	font-weight:		bold;
}
</style>
<script type="text/javascript" src="_codice.js"></script>
<script type="text/javascript">

var myWin

window.onload=function()
{
	myWin=window.open('_login.php', 'clessidraweb')
	if (myWin) {
		document.getElementById('msg').innerHTML='la chiusura della finestra in modo accidentale o dolosa comporta la sospensione temporanea al servizio di timbratura con conseguente registrazione dell&apos; evento accaduto'
		setTimeout('myWin.focus()',200)
		window.blur()
	}
	
//	la chiusura di questa finestra chiude anche 'webquiz'
	window.onunload=function() { myWin.close()} 
}  



</script>
</head>
<body>
<br><br><br><br><br>
<div id="container">
<fieldset id="msg">la chiusura della finestra in modo accidentale o dolosa comporta la sospensione temporanea al servizio di timbratura con conseguente registrazione dell&apos; evento accaduto</fieldset>
<br><p id="chiusa">&nbsp;</p>
</div>


</body>