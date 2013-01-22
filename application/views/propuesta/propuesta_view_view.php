<script>
	
	var addthis_config = {
	     ui_language: "es"
	}
	$(document).ready(function () {
		$(".alert-message").alert();
		
		$('div.evidencia').embedly({
			maxWidth: 700,
			// wmode: 'transparent',
			chars: 150,
			method: 'after',
			key: 'b33bf428428311e19bfa4040d3dc5c07'
		});
	});
</script>

<div class="container">
	
	<div class="row mtop">
		<div class="span12">
			<?php if (strtotime($propuesta->fecha) < strtotime('30 March 2012')): ?>
				<div class="alert-message warning">
				  <a class="close" href="#">×</a>
				  <p><strong>Atención:</strong> Esta propuesta se agregó en periodo de precampaña.</p>
				</div>
			<?php endif ?>
		</div>
	</div>
	
	<div class="row">
		
		<div class="span">
		<div id="prop_header">
			<h1><?php echo $propuesta->titulo;?></h1>
			<h1 id="candidato"><a href="<?php echo base_url().'candidato/index/'.$propuesta->idCandidato; ?>" title=""><small><?php echo $propuesta->nombre?></small></a></h1>
			<p><?php echo $propuesta->nombreCategoria?><span class="separador">|</span><?php echo $propuesta->nombreLugar?><span class="separador">|</span><?php echo date("d/m/Y", strtotime($propuesta->fecha));?><span class="separador">|</span><span class="label success"><?php echo $propuesta->votoPositivo;?></span><span class="separador">|</span><span class="label important"><?php echo $propuesta->votoNegativo;?> </span> <?php echo($propuesta->idPersona == 1) ? '': ( (empty($propuesta->twitter))? '<span class="separador">|</span> Propuesta enviada por '.$propuesta->nombrePersona : '<span class="separador">|</span> Propuesta enviada por <a href="http://twitter.com/'.$propuesta->twitter.'" target="_blank">@'.$propuesta->twitter.'</a>') ;?></p></p>
			<p>
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet" addthis:title="Checa esta propuesta de <?php echo $propuesta->nombre; ?> que encontré en votainformado.mx:" tw:via="votainformado"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
				</div>
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f150ae508227846"></script>
				<!-- AddThis Button END -->
			</p>
		</div>
		<div id="prop_content">
			<h2>Descripción</h2>
			<p><?php echo $propuesta->descripcion;?></p>
			<h2>Evidencia</h2>
			
			<!-- Le url -->
			<?php if ($propuesta->tipoEvidencia == 0): ?>
				<div class="evidencia">
					<a href="<?php echo $propuesta->url_evidencia;?>" title="Evidencia" target="_blank"><?php echo $propuesta->url_evidencia;?></a>
					<br><br>
				</div>
			<?php else: ?>
				<!-- Le archivo -->
				<?php if ($is_file): ?>
					<div class="evidencia">
						<a href="<?php echo base_url(); ?>static/evidencias/<?php echo $propuesta->nombreArchivo; ?>" title="Evidencia" target="_blank"><?php echo $propuesta->nombreArchivo;?></a>
						<!-- <br><br> -->
					</div>
				<?php else: ?>
					<img src="<?php echo base_url(); ?>static/evidencias/<?php echo $propuesta->nombreArchivo; ?>" alt="evidencia" />
				<?php endif ?>
			<?php endif ?>
			<h2>Discute la propuesta</h2>
			<!--Facebook comments-->
			<div id="fb-root"></div>
			<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
			<fb:comments href="<?php echo base_url().uri_string() ?>"></fb:comments>
		</div>
		</div>
		
		<div class="span4">
			<!-- <h2>Sidebar</h2> -->
			
		</div>
	</div>
