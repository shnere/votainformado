<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title><?= $SYS_metaTitle; ?></title>
		<meta name="author" 		content="votainformado.mx">
		<meta name="keywords" 		content="<?= $SYS_metaKeyWords; ?>">
		<meta name="description" 	content="<?= $SYS_metaDescription; ?>">

		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le styles -->
		<link href="<?php echo base_url();?>static/styles/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo base_url();?>static/styles/css/main.css" rel="stylesheet">

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="<?php echo base_url();?>static/ico/favicon.ico">
		<link rel="apple-touch-icon" href="<?php echo base_url();?>static/ico/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>static/ico/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>static/ico/apple-touch-icon-114x114.png">
		
		<!-- Le scripts -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.ias.js"></script>
		<script src="<?php echo base_url();?>static/js/bootstrap-dropdown.js"></script>
		<script src="http://widgets.twimg.com/j/2/widget.js"></script>
		<?php if (isset($dinamicLibrary['validation'])): ?>
				<script src="<?php echo base_url();?>static/js/happy.js"></script>
				<script src="<?php echo base_url();?>static/js/happy.methods.js"></script>
		<?php endif ?>
		<?php if (isset($dinamicLibrary['tabs'])): ?>
				<script src="<?php echo base_url();?>static/js/bootstrap-tabs.js"></script>
		<?php endif ?>
		<?php if (isset($dinamicLibrary['alerts'])): ?>
				<script src="<?php echo base_url();?>static/js/bootstrap-alerts.js"></script>
		<?php endif ?>
		<?php if (isset($dinamicLibrary['popover'])): ?>
				<script src="<?php echo base_url();?>static/js/bootstrap-twipsy.js"></script>
				<script src="<?php echo base_url();?>static/js/bootstrap-popover.js"></script>
		<?php endif ?>
		<?php if (isset($dinamicLibrary['embedly'])): ?>
			<script src="http://scripts.embed.ly/jquery.embedly.min.js"></script>
		<?php endif ?>
		<?php if (isset($dinamicLibrary['charts'])): ?>
			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<?php endif ?>
		<script src="<?php echo base_url();?>static/js/bootstrap-dropdown.js"></script>
		<!-- Le page styles -->
		<?php if (isset($dinamicLibrary['main_vota'])): ?>
				<script src="<?php echo base_url();?>static/js/local/main_vota_view.js"></script>
				<script>var max = <?php echo $max; ?>;</script>
		<?php endif ?>
		
		<!-- Le load of global variables -->
		<script>
			var base_url = "<?php echo base_url(); ?>";
			// Cache version es la version de actualizacion del localStorage, en DD-MM-YY hora
			// Si se necesita limpiar entonces borrar
			var cache_version = "<?php echo strtotime('02-03-2012 13:10'); ?>";
			var current_time = "<?php echo time(); ?>";
			$('.dropdown-toggle').dropdown();
			
		</script>
	
	</head>
	<body>
		
		<div class="topbar">
		  <div class="header">
		    <div class="container">
		      <a class="brand" href="<?php echo base_url(); ?>" title="Principal"><img class="thumbnail" src="<?php echo base_url(); ?>static/img/logovibeta.png" alt=""></a>
		      <ul class="nav">
		        <li><a class="<?php if($pestana == 0)echo "btn disabled";?>" href="<?php echo base_url(); ?>">Vota</a></li>
		        <li><a class="<?php if($pestana == 1)echo "btn disabled";?>" href="<?php echo base_url(); ?>propuesta/agrega">Agrega</a></li>
		        <!-- <li><a class="<?php if($pestana == 2)echo "btn disabled";?>" href="<?php echo base_url(); ?>resultados">Resultados</a></li> -->
				<li class="dropdown dropdown-sabroso" data-dropdown="dropdown">
					<a href="#" class="dropdown-toggle">Candidatos</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>candidato/Andres-Manuel-Lopez-Obrador">Andrés Manuel López Obrador</a></li>
						<li><a href="<?php echo base_url(); ?>candidato/Enrique-Pena-Nieto">Enrique Peña Nieto</a></li>
						<li><a href="<?php echo base_url(); ?>candidato/Gabriel-Quadri-de-la-Torre">Gabriel Quadri de la Torre</a></li>
						<li><a href="<?php echo base_url(); ?>candidato/Josefina-Vazquez-Mota">Josefina Vázquez Mota</a></li>
					</ul>
				</li><!-- /li.dropdown-sabroso -->
		        <li><a class="<?php if($pestana == 3)echo "btn disabled";?>" href="<?php echo base_url(); ?>acerca/como_se_usa">¿Cómo se usa?</a></li>
		        <li><a class="<?php if($pestana == 4)echo "btn disabled";?>" href="<?php echo base_url(); ?>acerca">Acerca</a></li>
		      </ul>
		    </div>
		  </div>
		</div>