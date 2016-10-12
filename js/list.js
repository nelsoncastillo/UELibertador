    /*Selecciona la fila y se cambia el estilo cuando le das click con el ratón*/
    function myFunction(x)
    {
    if (document.getElementsByClassName("trselected").length > 0) {
    	var element = document.getElementsByClassName("trselected");
    	if (parseInt(element[0].id)%2 != 0) element[0].className = "impar";
    	else element[0].className = "";
    }
    x.className="trselected";
    }
    /*Ejecuta una acción diferente según la tecla del teclado que presiones.
    el 40 es la flecha abajo, el 38 la flecha arriba y el 13 el enter. Mueve el estilo
    de la fila, arriba o abajo, según el botón pulsado. Con el botón enter se muestra
    la información de la fila seleccionada*/
    function myFunction2(evnt)
    {
    var ev = (evnt) ? evnt : event;
       var code=(ev.which) ? ev.which : event.keyCode;
       if (code == 40) {
    		if (document.getElementsByClassName("trselected").length > 0) {
    			var element = document.getElementsByClassName("trselected");
    			var num = (parseInt(element[0].id) + 1).toString();
    			myFunction(document.getElementById(num));
    		}
    		else myFunction(document.getElementById(1))
       }
       else if (code == 38) {
    		if (document.getElementsByClassName("trselected").length > 0) {
    			var element = document.getElementsByClassName("trselected");
    			var num = (parseInt(element[0].id) - 1).toString();
    			myFunction(document.getElementById(num))
    		}
    		else myFunction(document.getElementById(document.getElementById("tbody").rows.length.toString()))
        }
        else if (code == 13 ) {
            if (document.getElementsByClassName("trselected").length > 0) {
    	    var element = document.getElementsByClassName("trselected");
    	    var info = element[0].cells[0].innerText;
    	    info += " "+element[0].cells[1].innerText;
    	    info += " "+element[0].cells[2].innerText;
    	    info += " "+element[0].cells[3].innerText;
    	    info += " "+element[0].cells[4].innerText;
    	    alert(info);
    	}
     
    }
    }
    //Escucha y reacciona el evento cuando se pulsa una tecla
    if (window.document.addEventListener) {
       window.document.addEventListener("keydown", myFunction2, false);
    } else {
       window.document.attachEvent("onkeydown", myFunction2);
    }
