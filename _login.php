<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>_webquiz Ajax</title>

<link rel="stylesheet" href="_stile.css" type="text/css">
<script type="text/javascript" src="_codice.js?1.18.7"></script>
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

#pannel
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

<div id="pannel">
<div id="infoAzienda"></div>
<div class="countdown"></div>
<span id="time"></span> 
<div id="infoTest"></div>
<div id="container_domande">

</div>
<div id="mostraRisposte">
<input type="checkbox" name="r[]" id="r1" value=""><label id="lab_r1"></label> <br>
<input type="checkbox" name="r[]" id="r2" value=""><label id="lab_r2"></label>  <br>
<input type="checkbox" name="r[]" id="r3" value=""><label id="lab_r3"></label>  <br>
<input type="checkbox" name="r[]" id="r4"  value=""><label id="lab_r4"></label>  <br>
<input type="hidden" id="idDom" name="idDom" value="">
<input type="hidden" id="idCat" name="idCat" value="">
<input type="hidden" id="idUtente" name="idUtente" value="">
<input type="hidden" id="tipoDom" name="tipoDom" value="">

<div id="areaScrivibile"> 
<textarea rows="4" cols="50" id="commento" onfocusout="inserisciCommento()"></textarea>

<textarea rows="4" cols="50" id="domAperta" onfocusout="inserisciCommento()"></textarea> 
<span id="statoScrittura"></span>
</div>
</div>
</div>

<script type="text/javascript">
function logout()
{
   var idUtente = getCookie("userId");
   $('.attesa').show();
$.ajax
({
// definisco il tipo della chiamata
type: "POST",
// specifico la URL della risorsa da contattare
url: "controller/pwdController.php",
// passo dei dati alla risorsa remota
data: {id_utente:idUtente, stato:"provaTerminata"},
// definisco il formato  della risposta
dataType: "JSON",
// imposto un'azione per il caso di successo
success: function(dati){
//se il codice passato nella sql della pagina php ritorna true allora mostro i dati relativi all'utente associato al qr
//formatto il contenuto con css e imposto gli effetti grafici di pagina in caso di successo 

    location.reload();

//
},
// ed una per il caso di fallimento
error: function()
{

}
});

}
function setCookie(cname, cvalue) {
 	document.cookie = cname + "=" + cvalue + ";path=/";
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}






$("#r1").hide();
$("#commento").hide();

$("#r2").hide();
$("#r3").hide();
$("#r4").hide();
$("#domAperta").hide();
$("#commento").hide();
function contaTest(a)
{
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
            logout();
        }
    }, 1000);
}

jQuery(function ($) {
    var fiveMinutes = 60 * a,
        display = $('#time');
    startTimer(fiveMinutes, display);
});
}


