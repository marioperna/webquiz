var versione='v1.18.7 (risposte e controlli funzionanti)';
// controlla se lo schermo è stato messo in full screen con <F11>
function schermoMassimizzato(pWin)
{
	if( typeof( pWin.outerHeight ) == 'number' ) 
	{	return (pWin.screenX==0 && pWin.screenY==0 & 
				pWin.outerHeight==screen.height &&
				pWin.outerWidth==screen.width)
               
	} else  // IE8 e precedenti non supportano outerHeight e outerWidth
	{	return (pWin.screenLeft==0 && pWin.screenTop==0 & 
				Math.abs(document.documentElement.clientHeight-screen.height)<100 &&
				document.documentElement.clientWidth==screen.width)
                
	}
    
}

