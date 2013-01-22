
<!-- Le barra gris -->
<div class="hero">
	<div class="container">
		<h1>Vota por propuestas, no por partidos.</h1>
		<p>Un voto informado es elegir a un candidato por las propuestas que ofrece, sin importar el partido político al que pertenezca. Decidamos bien y ejerzamos nuestro derecho.</p>
	</div>
</div>

<div class="container">
	
	<div class="span16">
		<div class="row">
			<div class="span12" id="pejelagarto">
				<div class="row elige">
					<div class="span12">
						<h2>¿Cómo participar?</h2>
						
						<ol class="desc_propuestas">
							<li>Vota por la propuesta, a favor o en contra. Conoce al candidato que hizo la propuesta.</li>
							<li>Entra a la liga de "Ver Más" o la del candidato para ver más información.</li>
							<li>Descubre en la gráfica de la derecha cuál es el candidato de tu preferencia.</li>
							<li>¡Vota informado!</li>
						</ol>

						<!-- <p class="desc_propuestas">Vota por la propuesta, a favor o en contra. Conoce al candidato que hizo la propuesta.</p>
						<p class="desc_propuestas">Entra a la liga de "ver detalle/comentar" o la del candidato para ver más información.</p>
						<p class="desc_propuestas">Descubre en la gráfica de la derecha cuál es el candidato de tu preferencia y... ¡Vota informado!</p> -->
							<!-- <p class="desc_propuestas">A continuación se muestran las propuestas más recientes, tú eliges si la propuesta te gusta o no.</p>
							<p class="desc_propuestas">Después de votar se muestra el candidato de la propuesta y podrás ver más detalles.</p> -->
					</div> <!-- /div.span12 -->
				</div> <!-- /div.row.elige -->
				
				<div class="row mt">
					<div class="span12">
						<form id="formFiltroCategorias" method="POST" action="<?php echo base_url(); ?>" >
							<span id="filtrar-por">Filtrar por categoría: </span>
							<select name="categoria" class="span3" onchange="document.getElementById('formFiltroCategorias').submit();">
								<option value="0" <?php if($queryOrder['categoria'] == 0){ echo "selected"; }?>>Todas</option>
								<?php foreach($queryCategorias->result() as $row){
									if($row->idCategoria == $queryOrder['categoria']){
										echo '<option value="'.$row->idCategoria.'" selected>'.$row->nombreCategoria.'</option>';
									} else{
										echo '<option value="'.$row->idCategoria.'">'.$row->nombreCategoria.'</option>';
									}
								}?>
							</select>
						</form>
					</div>
				</div>

				<div class="row propaside">
					<div class="span12 propuestas">	
						<?php if ($queryPropuestas->num_rows() > 0) : ?>
							<?php $primero = true ?>
							<?php foreach($queryPropuestas->result() as $row): ?>
								<div class="row propuesta" rel="<?php $row->idPropuesta?>" <?php if ($primero): ?> popover="popover" data-content="Elige si la propuesta te gusta o no, al votar se mostrará a qué candidato pertenece." data-original-title="Tú tienes la decisión" data-placement="right" <?php  $primero=false; endif ?> >
									<article class="span8">
										<h3><?php echo $row->titulo; ?><small><br><?php echo $arrCategorias[$row->idCategoria]; ?></small></h3>
										<p><?php echo $row->descripcion; ?></p>
									</article>
									<div class="span voteside">
										<!-- Les iconos de votación -->
										<div class="vota">
											<!-- Le voto a favor -->
											<a href="#" class="btn voto_favor" rel="<?php echo $arrPartidos[$arrRepresenta[$row->idCandidato]]; ?>" propuesta="<?php echo $row->idPropuesta ?>" candidato="<?php echo $arrCandidatos[$row->idCandidato]?>" candidatoID="<?php echo $row->idCandidato?>" votos="<?php echo $row->votoPositivo; ?>"><i class="icon-ok"></i></a>
											<!-- Le voto en contra -->
											<a href="#" class="btn voto_contra" propuesta="<?php echo $row->idPropuesta ?>" votos="<?php echo $row->votoNegativo; ?>"><i class="icon-remove"></i></a>
										</div>
										<!-- Si no ha votado se muestra escondida esta clase -->
										<div class="candidato hidden">
											<a href="<?php echo base_url(); ?>candidato/index/<?php echo $row->idCandidato?>" title="Ver candidato"><?php echo $arrCandidatos[$row->idCandidato];?></a>
											<br>
											<!-- URL para ver detalles de propuesta -->
											<a href="<?php echo base_url(); ?>propuesta/ver/<?php echo $row->idPropuesta?>" title="">Ver Más</a>
										</div>
									</div><!-- /voteside -->
								</div><!-- /row propuesta -->
							<?php endforeach; ?>
						<?php endif; ?>
												
						<!-- Les botones de prev y next -->
						<div class="pagination">
					  		<ul>
							<!-- <li class="<?php echo ($queryOffset-1 <= 0) ? 'prev disabled' : 'prev' ?>"><a href="<?php echo ($queryOffset-1 <= 0) ? '#' : base_url().'main/index/'.($queryOffset-1) ?>">&larr; Anterior</a></li> -->
							<?php if ($queryOffset < $max): ?>
								<li class="<?php echo ($queryOffset+1 > $max) ? 'next disabled' : 'next' ?>"><a href="<?php echo ($queryOffset+1 > $max) ? '#' : base_url().'main/index/'.($queryOffset+1).'/'.$queryOrder['categoria'] ?>" class="next ver_mas">Más Propuestas</a></li>
							<?php endif ?>
						  	</ul>
						</div>
					</div> <!-- /span12 propuestas -->	
				</div> <!-- /propaside -->	
			</div><!--/.span12-->
			<!-- Le Social Aside -->
			<aside class="span4 sbar">
					<div id="scroller-anchor"></div>
					<div class="redes-sociales-container">
						<!-- <h3>Redes Sociales</h3> -->
						<!--FB likes for facebook.com/votainformado-->
						<div id="fb-root"></div>
						<script src='http://connect.facebook.net/en_US/all.js'></script>
						<div class="fb-like" data-href="https://www.facebook.com/votainformado" data-send="false" data-width="80" data-show-faces="true"></div>
						<hr />
						<!-- Twitter follow button-->
						<a href="https://twitter.com/votainformado" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir @votainformado</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://votainformado.mx" data-text="Vota por propuestas, no por partidos." data-via="votainformado" data-lang="es" data-related="votainformado" data-hashtags="elecciones2012">Twittear</a>
					</div>
					<div class="mis_resultados hidden">
						<hr />
						<h3>Mis Resultados</h3>
						<div id="chart_div"></div>
					</div>
					<hr />
					<a href="#" title="" class="backToTop hidden">Subir</a>
			</aside>
		</div><!-- /.row -->
	</div><!--/.span16 -->