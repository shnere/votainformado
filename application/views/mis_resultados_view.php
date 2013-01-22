<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>

	jQuery(document).ready(function($) {
		$('.refresh').click(function(event){
			event.preventDefault();
			drawChart();
		});
	});
		
	google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Candidato');
		data.addColumn('number', 'Votos');
		if (localStorage.getItem('candidatos')) {
			var candidatos = JSON.parse(localStorage.getItem('candidatos'));
			candidatos.sort(function(a,b){return a.id - b.id});
			console.log(candidatos);
			for(i=0;i<candidatos.length;i++){
				//Fix para color correcto
				for(j=i;j<5;j++){
					if(candidatos[i].id == j+1){
						data.addRow([candidatos[i].nombre, candidatos[i].votos]);
						break;
					}else{
						data.addRow(['Test',0]);
					}
				}
			}	
		}

		var options = {
			width: 450, height: 300,
			title: 'Resultados',
			colors:['#3196eb','#f3443e','#f6d358','#3981d3','#0c4a92']
		};

		var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		chart.draw(data, options);
	}
</script>
<div class="container">
	<div id="chart_div"></div>
	<a href="<?php echo base_url(); ?>" title="" class="refresh">Refresh</a>