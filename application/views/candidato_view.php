<script>
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
	
</script>
<div class="container">
		
	<div class="candidato_perfil mtop">
		<div class="candidato_imagen">
			<a href="http://es.wikipedia.org/wiki/<?php echo $candidato->wikipedia; ?>" title="<?php echo $candidato->nombre;?>" target="_blank">
			<img src="<?php echo base_url(); ?>static/img/candidatos/perfil/<?php echo $candidato->imagen; ?>" alt="" /><!-- <img class="thumbnail" src="http://placehold.it/480x300" alt=""> --></a>
		</div>
		<div class="candidato_info">
			<h1><?php echo $candidato->nombre;?></h1>
			<p><strong>Edad: </strong><?php echo $candidato->edad; ?></p>
			<p><strong>Estudió: </strong><?php echo $candidato->estudios; ?></p>
			<p><strong>Último cargo: </strong><?php echo $candidato->cargo_pasado; ?></p>
			<p><a href="<?php echo $candidato->pagWeb;?>" title="" target="_blank"><?php echo $candidato->pagWeb;?></a></p>
			
			<?php if(!(strcmp($candidato->twitter,'') == 0)): ?>
				<a href="http://twitter.com/<?php echo $candidato->twitter; ?>" title="<?php echo $candidato->twitter; ?>" target="_blank"><img class="thumbnail" src="<?php echo base_url(); ?>static/img/socialmedia/twitter.png" alt=""></a>
			<?php endif;?>
			<?php if(!(strcmp($candidato->facebook,'') == 0)): ?>
				<a href="http://facebook.com/<?php echo $candidato->facebook; ?>" title="<?php echo $candidato->facebook; ?>" target="_blank"><img class="thumbnail" src="<?php echo base_url(); ?>static/img/socialmedia/facebook.png" alt=""></a>
			<?php endif;?>
			<?php if(!(strcmp($candidato->youtube,'') == 0)): ?>
				<a href="http://youtube.com/<?php echo $candidato->youtube; ?>" title="<?php echo $candidato->youtube; ?>" target="_blank"><img class="thumbnail" src="<?php echo base_url(); ?>static/img/socialmedia/youtube.png" alt=""></a>
			<?php endif;?>
		</div>
	</div>
	
	<div class="row">
		<div class="span16 mtop">
			<div class="row">
				<div class="span12">
					<h2>Propuestas de <?php echo $candidato->nombre;?></h2>
					<ul class="tabs mtop" data-tabs="tabs">
					  <li class="active"><a href="#recientes">Recientes</a></li>
					  <li><a href="#populares">Populares</a></li>
					  <li><a href="#mejor">Mejor Puntuadas</a></li>
					  <li><a href="#peor">Peor Puntuadas</a></li>
					</ul>
					<div class="pill-content variedad-propuestas">
						<!-- Propuestas Recientes-->
						<div class="active" id="recientes">
							<?php if ($queryPropuestasRecientes->num_rows() > 0) : ?>
								<?php foreach($queryPropuestasRecientes->result() as $row): ?>
									<div class="row">
										<div class="span10">
											<h3 class="titulo-propuesta"><a href="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta; ?>" title="<?php echo $row->titulo; ?>"><?php echo $row->titulo; ?></a><small>&nbsp;<?php echo date(" d/m/Y", strtotime($row->fecha)); ?></small></h3>
											<div class="da_who">
												<span class="label success"><?php echo $row->votoPositivo; ?></span>&nbsp;
												<span class="label important"><?php echo $row->votoNegativo; ?></span>
												<span class="enviado-por">Enviada por <?php echo $arrPersonas[$row->idPersona] ?></span>
												</div>
											<p><?php echo $row->descripcion; ?></p>
										</div>
										<div class="span2">
											<a href="https://twitter.com/share" class="twitter-share-button" data-text="Checa esta propuesta de <?php echo $candidato->nombre; ?> que encontré en votainformado.mx" data-url="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta; ?>" data-via="votainformado" data-lang="es" data-related="votainformado">Twittear</a>
										</div>
									</div>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
						<!-- Propuestas Populares-->
						<div id="populares">
							<?php if ($queryPropuestasPopulares->num_rows() > 0) : ?>
								<?php foreach($queryPropuestasPopulares->result() as $row): ?>
									<div class="row">
										<div class="span10">
											<h3 class="titulo-propuesta"><a href="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta; ?>" title="<?php echo $row->titulo; ?>"><?php echo $row->titulo; ?></a><small>&nbsp;<?php echo date(" d/m/Y", strtotime($row->fecha)); ?></small></h3>
											<div class="da_who">
												<span class="label success"><?php echo $row->votoPositivo; ?></span>&nbsp;
												<span class="label important"><?php echo $row->votoNegativo; ?></span>
												<span class="enviado-por">Enviada por <?php echo $arrPersonas[$row->idPersona] ?></span>
												</div>
											<p><?php echo $row->descripcion; ?></p>
										</div>
										<div class="span2">
											<a href="https://twitter.com/share" class="twitter-share-button" data-text="Checa esta propuesta de <?php echo $candidato->nombre; ?> que encontré en votainformado.mx" data-url="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta; ?>" data-via="votainformado" data-lang="es" data-related="votainformado">Twittear</a>
										</div>
									</div>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
						<!-- Propuestas Mejores-->
						<div id="mejor">
							<?php if ($queryPropuestasMejores->num_rows() > 0) : ?>
								<?php foreach($queryPropuestasMejores->result() as $row): ?>
									<div class="row">
										<div class="span10">
											<h3 class="titulo-propuesta"><a href="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta; ?>" title="<?php echo $row->titulo; ?>"><?php echo $row->titulo; ?></a><small>&nbsp;<?php echo date(" d/m/Y", strtotime($row->fecha)); ?></small></h3>
											<div class="da_who">
												<span class="label success"><?php echo $row->votoPositivo; ?></span>&nbsp;
												<span class="label important"><?php echo $row->votoNegativo; ?></span>
												<span class="enviado-por">Enviada por <?php echo $arrPersonas[$row->idPersona] ?></span>
												</div>
											<p><?php echo $row->descripcion; ?></p>
										</div>
										<div class="span2">
											<a href="https://twitter.com/share" class="twitter-share-button" data-text="Checa esta propuesta de <?php echo $candidato->nombre; ?> que encontré en votainformado.mx" data-url="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta; ?>" data-via="votainformado" data-lang="es" data-related="votainformado">Twittear</a>
										</div>
									</div>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
						<!-- Propuestas Peores-->
						<div id="peor">
							<?php if ($queryPropuestasPeores->num_rows() > 0) : ?>
								<?php foreach($queryPropuestasPeores->result() as $row): ?>
									<div class="row">
										<div class="span10">
											<h3 class="titulo-propuesta"><a href="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta; ?>" title="<?php echo $row->titulo; ?>"><?php echo $row->titulo; ?></a><small>&nbsp;<?php echo date(" d/m/Y", strtotime($row->fecha)); ?></small></h3>
											<div class="da_who">
												<span class="label success"><?php echo $row->votoPositivo; ?></span>&nbsp;
												<span class="label important"><?php echo $row->votoNegativo; ?></span>
												<span class="enviado-por">Enviada por <?php echo $arrPersonas[$row->idPersona] ?></span>
												</div>
											<p><?php echo $row->descripcion; ?></p>
										</div>
										<div class="span2">
											<a href="https://twitter.com/share" class="twitter-share-button" data-text="Checa esta propuesta de <?php echo $candidato->nombre; ?> que encontré en votainformado.mx" data-url="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta; ?>" data-via="votainformado" data-lang="es" data-related="votainformado">Twittear</a>
										</div>
									</div>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
					</div>
				</div>
				<!-- Sidebar -->
				<div class="span4">
					
				</div>
			</div>
		</div>
	</div>