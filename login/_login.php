<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>_webquiz Ajax</title>
<link rel="stylesheet" href="_stile.css" type="text/css">
<script type="text/javascript" src="_codice.js?1.18.7"></script>
<script type="text/javascript" src="app/lettoreQr/instascan.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type='text/css'>
.errore
{
	background-color:red;
    color:white;
    
}
.successo
{
	background-color:lightgreen;
    color:white;
    
}
div#container {
	width:				520px;
	margin:				20px auto;
	padding:			30px 20px 10px 20px;
	background-color:	rgb(245,245,245);
	text-align:			center;
	display:			none;
}
div#avviso {
	width:				540px;
	margin:				20px auto;
	padding:			20px;
	background-color:	rgb(245,245,245);
	text-align:			center;
	display:			block;
	font-size:			24pt;
	font-weight:		bold;
}
div#versione {
	text-align:			center;
	font-size:			8pt;
	font-style:			italic;
	margin-top:			20px;
}
div#segnala {
	margin:				0px;
	color:				red;
	font-weight:		bold;
}
input {
	width:				150px;
	height:				24px;
	margin:				10px;
	text-align:			center;
}
p {
	margin:				20px;
}
fieldset {
	width:				490px;
	margin:				20px auto;
	padding:			20px 0px;
}
legend {
	padding:			0px 10px;
	margin:				0px 10px;
}
#preview{
	width:60%;
    height:50%;
    display:none;
}
#fotoUtente{
	width:50px;
    height:50px;
    display: none;
}
#statoWebCam{
	display:none;
}
#riepilogoUtenza{
	display:none;
}
#infoSys{
	display:none;
    width:100%;
    margin-left:auto;
    margin-right:auto;
    text-align:center;
}
div#alertTastoDxDisabilitato {
	display:			none;
	width:				80%;
    position:			absolute;
	padding:			50px;
	background-color:	red;
	margin-left:		auto;
    margin-right:		auto;
	font-size:			24pt;
	font-weight:		bold;
}

/*jjjjjj*/
  
  	#container2
    {
    	width:98%;
        height:98%;
		
        background-color: lightgray;
        color: black;
        font-family: Verdana, Serif;
        font-size:12px;
        float: left;
        margin-left: auto;
        margin-right:auto;
     }
  	#container_domande{
    	height: 70%;
        width: 25%;
        float: left;
        background-color: lightgray;
        color: black;
        font-family: Verdana, Serif;
        font-weight: bold;
        font-size:12px;
        padding: 1%;
        border:1px solid black;
    }
    .domanda
    {
    	text-decoration: none;
    }
    #infoAzienda
    {
        border:1px solid black;
    	height: 20%;
        width: 25%;
        float:left;
        padding:1%;
    }
    #infoTest
    {
        border:1px solid black;
    	height: 20%;
        width: 67%;
      	float:left;
        padding:1%;
    }
  	#mostraRisposte{
    	height: 70%;
        width: 67%;
        border:1px solid black;
        float: left;
        padding:1%;

    }
    .bloccoDomanda{
    	
        background-color: gray;
       
		
    }
  




</style>
</head>

<body>


<div id='avviso'>
metti il video in full screen digitando il tasto &lt;F11&gt;
<p id='conta'></p>
<p id='dati'></p>
</div>


<div id="alert"></div>

<div id="container">
<form name="f1" action="_login.php" method="POST" onsubmit="return testF11()">

<div id="gruppoLogin">
<label>Password: </label><input type="password" name="pwd" id="pwd">
<button type="button" onclick="controllapwd()" id="cpwd">Attiva</button>
<p id="errore"></p>
</div>

<div id='segnala'></div>
<div id='versione'>www.marioperna.altervista.org/public/webquiz</div>

</form>
</div>

<div id="container2">
	<div id="infoAzienda"></div>
    <div id="infoTest"></div>
  <div id="container_domande">
    <?php
    require("../connessione.php");

    $sql = "SELECT id, domanda FROM _webquiz ORDER BY rand()";
    $ris = mysql_query($sql) or die("errore esecuzione query");

    while($row = mysql_fetch_array($ris))
    {
	  echo "
      		<a href=javascript:void(0); id=".$row["id"]." class='domanda' OnClick=\"leggiDom('".$row["id"]."')\">".$row["domanda"]."</a>
      <hr/>";        
    }
	
    ?>
  </div>
  <div id="mostraRisposte">
      <input type="checkbox" name="r[]" id="r1" value=""><label id="lab_r1"></label> <br>
      <input type="checkbox" name="r[]" id="r2" value=""><label id="lab_r2"></label>  <br>
      <input type="checkbox" name="r[]" id="r3" value=""><label id="lab_r3"></label>  <br>
      <input type="checkbox" name="r[]" id="r4"  value=""><label id="lab_r4"></label>  <br>
      <input type="hidden" id="idDom" name="idDom" value="">
      
       <textarea rows="4" cols="50" id="commento" onfocusout="inserisciCommento()"></textarea>
              <textarea rows="4" cols="50" id="domAperta" onfocusout="inserisciCommento()"></textarea> 

   </div>