function inserisciCommento()
{

	var tipoDom = $("#tipoDom").val();
    var idDom = $("#idDom").val();
    var idCat = $("#idCat").val();
    var idUtente = getCookie("userId");
	var commento = $('#commento').val();  
    var domAperta = $('#domAperta').val();  
        
if(tipoDom =="a")
{
            $.ajax({
            type: "POST",
            url: "risposte.php",
            data: {id_utente: idUtente, id_domanda: idDom, id_categoria: idCat, commento:domAperta, cmd:"ida"},
            dataType: "JSON",
            success: function(esito)
            {
            		$("#statoScrittura").text("Salvataggio dati: OK");
                    
                   
            },
            error: function()
            {

            }
          });
          //fine chiamata ajax  
          
}
else
{
            $.ajax({
            type: "POST",
            url: "risposte.php",
            data: {id_utente: idUtente, id_domanda: idDom, id_categoria: idCat, commento:commento, cmd:"commento"},
            dataType: "JSON",
            success: function(esito)
            {
            		$("#statoScrittura").text("Salvataggio dati: OK");
                    
                   
            },
            error: function()
            {

            }
          });
          //fine chiamata ajax  
}


}
function leggiDom(a,b)
{
   
           var idUtente = getCookie("userId");

$.ajax
({
type: "POST",
url: "quiz.php",
data: {id_domanda: a, id_categoria: b, id_utente: idUtente},
dataType: "JSON",
success: function(dati)
{
	
	$("#idDom").val(dati.infoDom[0]);
    $("#tipoDom").val(dati.infoDom[2]);
	$("#idCat").val(dati.infoDom[1]);
    $("#idUtente").val(dati.infoAccount[0]);
	$("#statoScrittura").text("");
if(dati.infoDom[2]=="a")
{
//alert(dati.infoDom[2]);
// alert(a);
$("#commento").val("");
$("#domAperta").show();
$("#domAperta").val(dati.rispDate[1]);
$("#r1").css("display","none");
$("#r2").css("display","none");
$("#r3").css("display","none");
$("#r4").css("display","none");
$("#commento").css("display","none");
$("#lab_r1").css("display","none");
$("#lab_r2").css("display","none");
$("#lab_r3").css("display","none");
$("#lab_r4").css("display","none");
}
if(dati.infoDom[2]=="sm")
{
$("#commento").val("");
$("#domAperta").css("display","none");
$("#r1").show();
$("#r2").show();
$("#r3").show();
$("#r4").show();
$("#commento").show();
$("#lab_r1").css("display","inline");
$("#lab_r2").css("display","inline");
$("#lab_r3").css("display","inline");
$("#lab_r4").css("display","inline");
//carica le label
$("#lab_r1").text(dati.risposte[0]);
$("#lab_r2").text(dati.risposte[1]);
$("#lab_r3").text(dati.risposte[2]);
$("#lab_r4").text(dati.risposte[3]);
//alert(dati.infoDom[1]);
//carica i valori contenuti nelle checkboxes

//$("#tipoDom").val(dati.infoDom[2]);

$("#r1").val(dati.risposte[0]);
$("#r2").val(dati.risposte[1]);
$("#r3").val(dati.risposte[2]);
$("#r4").val(dati.risposte[3]);

//splitta l'array e prende le risposte 
var rispDate = dati.rispDate[0].split(",");

//imposto tutte le checkbox che al cambio di domanda come non selezionate, poi il controllo 
//qui sotto effettuerà la verifica delle risposte date da utente
$("#r1").prop('checked', false);
$("#r2").prop('checked', false);
$("#r3").prop('checked', false);
$("#r4").prop('checked', false);

//inizio controllo se confermata la risposta 1
if(dati.risposte[0]== rispDate[0])
{$("#r1").prop('checked', true);}

if(dati.risposte[1] == rispDate[0])
{$("#r2").prop('checked', true);}

if(dati.risposte[2]== rispDate[0])
{$("#r3").prop('checked', true);}

if(dati.risposte[3]== rispDate[0])
{$("#r4").prop('checked', true);}
//fine controllo se selezionata la risposta 1

//inizio controllo se confermata la risposta 2
if(dati.risposte[0]== rispDate[1])
{$("#r1").prop('checked', true);}

if(dati.risposte[1] == rispDate[1])
{$("#r2").prop('checked', true);}

if(dati.risposte[2]== rispDate[1])
{$("#r3").prop('checked', true);}

if(dati.risposte[3]== rispDate[1])
{$("#r4").prop('checked', true);}
//fine controllo se selezionata la risposta 2

//inizio controllo se confermata la risposta 3
if(dati.risposte[0]== rispDate[2])
{$("#r1").prop('checked', true);}

if(dati.risposte[1] == rispDate[2])
{$("#r2").prop('checked', true);}

if(dati.risposte[2]== rispDate[2])
{$("#r3").prop('checked', true);}

if(dati.risposte[3]== rispDate[2])
{$("#r4").prop('checked', true);}
//fine controllo se selezionata la risposta 3

//inizio controllo se confermata la risposta 4
if(dati.risposte[0]== rispDate[3])
{$("#r1").prop('checked', true);}

if(dati.risposte[1] == rispDate[3])
{$("#r2").prop('checked', true);}

if(dati.risposte[2]== rispDate[3])
{$("#r3").prop('checked', true);}

if(dati.risposte[3]== rispDate[3])
{$("#r4").prop('checked', true);}
//fine controllo se selezionata la risposta 4
//alert(dati.infoDom[1]);
if(dati.rispDate[1])
{
	$("#commento").val(dati.rispDate[1]);
}
else
{
$("#commento").val("");
}

}
},
error: function()
{
alert("Chiamatadas fallita, si prega di riprovare...");
}
});
}







/* da qui in poi*/
$("#pannel").css({"display": "none"});
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
 //$("#idUtente").val(dati.utente[0]);


