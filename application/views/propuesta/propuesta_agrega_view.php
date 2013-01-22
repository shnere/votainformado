<script>
$(document).ready(function () {
	// Tipo evidencia 0 es sitio 1 archivo
	var tipoEvidencia = -1;
	
	$('#agregaPropuesta').isHappy({
		fields: {
			// reference the field you're talking about, probably by `id`
			// but you could certainly do $('[name=name]') as well.
			'#nombre': {
				required: true,
				message: '¿Tu nombre?'
			},
			'#correo': {
				required: true,
				message: 'Necesitamos tu correo.',
				test: happy.email // this can be *any* function that returns true or false
			},
			'#titulo': {
				required: true,
				message: 'Falta el título de la propuesta.'
			},
			'#descripcion': {
				required: true,
				message: '¿Puedes detallarnos la propuesta un poco más?',
				test: happy.minLength, // this can be *any* function that returns true or false
				arg: 40
			},
			'#evidencia': {
				required: 'sometimes',
				message: 'Evidencia invalida.',
				test: function (val) {
					if(tipoEvidencia == 0){
						return /(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi.test(val);
					}else if(tipoEvidencia == 1){
						puto_input = $('#fileInput').val();
						return (puto_input != '');
					} else {
						return false
					}
				}
				//test: happy.url
			},
		}
	});
	
	$('.urlBtn').click(function(event){
		event.preventDefault();
		$('#opciones').addClass('hidden').fadeOut();
		$('#URL').removeClass('hidden');
		$('#evidencia').focus();
		tipoEvidencia = 0;
		checaEnvio();
	});
	
	$('.archivoBtn').click(function(event){
		event.preventDefault();
		$('#opciones').addClass('hidden').fadeOut();
		$('#archivo').removeClass('hidden');
		tipoEvidencia = 1;
		checaEnvio();
	});
	
	$('.regresar').click(function(event){
		event.preventDefault();
		$(this).closest('div').addClass('hidden');
		$('#opciones').removeClass('hidden').fadeIn();
		tipoEvidencia = -1;
		checaEnvio();
	});
	
	function checaEnvio(){
		if(tipoEvidencia == -1) {
			$('#enviar').addClass('disabled');
		} else {
			$('#enviar').removeClass('disabled');
		}
	}
	
	$(".alert-message").alert();
	
});
</script>
<div class="container">
	<div class="span16">
		<div class="row">
			<div class="span12 mtop">
				<?php if (isset($enviado)): ?>
					<div class="alert-message warning">
					  <a class="close" href="#">×</a>
					  <p><strong>Muchas gracias por tu participación.</strong> Se ha enviado un correo de confirmación a tu correo electrónico.</p>
					</div>
				<?php endif ?>
				<?php if (isset($confirmado)): ?>
					<div class="alert-message success">
					  <a class="close" href="#">×</a>
					  <p><strong>¡Gracias! Tu propuesta ha sido confirmada.</strong> En unas horas estará en la página principal.</p>
					</div>
				<?php endif ?>
				<?php if (isset($errorConf)): ?>
					<div class="alert-message error">
					  <a class="close" href="#">×</a>
					  <p><strong>Código de confirmación incorrecto.</strong> Si crees que es un error nuestro, <a href="<?echo base_url().'/acerca'?>">contáctanos</a>.</p>
					</div>
				<?php endif ?>
				<div class="page-header">
					<h1>¿Encontraste una propuesta? Difúndela</h1>
				</div>
				<?php echo form_open_multipart('propuesta/alta',array('name'=>'agregaPropuesta', 'id'=>'agregaPropuesta'));?>
					<fieldset>
						<legend>Información Personal</legend>
						<!-- Nombre -->
						<div class="clearfix">
							<label for="nombre">Tu nombre completo</label>
							<div class="input">
								<input type="text" name="nombre" id="nombre" class="span4" />
							</div>
						</div>
						<!-- Correo -->
						<div class="clearfix">
							<label for="nombre">Tu correo electrónico</label>
							<div class="input">
								<input type="email" name="correo" id="correo" class="span4" />
								<span class="help-block">Se te enviará un mensaje de confirmación.</span>
							</div>
						</div>
						<!-- Twitter -->
						<div class="clearfix">
							<label for="prependedInput">¿Tienes Twitter?</label>
						    <div class="input">
								<div class="input-prepend">
									<span class="add-on">@</span>
									<input class="medium" id="prependedInput" name="prependedInput" size="16" type="text">
								</div>
							</div>
						</div>
						<!-- Mostrar Datos -->
						<div class="clearfix">
						    <div class="input">
								<div class="input">
									
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Información de Propuesta</legend>
						<div class="clearfix">
							<label for="candidato">Candidato</label>
							<div class="input">
								<select name="candidato" class="span4">
									<?php foreach($candidatos->result() as $row): ?>
										<?php echo '<option value="'.$row->idCandidato.'">'.$row->nombre.'</option>'; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="clearfix">
							<label for="lugar">Lugar</label>
							<div class="input">
								<select name="lugar" class="span4">
									<?php foreach($lugares->result() as $row): ?>
										<?php echo '<option value="'.$row->idLugar.'">'.$row->nombreLugar.'</option>'; ?>
									<?php endforeach; ?>
								</select>
								<span class="help-block">¿Propuesta para una región en específico?</span>
							</div>
						</div>
						<div class="clearfix">
							<label for="categoria">Categoría</label>
							<div class="input">
								<select name="categoria" class="span4">
									<?php foreach($categorias->result() as $row): ?>
										<?php echo '<option value="'.$row->idCategoria.'">'.$row->nombreCategoria.'</option>'; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="clearfix">
							<label for="titulo">Título de la propuesta</label>
							<div class="input">
								<input type="text" name="titulo" id="titulo" class="span4" />
							</div>
						</div>
						<div class="clearfix">
							<label for="descripcion">Descripción</label>
							<div class="input">
								<textarea class="xxlarge" name="descripcion" id="descripcion" rows="3"></textarea>
								<span class="help-block">Danos una descripción breve, <strong>no incluyas el nombre del candidato.</strong></span>
							</div>
						</div>
						<div class="clearfix">
							<label for="evidencia">Evidencia</label>
							<!-- Opciones -->
							<div id="opciones" class="input">
								<button class="btn urlBtn">Sitio web</button>
								<button class="btn archivoBtn">Tengo un archivo</button>
							</div>
							<!-- URL -->
							<div id="URL" class="input hidden">
								<input type="text" name="evidencia" id="evidencia" placeholder="http://www.evidencia.com/"/>
								<span class="help-inline"><button class="btn danger regresar">Regresar</button></span>
								<span class="help-block">Copia y pega la dirección donde encontraste la propuesta.</span>
							</div>
							<!-- Archivo -->
							<div id="archivo" class="input hidden">
								<input class="input-file" id="fileInput" name="fileInput" type="file">
								<span class="help-inline"><button class="btn danger regresar">Regresar</button></span>
								<span class="help-block">Puede ser una imagen, archivo de Office o PDF.</span>
							</div>
						</div>
						<div class="actions">
							<input type="submit" id="enviar" class="btn primary disabled" value="Agrega Propuesta">&nbsp;
							<button type="reset" class="btn">Cancelar</button>
						</div>
					<?php echo form_close();?>
				</fieldset>
			</div>
			<!-- SideBar -->
			<div class="span4">
				
			</div>
		</div>
	</div>
	
	