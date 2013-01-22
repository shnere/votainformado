<!-- <div class="topbar">
  <div class="fill">
    <div class="container">
      <a class="brand" href="#">Votainformado</a>
      <ul class="nav">
        <li class="active"><a href="#">Principal</a></li>
        <li><a href="#about">Acerca</a></li>
        <li><a href="#contact">Contacto</a></li>
      </ul>
    </div>
  </div>
</div> -->



	<!-- <div class="page-header">
			<h1>Vota Informado <small>¿Por quién votar en las próximas elecciones?</small></h1>
		</div> -->
	
  <!-- Main hero unit for a primary marketing message or call to action -->
  <!-- <div class="hero-unit">
      <h1>Vota Informado</h1>
      <p>¿Por quién votar en las próximas elecciones?</p>
    </div> -->
	<!-- <div id="logo_area">
			<div class="container">
				<a href="<?php echo base_url(); ?>" title="Principal"><img class="thumbnail" src="http://placehold.it/220x100" alt=""></a>
			</div>
		</div> -->
	
	<!-- Le menu -->
	<!-- <div class="menu" id="category_menu">
			<div class="container">
				<ul class="nav navmenu menus">
					<li><a href="<?php echo base_url(); ?>" title="Ver Propuestas" class="">Ver Propuestas</a></li>
					<li><a href="<?php echo base_url(); ?>" title="" class="">Agregar Propuesta</a></li>
					<li><a href="<?php echo base_url(); ?>" title="">¿Cómo se Usa?</a></li>
				</ul>
			</div>
		</div> -->
	
	<!-- Le candidatos -->
	<div class="hero resultados">
		<div class="container">
			<h1 class="header-propuesta">Propuestas más populares por candidato</h1>
			<div class="row">
			    <div class="span-one-third">
					<a href="<?php echo base_url(); ?>candidato/index/2/" title="Enrique Peña Nieto">
						<img class="thumbnail" src="<?php echo base_url(); ?>static/img/candidatos/pnbw.png" alt="">
					</a>
				</div>
				<div class="span-one-third">
					<a href="<?php echo base_url(); ?>candidato/index/3/" title="Andrés Manuel López Obrador">
						<img class="thumbnail" src="<?php echo base_url(); ?>static/img/candidatos/amlobw.png" alt="">
					</a>
				</div>
				<div class="span-one-third">
					<a href="<?php echo base_url(); ?>candidato/index/1/" title="Josefina Vázquez Mota">
						<img class="thumbnail" src="<?php echo base_url(); ?>static/img/candidatos/jvmbw.png" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<!-- <div id="header_banner">
		<div class="container">
			<div class="row">
				<div class="span16 prop"><h1>Propuestas</h1></div>
			</div>
			<div class="row">
			    <div class="span-one-third">
					<img class="thumbnail" src="<?php echo base_url(); ?>static/img/candidatos/pnbw.png" alt="">
				</div>
				<div class="span-one-third">
					<img class="thumbnail" src="<?php echo base_url(); ?>static/img/candidatos/amlobw.png" alt="">
				</div>
				<div class="span-one-third">
					<img class="thumbnail" src="<?php echo base_url(); ?>static/img/candidatos/jvmbw.png" alt="">
				</div>
			</div>
		</div>
	</div> -->
	
<div class="container">
	
	<!-- Le propuestas -->
	<div class="row">
		
		<div class="span-one-third">
			<div class="row propuestas">
				<div class="span-one-third">
					<table>
						<?php foreach($epn->result() as $row) :?>
						<tr>
							<td><span class="label success"><?php echo $row->votoPositivo; ?></span></td>
							<td><a href="<?php echo base_url().'propuesta/ver/'.$row->idPropuesta; ?>"><?php echo $row->titulo; ?></a></td>
						</tr>
						<?php endforeach;?>
					</table>
				</div>
				<div class="span-one-third"><a class="btn" href="#">Ver más &raquo;</a></div>
			</div>
		</div>

    <div class="span-one-third">
       	<div class="row propuestas">
			<div class="span-one-third">
				<table>
					<?php foreach($amlo->result() as $row) :?>
					<tr>
						<td><span class="label success"><?php echo $row->votoPositivo; ?></span></td>
						<td><a href="<?php echo base_url().'propuesta/ver/'.$row->idPropuesta; ?>"><?php echo $row->titulo; ?></a></td>
					</tr>
					<?php endforeach;?>
				</table>
			</div>
			<div class="span-one-third"><a class="btn" href="#">Ver más &raquo;</a></div>
		</div>
   </div>
    <div class="span-one-third">
     	<div class="row propuestas lastTable">
			<div class="span-one-third">
				<table>
					<tr>
						<?php foreach($jvm->result() as $row) :?>
						<tr>
							<td><span class="label success"><?php echo $row->votoPositivo; ?></span></td>
							<td><a href="<?php echo base_url().'propuesta/ver/'.$row->idPropuesta; ?>"><?php echo $row->titulo; ?></a></td>
						</tr>
						<?php endforeach;?>
				</table>
			</div>
			<div class="span-one-third"><a class="btn" href="#">Ver más &raquo;</a></div>
		</div>
    </div>
  </div>