if(dati.statoAccount[0]=="sbloccato"){
	 setCookie("userId", dati.utente[0]);
      //inizio chimaata ajax
      $.ajax({
          type: "POST",
          url: "getDomande.php",
          data: {id_utente: dati.utente[0], testAssegnato: dati.utente[1] },
          dataType: "JSON",
          success: function(datiDom)
          {
          	for(var i=0; i<datiDom.length;i++)
            {
            	$("#container_domande").append("<a href=javascript:void(0); id="+datiDom[i][0]+" class='domanda' OnClick='leggiDom("+datiDom[i][0]+","+datiDom[i][1]+")'>"+datiDom[i][2]+"</a><br><br><br><hr>");
            }
          	
          },
          error: function()
          {
          alert("Chiamata fallita, 2wsi prega di riprovare...");
          }
      });
      //fine chiamata ajax
        /* -------- riconosce il rimpicciolimento della pagina ------- */
        $( window ).resize(function() {    
        sospendiTest();
        });
        /*------------ - - - - - - - - - - - - - - - - ---------------------------------*/
        $("#gruppoLogin").css({"display": "none"});
        $("#container").css({"display": "none"});
        $("#pannel").css({"display": "block"});
        $("#infoAzienda").html("Connesso come: <b>"+dati.utente[2]+" "+dati.utente[3]+"</b>");
        $("#infoTest").html("Argomento Prova <b>["+dati.test[0]+"]</b>");
        $("#infoTest").append("<input type='button' value='Termina Prova' onclick='logout()'>");
       	//alert(dati.test[1]);
       //$("#time").html(dati.test[1]);
			contaTest(dati.test[1]);

        /*----FUNZIONE DEL BLOCCO TASTO DX  ----*/
          $(document).bind("contextmenu",function(e){
          $("#alert").css({"display": "block"}); 
          $("#alert").text("l'utilizzo del tasto destro è disabilitato") //alert("timbratura sospesa :: "+datiTimbratore.dataOra+" :: effettuare nuovamente il Check-In");  
          $("#alert").fadeOut(2500);
          return false;
          });

}
else
{
	
$("#errore").html("errore password o postazione non attiva - riprovare, prego...");  	

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
function sospendiTest()
{
   var idUtente = getCookie("userId");
   $('.attesa').show();
$.ajax
({
// definisco il tipo della chiamata
type: "POST",
// specifico la URL della risorsa da contattare
url: "controller/pwdController.php",
// passo dei dati alla risorsa remota
data: {id_utente:idUtente, stato:"sospTest"},
// definisco il formato  della risposta
dataType: "JSON",
// imposto un'azione per il caso di successo
success: function(dati){
//se il codice passato nella sql della pagina php ritorna true allora mostro i dati relativi all'utente associato al qr
//formatto il contenuto con css e imposto gli effetti grafici di pagina in caso di successo 
if(dati.statoAccount[0] == "bloccato")
{
	$("#pannel").css({"display": "none"}); 
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


$(document).ready(function()
{
//$('a').on("click", function(){
//controllo se si verifica l'evento del click su una risposta (checkBox)
$('input[type="checkbox"]').on("click", function(){
if (this.checked) 
{
      var output = jQuery.map($(':checkbox[name=r\\[\\]]:checked'), function (n, i) {
      return n.value;
      }).join(',');

      var idDom = $("#idDom").val();
      var idCat = $("#idCat").val();
      var idUtente = getCookie("userId");
      //alert(output);
      // effettua l'alert del id domanda solo se la checkbox è stata flaggata
      //alert(domCliccata);
      //var myarr = output.split("_");
      //alert("id_dom: "+myarr[0]+" rispo:"+ myarr[1]);
      //inizio chimaata ajax
      $.ajax({
          type: "POST",
          url: "risposte.php",
          data: {id_utente:idUtente, id_domanda: idDom, prova:output, id_categoria:idCat },
          dataType: "JSON",
          success: function(esito)
          {
          //alert("operazione eseguita con successo");
          },
          error: function()
          {
          alert("Chiamata fallita, si prega di riprovare...");
          }
      });
      //fine chiamata ajax
}
else
{
var output = jQuery.map($(':checkbox[name=r\\[\\]]:checked'), function (n, i) {
return n.value;
}).join(',');
var idDom = $("#idDom").val();
var idCat = $("#idCat").val();
      var idUtente = getCookie("userId");
	var risposteUtente= output.split(",");
    
    if(risposteUtente=="")
    {
      //inizio chiamata ajax
      $.ajax({
      type: "POST",
      url: "risposte.php",
      data: {id_utente:idUtente, id_domanda: idDom, prova:output, id_categoria:idCat, cmd:"cancellaRisposta"},
      dataType: "JSON",
      success: function(esito)
      {

      //alert("operazione eseguita con successo");

      },
      error: function()
      {
      alert("Chiamata fallita, si prega di riprovare...");
      }
      });
      //fine chiamata ajax    
      }
    else
    {
      //inizio chiamata ajax
      $.ajax({
      type: "POST",
      url: "risposte.php",
      data: {id_utente:idUtente, id_domanda: idDom, prova:output, id_categoria:idCat},
      dataType: "JSON",
      success: function(esito)
      {

      //alert("operazione eseguita con successo");

      },
      error: function()
      {
      alert("Chiamata fallita, si prega di riprovare...");
      }
      });
      //fine chiamata ajax
    }
//var rispCancUtente = $(this).val();
//var rispCancUtScomposta = rispCancUtente.split("_");

}
});
});







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
if (window.opener==null || window.opener.myWin==null || window.opener.myWin.name != 'webquiz')
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