</div>

<script type="text/javascript">
/* da qui in poi*/
 $("#container2").css({"display": "none"});
   function controllapwd()
   {
      	var pwd = $("#pwd").val();
        $
      	$('.attesa').show();
        $.ajax({
          // definisco il tipo della chiamata
          type: "POST",
          // specifico la URL della risorsa da contattare
          url: "controller/pwdController.php",
          // passo dei dati alla risorsa remota
          data: {password:pwd, stato:"controlloPwd"},
          // definisco il formato  della risposta
          dataType: "JSON",
          // imposto un'azione per il caso di successo
          success: function(dati){
          //se il codice passato nella sql della pagina php ritorna true allora mostro i dati relativi all'utente associato al qr
          //formatto il contenuto con css e imposto gli effetti grafici di pagina in caso di successo 
          /*----FUNZIONE DEL BLOCCO TASTO DX   
                $(document).bind("contextmenu",function(e){
                	
                    $("#alert").css({"display": "block"}); 
                    $("#alert").text("l'utilizzo del tasto destro è disabilitato") //alert("timbratura sospesa :: "+datiTimbratore.dataOra+" :: effettuare nuovamente il Check-In");  
                    $("#alert").fadeOut(2500);
                    return false;
                });
-----------*/
             if(dati.statoAccount[0]=="sbloccato"){
             	alert("tutto ok");
                  /* -------- riconosce il rimpicciolimento della pagina ------- */
                    $( window ).resize(function() {    
                         sospensioneTimbratura();
                    });
                  /*-------------------------------------------------------------*/
                   $("#gruppoLogin").css({"display": "none"});
                    $("#container").css({"display": "none"});
                  
                    $("#container2").css({"display": "block"});
             }
             else
             {
             	$("#errore").text("errore password o postazione non attiva - riprovare, prego...");  	
             	
             }
            
          },
          // ed una per il caso di fallimento
          error: function()
          {
            alert("Errore #AJ02 chiamata");
          }
        });
    }   

           	/* da qui in poi*/
   function sospensioneTimbratura()
   {
      	var ct = $("#codiceTimbratore").text();
      	$('.attesa').show();
        $.ajax
        ({
          // definisco il tipo della chiamata
          type: "POST",
          // specifico la URL della risorsa da contattare
          url: "app/verifica/pwdController.php",
          // passo dei dati alla risorsa remota
          data: {codiceTimbratore:ct, stato:"sospTmb"},
          // definisco il formato  della risposta
          dataType: "JSON",
          // imposto un'azione per il caso di successo
          success: function(datiTimbratore){
            //se il codice passato nella sql della pagina php ritorna true allora mostro i dati relativi all'utente associato al qr
            //formatto il contenuto con css e imposto gli effetti grafici di pagina in caso di successo 
				//alert("bloccato1");
                if(datiTimbratore.stato == "bloccato")
                {
                    //alert("bloccato2");
                   //$("#container").css({"display": "none"}); 
                   $("#container").css({"display": "none"}); 
                   $("#alert").css({"display": "block"}); 
                   $("#alert").text("timbratura sospesa"); 
         		
               }

                setTimeout(location.reload.bind(location), 950);
               // location.reload();
          },
          // ed una per il caso di fallimento
          error: function()
          {
          
          }
        });
    }   
    </script>
<script type='text/javascript'>
//controllo se lo schermo è in modalità fullscreen e se si allora mostro la pagina del timbratore 
 var conta=0
 window.onload=function()
 { 
	if( typeof( window.outerHeight ) != 'number' ) 
		document.getElementById('avviso').innerHTML=
		'questa procedura non funziona sui browser che non supportano la proprietà outerHeight <br>(IE8 e precedenti)'
	else	
		if (window.opener==null || window.opener.myWin==null || window.opener.myWin.name != 'clessidraweb')
			document.getElementById('avviso').innerHTML='attivazione errata'
		else
			controlla();	
 }
 function controlla()
 {
	if (schermoMassimizzato(window)) 
	{
		document.getElementById('avviso').style.display='none'
		document.getElementById('container').style.display='block'
		document.body.style.cursor='default'
		document.f1.pwd.focus()
		var w=document.getElementById('versione')
		w.innerHTML='versione: '+versione+' - server: '+w.innerHTML
	} else
	{
		document.body.style.cursor='wait'
		conta++
		setTimeout('controlla()',500)
		document.getElementById('conta').innerHTML='( '+conta+' )'
	}
 }
 function testF11()
 {
	if (schermoMassimizzato(window)) return true
	
	alert ('metti il video in full screen digitando il tasto <F11>')
	return alert("false");
 }	
</script>

</body>
</html>






 


