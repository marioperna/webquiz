<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <style>
  	#container
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
<div id="container">
	<div id="infoAzienda"></div>
    <div id="infoTest"></div>
  <div id="container_domande">
    <?php
    require("connessione.php");

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

  <script>
  
  $("#r1").hide();
  $("#commento").hide();
  $("#r2").hide();
  $("#r3").hide();
  $("#r4").hide();
  $("#domAperta").hide();
  $("#commento").hide();
  
  function inserisciCommento()
  {
  	       
       var idDomanda = $('#idDom').val();
//inizio chimaata ajax
       var commento = $('#commento').val();    
        $.ajax({
          type: "POST",
          url: "risposte.php",
          data: {id_domanda: idDomanda, commento:commento},
          dataType: "JSON",
          success: function(esito)
          {
				//$("#c").css('border-color', '#green');
          },
          error: function()
          {
            
          }
        });
        //fine chiamata ajax
       
  }
  function leggiDom(a)
  {
    $.ajax
    ({
      type: "POST",
      url: "quiz.php",
      data: {id_domanda: a},
      dataType: "JSON",
      success: function(dati)
      {
      $("#idDom").val(dati.infoDom[0]);
      	if(dati.infoDom[2]=="a")
        {
        	//alert(dati.infoDom[2]);
           // alert(a);
        	$("#commento").val("");
            $("#domAperta").show();
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
            var rispDate = dati.rispDate[1].split(",");
        
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
        	if(dati.infoDom[1]){
        		$("#commento").val(dati.infoDom[1]);
        	}
        	else
        	{
        		$("#commento").val("");
        	}
       }
      },
      error: function()
      {
        alert("Chiamata fallita, si prega di riprovare...");
      }
    });
  }
  $(document).ready(function()
  {
    //$('a').on("click", function(){
    //controllo se si verifica l'evento del click su una risposta (checkBox)
    $('input[type="checkbox"]').on("click", function(){
      if (this.checked) {
        var output = jQuery.map($(':checkbox[name=r\\[\\]]:checked'), function (n, i) {
          return n.value;
        }).join(',');
        var idDom = $("#idDom").val();
        
        //alert(output);
        // effettua l'alert del id domanda solo se la checkbox è stata flaggata
        //alert(domCliccata);
        //var myarr = output.split("_");
        //alert("id_dom: "+myarr[0]+" rispo:"+ myarr[1]);
        //inizio chimaata ajax
        $.ajax({
          type: "POST",
          url: "risposte.php",
          data: {id_domanda: idDom, prova:output },
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
        //var rispCancUtente = $(this).val();
        //var rispCancUtScomposta = rispCancUtente.split("_");
        //inizio chiamata ajax
        $.ajax({
          type: "POST",
          url: "risposte.php",
          data: {id_domanda: idDom, prova:output},
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
    });
  });
  </script>
</body>
</html>
