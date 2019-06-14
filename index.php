<html>
<head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>

    <div id="container_domande">
      <?php
        require("connessione.php");

        $sql = "SELECT id, domanda FROM _webquiz";
        $ris = mysql_query($sql) or die("errore esecuzione query");

        while($row = mysql_fetch_array($ris))
        {
            echo "<a href=javascript:void(0); id=".$row["id"]." OnClick=\"leggiDom('".$row["id"]."')\">".$row["domanda"]."</a>
            <br>";
        }
      ?>
    </div>
    <div id="mostraRisposte">
  		 <input type="checkbox" name="r[]" id="r1" value=""><label id="lab_r1"></label> <br>
         <input type="checkbox" name="r[]" id="r2" value=""><label id="lab_r2"></label>  <br>
         <input type="checkbox" name="r[]" id="r3" value=""><label id="lab_r3"></label>  <br>
         <input type="checkbox" name="r[]" id="r4"  value=""><label id="lab_r4"></label>  <br>
           <input type="hidden" id="idDom" name="idDom" value="">
    </div>

    <script>
        function leggiDom(a)
        {
         //var  domCliccata = $(this).attr('id');
         alert(a);
		 $.ajax
         ({
            type: "POST",
            url: "quiz.php",
            data: {id_domanda: a},
            dataType: "JSON",
            success: function(dati)
            {

            	$("#lab_r1").text(dati.risposte[0]);
				$("#lab_r2").text(dati.risposte[1]);
  				$("#lab_r3").text(dati.risposte[2]);
				$("#lab_r4").text(dati.risposte[3]);

            	$("#idDom").val(dati.infoDom[0]);
                $("#r1").val(dati.risposte[0]);
                $("#r2").val(dati.risposte[1]);
                $("#r3").val(dati.risposte[2]);
                $("#r4").val(dati.risposte[3]);

                var rispDate = dati.rispDate[1].split(",");

                 //alert(rispDate);
                // (uno,due) (uno)
             /*
                if(dati.risposte[0].includes(rispDate[0]))
                {$("#r1").prop('checked', true);}else{$("#r1").prop('checked', false)};
           */



                //{}else{}



				/*mi permette di controllare i dati se devo checckare la checkbox
                	*/




                //var r1 = dati.risposte[0].split("_");
                //var r2 = dati.risposte[1].split("_");
                //var r3 = dati.risposte[2].split("_");
                //var r4 = dati.risposte[3].split("_");






         	//////////////////
				//alert(risp);  qui devi vedere di fare il
           		//alert(risp.includes("nessuna delle precedenti"));
			////////////////////
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

		//
      	//controllo se si verifica l'evento del click su una risposta (checkBox)
		$('input[type="checkbox"]').on("click", function(){

     if (this.checked) {

        		var output = jQuery.map($(':checkbox[name=r\\[\\]]:checked'), function (n, i) {
                          return n.value;
                      }).join(',');

				//alert(output);
                // effettua l'alert del id domanda solo se la checkbox è stata flaggata
                    //alert(domCliccata);
                    var idDom = $("#idDom").val();

                    //var myarr = output.split("_");

                    //alert("id_dom: "+myarr[0]+" rispo:"+ myarr[1]);
       				//
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


                    //
    		}
            else
            {
       				//
                   var output = jQuery.map($(':checkbox[name=r\\[\\]]:checked'), function (n, i) {
                          return n.value;
                      }).join(',');

                      var idDom = $("#idDom").val();
                    //var rispCancUtente = $(this).val();
					//var rispCancUtScomposta = rispCancUtente.split("_");

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


                            //

         			}


         ///
      });
    });
    </script>
</body>
</html>
