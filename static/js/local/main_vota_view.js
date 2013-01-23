// Facebook
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=165842966771875";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
// Twitter
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
$(window).load(function(){

	var mostrar_back_to_top = true;
	$(function() {
	  var a = function() {
	    var b = $(window).scrollTop();
	    //var d = $("#scroller-anchor").offset().top;
	    var d = 208;
	    if (b>d) {
			// Lo pone fijo
			var position = $("#pejelagarto").position();
			$("aside").css({position:"fixed",left: (position.left + 720)+"px",top: "70px"});
			// Muestra boton de back to top
			if (mostrar_back_to_top) {
				mostrar_back_to_top = false;
				$('a.backToTop').removeClass('hidden');
			}
	    } else {
	      if (b<=d) {
			// lo acomoda original
			$("aside").css({position:"relative",left: "",top: ""});
			if (!mostrar_back_to_top) {
				mostrar_back_to_top = true;
				$('a.backToTop').addClass('hidden');
			}
	      }
	    }
	  };
	  $(window).scroll(a);a()
	});
});

jQuery(document).ready(function($) {
	// Primero se hace chequeo para borrar localStorage
	checkLastVisit();

	var votos_favor;
	if (localStorage.getItem('votos')) {
		// Obtener json y hacer un push del ultimo dato
		var votos = JSON.parse(localStorage.getItem('votos'));
		votos_favor = votos.length;
	} else {
		votos_favor = 0;
	}

	// Onclick Voto a favor
	$('.voto_favor').live('click',function (event){
		event.preventDefault();
		// Incrementa votos a favor
		votos_favor++;

		// Hacer todo en caso de que no este desactivado
		if(!$(this).hasClass('disabled')){

			var propuesta = $(this).attr('propuesta');

			$.ajax({
			   	type: "POST",
			   	url: base_url+"main/voto_favor",
			  	data: { idPropuesta: propuesta},
				success: function(data){
					if(data == "ok"){
						// Set Local Storage
						if(localStorage){
							// Set idPropuesta en 1 = favor
							actualizar_local_storage(propuesta, 1);
						}
					} else {

					}
				},
				error: function(data){
					alert('Por favor intente nuevamente.');
					return;
				}
			});

			muestra_propuesta_favor($(this));
			// Obtiene id de candidato
			nombreCandidato = $(this).attr('candidato');
			idCandidato 	= $(this).attr('candidatoID');
			incremento_local_storage_candidatos(idCandidato, nombreCandidato);

			// Muestro a pie chart of my favourite bars
			checkStorageCandidato();
		}
	});

	// Onclick Voto en contra
	$('.voto_contra').live('click',function (event){
		event.preventDefault();
		// Hacer todo en caso de que no este desactivado
		if(!$(this).hasClass('disabled')){
			var propuesta = $(this).attr('propuesta');

			$.ajax({
			   	type: "POST",
			   	url: base_url+"main/voto_contra",
			  	data: { idPropuesta: propuesta},
				success: function(data){
					if(data == "ok"){
						// Set Local Storage
						actualizar_local_storage(propuesta, 0);
					} else {

					}
				},
				error: function(data){
					alert('Error');
					return;
				}
			});

			muestra_propuesta_contra($(this));
		}
	});

	function muestra_propuesta_contra(obj){
		// Desactiva ambos botones
		obj.addClass('disabled');
		obj.prev().addClass('disabled');
		// Agrega clase de voto negativo
		obj.closest('.propuesta').addClass('null');
		// Pone como chido el boton clickeado
		obj.addClass('danger');
		// Muestra Candidato
		obj.parent().siblings('.candidato').removeClass('hidden').hide().fadeIn('slow');
		// Muestra votos
		cambia_botones_a_votos(obj,'contra');
	}

	function muestra_propuesta_favor(obj){
		// Cambia de color todo el renglon usando el atributo rel
		obj.closest('.propuesta').addClass(obj.attr('rel'));
		// Desactiva ambos botones
		obj.addClass('disabled');
		obj.next().addClass('disabled');
		// Pone como voto a favor el boton clickeado
		obj.addClass('success');
		// Muestra Candidato
		obj.parent().siblings('.candidato').removeClass('hidden').hide().fadeIn('slow');
		// Muestra votos
		cambia_botones_a_votos(obj,'favor');
	}

	function cambia_botones_a_votos(obj,tipo_voto){
		if(tipo_voto == 'favor') {
			// obj es .voto_favor
			obj.html(obj.attr('votos'));
			obj.next().html(obj.next().attr('votos'));
		} else {
			// obj es .voto_contra
			obj.html(obj.attr('votos'));
			obj.prev().html(obj.prev().attr('votos'));
		}
	}

	// Back To Top
	$('a.backToTop').click(function(event){
		event.preventDefault();
		$('html, body').animate({scrollTop: '0px'}, 300);
	});

	// Infinite scroll
	//var max 	 = <?php echo $max; ?>; defined in main
	var last	 = 0; // Si ya mostro mensaje de que no hay mas propuestas
	var pageMax  = 1;

	jQuery.ias({
		container : "div.propuestas",
		item: "div.propuesta",
		pagination: ".pagination",
		next: "a.next",
		loader: "static/img/loading.gif",
		onPageChange: function(pageNum, pageUrl, scrollOffset) {
			if(pageNum == max && last < 1) {
				last++;
				$('.propaside').append('<div class="row span9">Por el momento no contamos con más propuestas, pero puedes <a href="'+base_url+'propuesta/agrega" title="Agregar">agregar una.</a></div>');
			}
			// Checa localStorage
			//if(pageNum > pageMax) {
			//	checkStorage();
			//	pageMax = pageNum;
			//}
		},
			onRenderComplete: function(items) {
			checkStorage();
		}
	});

	/****************************************************
	 *													*
	 *					Local Storage					*
	 *													*
	 ***************************************************/

	// Checa localStorage, aplica los que ya fueron votados
	function checkStorage(offset){
		if(!localStorage)
			return;

		// Checar si es valor opcional
		offset = (typeof offset == "undefined") ? -1 : offset;

		// Si existe localStorage de votos
		if(localStorage.getItem('votos')){
			var votos = JSON.parse(localStorage.getItem('votos'));

			for(i=0;i<votos.length;i++){
				// Obtener selector con el id de la propuesta con atributo propuesta
				var renglon = $('.voto_contra[propuesta="'+ votos[i].id +'"]');
				if(votos[i].opcion == 1){
					muestra_propuesta_favor(renglon.prev());
				} else {
					muestra_propuesta_contra(renglon);
				}
			}
		}
	}

	// Actualiza el localStorage, recibe el id de la propuesta y la opcion
	// 0 es en contra y 1 es a favor
	function actualizar_local_storage(idPropuesta, opcion){
		// Checa que se soporte localStorage
		if(localStorage) {
			// Checar si ya existe un json de votos
			if (localStorage.getItem('votos')) {
				// Obtener json y hacer un push del ultimo dato
				var votos = JSON.parse(localStorage.getItem('votos'));
				votos.push({'id':parseInt(idPropuesta), 'opcion' : opcion});

				localStorage.setItem('votos', JSON.stringify(votos));
			} else {
				// Crear nuevo json con el valor
				var votos = [];
				votos[0] = {'id':parseInt(idPropuesta), 'opcion' : opcion};
				localStorage.setItem('votos', JSON.stringify(votos));
				//console.log( JSON.parse( localStorage.getItem( 'votos' ) ) );
			}
		}
	}

	// Borra todo el localStorage
	function clear_local_storage(){
		localStorage.removeItem("votos");
		localStorage.removeItem("candidatos");
	}

	// Checa si ya se ha votado
	function checkStorageCandidato(){
		if(!localStorage)
			return;

		if(localStorage.getItem('candidatos')){
			if(votos_favor > 4){
				$('.mis_resultados').removeClass('hidden');
				drawChart();
			}
		}

	}

	// Checa si se debe de borrar el localStorage, usado en caso de que se
	// necesite borrar el localStorage por que hubieron cambios
	function checkLastVisit(){
		if (localStorage) {
			if (localStorage.getItem('vota_ultima_visita')) {
				var ultima_visita = localStorage.getItem('vota_ultima_visita');
				if (ultima_visita < cache_version){
					clear_local_storage();
				}
			} else{
				clear_local_storage();
			}
			// Crear/actualizar localstorage de ultima visita
			localStorage.setItem('vota_ultima_visita', current_time);
		}
	}

	// localStorage de candidatos
	function incremento_local_storage_candidatos(idCandidato,nombreCandidato){
		// Checa que se soporte localStorage
		if(localStorage) {
			// Checar si ya existe un json de candidatos
			if (localStorage.getItem('candidatos')) {

				// Obtener json y hacer un push del ultimo dato
				var candidatos = JSON.parse(localStorage.getItem('candidatos'));

				existe = false; // Bool para checar si ya esta agregado ese candidato
				// Buscar si existe, si existe lo agrega
				for(i=0;i<candidatos.length;i++){
					if(candidatos[i].id == idCandidato){
						candidatos[i].votos += 1;
						existe = true;
					}
				}

				// Si no existe ese candidato en localStorage lo crea con 1 voto
				if (existe == false) {
					candidatos.push({'id':parseInt(idCandidato), 'nombre' : nombreCandidato, 'votos' : 1});
				}

				localStorage.setItem('candidatos', JSON.stringify(candidatos));
			} else {
				// Crear nuevo json con un voto y lo agrega a localStorage
				var candidatos = [];
				candidatos[0] = {'id':parseInt(idCandidato), 'nombre' : nombreCandidato, 'votos' : 1};
				localStorage.setItem('candidatos', JSON.stringify(candidatos));
				//console.log( JSON.parse( localStorage.getItem( 'votos' ) ) );
			}
		}
	}

	// Primer chequeo de localStorage
	checkStorage();
	checkStorageCandidato();

	// Info popover
    $(function () {
      $("div[popover=popover]")
        .popover({
          offset: 10
        })
    })

});

/****************************************************
 *													*
 *			A Pie Chart	of my favourite bars		*
 *													*
 ***************************************************/

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Candidato');
	data.addColumn('number', 'Votos');
	if (localStorage.getItem('candidatos')) {
		var candidatos = JSON.parse(localStorage.getItem('candidatos'));
		candidatos.sort(function(a,b){return a.id - b.id});
		//console.log(candidatos);
		var j=0;
		var i=0;
		//for(i=1;i<=5;i++){
		for(i=1;i<=4;i++){
			//console.log("i: "+i);
			//console.log("j: "+j);
			if(candidatos[j].id == i){
				data.addRow([candidatos[j].nombre, candidatos[j].votos]);
				if(j < candidatos.length - 1){
					j++;
				}
			} else {
				data.addRow(['Test',0]);
			}
		}

	}

	var options = {
		width: 220, height: 200,
		chartArea: {left:10,top:20,width:'80%',height:'80%'},
		legend:{position:"none"},
		// jvm pena peje quadri
		colors:['#3196eb','#f3443e','#f6d358','#009ea1']
		// jvm pena peje cordero creel
		//colors:['#3196eb','#f3443e','#f6d358','#3981d3','#0c4a92']
	};

	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}
