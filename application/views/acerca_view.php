<script>
	$(document).ready(function () {

		$('#contacto').isHappy({
			fields: {
				// reference the field you're talking about, probably by `id`
				// but you could certainly do $('[name=name]') as well.
				'#nombre': {
					required: true,
					message: '¿Tu nombre?'
				},
				'#correo': {
					required: true,
					message: '¿Correo?',
					test: happy.email // this can be *any* function that returns true or false
				},
				'#mensaje': {
					required: true,
					message: 'Dinos más',
					test: happy.minLength, // this can be *any* function that returns true or false
					arg: 20
				},
				'#antibot': {
					required: false,
					message: 'Pinche bot',
					test: happy.maxLength, // this can be *any* function that returns true or false
					arg: 0
				},
			}
		});
		
		$(".alert-message").alert();
	});
</script>

<div class="container">
	
	<div class="row mtop">
		<div class="span8">
			<h2>Acerca de Votainformado</h2>
			<blockquote class="mtop">
				<p>El candidato perfecto no existe, pero una sociedad pensante es posible</p>
			</blockquote>
			<h3>Ideas</h3>
			<ul>
				<li>Vota informado es un ejercicio de verdadera democracia.</li>
				<li>Compartir y discutir la información.</li>
				<li>Decidir tu voto con un buen fundamento.</li>
				<li>Hacer que la gente esté al tanto de qué es lo que ofrecen los candidatos.</li>
				<li>Tener evidencia de lo que los candidatos prometen para verificar que cumplan con ello.</li>
			</ul>
		</div>
		<!-- Le forma de contacto -->
		<div class="span8">
			<?php if (isset($contact)): ?>
				<div class="alert-message warning">
				  <a class="close" href="#">×</a>
				  <p><strong>Gracias por contactarnos.</strong> Nos pondremos en contacto con usted a la brevedad posible.</p>
				</div>
			<?php endif ?>
			<h2>Contáctanos</h2>
				<fieldset>
					<?php echo form_open('acerca/contacto',array('name'=>'contacto', 'id'=>'contacto'));?>
					<!-- Le Nombre -->
					<div class="clearfix">
						<label for="nombre">Dinos tu nombre</label>
						<div class="input">
							<input type="text" name="nombre" id="nombre" class="span4" />
						</div>
					</div>
					<!-- Le Correo -->
					<div class="clearfix">
						<label for="nombre">Tu correo electrónico</label>
						<div class="input">
							<input type="email" name="correo" id="correo" class="span4" />
						</div>
					</div>
					<!-- Le Mensaje -->
					<div class="clearfix">
						<label for="descripcion">Mensaje</label>
						<div class="input">
							<textarea class="span4" name="mensaje" id="mensaje" rows="3"></textarea>
						</div>
					</div>
					<div class="clearfix hidden">
						<label for="descripcion">Eres bot?</label>
						<div class="input">
							<input type="text" name="antibot" id="antibot" class="span4" />
						</div>
					</div>
					<!-- Le acciones -->
					<div class="input">
						<input type="submit" id="enviar" class="btn primary" value="Enviar mensaje">
					</div>
					<?php echo form_close();?>
				</fieldset>
		</div>
	</div>
	
	<div class="row">
		<div class="span16">
			<h2 class="avientame" id="avientame">¿Te gustarían más proyectos como éste?</h2>
			<br>
			<div class="row avientaBg">
				<div class="span8">
					<div class="deberiamosEstarHaciendoBloquePeroSomosEmprendedores">
						<strong class="notThatBig">¡Hola Extraño!</strong>
						<br><br>
						Esperamos que este sitio te haya sido de tu agrado y sobre todo haya generado un sentido de conciencia antes de votar.
						<br><br>
						Nosotros somos un grupo de jóvenes emprendedores que busca mejorar nuestra sociedad a través de la innovación tecnológica y VotaInformado es nuestro proyecto inicial. Con este, queremos formalizar una de muchas ideas y también introducir la siguiente: <strong>Avienta.me</strong>
						<br><br>
						
						<br><br>
					</div>
				</div>
				<div class="span8">
					<div class="confiamosEnLaGenteBuenaOndaDeMexicoQueApoyaraEsteProyecto">
						<strong class="notThatBig">¡Necesitamos tu apoyo!</strong>
						<br><br>
						<strong>Avienta.me</strong> es una serie de aplicaciones web y móviles que te ayudan a transportarte de manera <strong>segura</strong>, fácil, y económica a donde quieras. Avienta.me te permite compartir transporte entre personas con destinos similares a los tuyos, ayudando a disminuir el tráfico y haciendo más eficiente y sustentable la manera de movilizarte.<br><br>
						Para poder formalizar ésta y otras ideas, estamos buscando inversionistas para reunir el capital necesario. Si deseas apoyar a proyectos como éste o VotaInformado, estaríamos profundamente agradecidos de tu <strong>donativo vía pay-pal</strong>, si eres inversionista y crees en las buenas ideas de jóvenes emprendedores, contáctanos, nos gustaría hablar contigo.
						<br><br>
					</div>
				</div>
			</div>
		</div>
	</div>
	