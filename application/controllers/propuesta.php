<?php if (! defined('BASEPATH')) exit('No direct script access');

class Propuesta extends CI_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		
		$this->load->model('propuestas_model');
	}
	
	function index() {
		// Loading of dynamic libraries
		//$data['dinamicLibrary']['libraryName'] = true;
		redirect("");
	}
	
	function agrega($option = NULL) {
		// Loading of dynamic libraries
		$data['dinamicLibrary']['validation'] = true;
		$data['dinamicLibrary']['alerts'] = true;
		
		/* Configuration Information */
		$data['SYS_metaTitle'] 			= 'Agregar propuesta de un candidato | Vota Informado';
		$data['SYS_metaKeyWords'] 		= 'agregar propuesta, propuestas candidatos, agregar una propuesta, votoinformado';
		$data['SYS_metaDescription'] 	= '¿Encontraste una propuesta de algún candidato a la presidencia? Difúndela y permite que más gente se informe.';
		$data['pestana'] 				= 1;
		$data['SYS_mainContent'] 		= 'propuesta/propuesta_agrega_view';
		$data['error']					= '';
		
		$this->load->model('candidatos_model');
		$this->load->model('lugares_model');
		$this->load->model('categorias_model');
		
		$data['candidatos'] = $this->candidatos_model->getCandidatos();
		$data['lugares'] = $this->lugares_model->getLugares();
		$data['categorias'] = $this->categorias_model->getCategorias();
		
		if($option == 'enviado')
			$data['enviado'] = true;
		if($option == 'confirmado')
			$data['confirmado'] = true;
		if($option == 'errorConf')
			$data['errorConf'] = true;
		
		$this->load->view('/includes/template', $data);
		
		
		
	}
	/****************************************************
	 *													*
	 *					   Views	 					*
	 *													*
	 ***************************************************/
	
	function ver(){
		$data['dinamicLibrary']['alerts'] = true;
		$data['dinamicLibrary']['embedly'] = true;
		
		if(($data['propuesta'] = $this->propuestas_model->get_propuesta($this->uri->segment(3))) == 'fail') {
			redirect('');
		}
		
		$data['SYS_metaTitle'] 			= $data['propuesta']->titulo.', propuesta de '.$data['propuesta']->nombre.' | Vota Informado';
		$data['SYS_metaKeyWords'] 		= 'votainformado,voto,votoinformado,propuestas,promesas,campaña,elecciones,elecciones mexico,mexico 2012,elecciones 2012,candidatos,voto,propuestas,propuestas candidatos,josefina vazquez mota,enrique peña nieto,andres manuel lopez obrador,amlo,jvm,epn,quadri,propuestas josefina,propuestas peña nieto,propuestas quadri,propuestas amlo,mexico 2012,campañas,campañas electorales';
		$data['SYS_metaDescription'] 	= $data['propuesta']->titulo.', propuesta de '.$data['propuesta']->nombre;
		$data['pestana'] 				= -1;
		$data['SYS_mainContent'] 		= 'propuesta/propuesta_view_view';
		
		if($data['propuesta']->tipoEvidencia == 1){ //significa que es archivo
			$ext = array('pdf','doc','docx','xls','xlsx','ppt','pptx');
			$ext2 = explode('.', $data['propuesta']->nombreArchivo);
			$ext3 = $ext2[1];
			
			if(in_array($ext3, $ext)){
				$data['is_file'] = TRUE;
			}else{	
				$data['is_file'] = FALSE;
			}		
		}
		
		$this->load->view('/includes/template', $data);
	}

	/****************************************************
	 *													*
	 *					   Methods	 					*
	 *													*
	 ***************************************************/
	
	function valida($code) {
		
		if (($idPropuesta = $this->propuestas_model->valid_conf_code($code)) !== -1) {
			if ($this->propuestas_model->update_propuesta($idPropuesta,array('confirmado'=>1))) {
				redirect('propuesta/agrega/confirmado');
			}
		} else {
			redirect('propuesta/agrega/errorConf');
		}
	}
	
	function alta(){
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean');
		$this->form_validation->set_rules('correo','Correo','trim|required|xss_clean');
		$this->form_validation->set_rules('prependedInput','prependedInput','trim|xss_clean');
		
		$this->form_validation->set_rules('candidato','Candidato','trim|required|xss_clean');
		$this->form_validation->set_rules('lugar','Lugar','trim|required|xss_clean');
		$this->form_validation->set_rules('categoria','Categoria','trim|required|xss_clean');
		$this->form_validation->set_rules('titulo','Titulo','trim|required|xss_clean');		
		$this->form_validation->set_rules('descripcion','Descripcion','trim|required|xss_clean');
		$this->form_validation->set_rules('evidencia','Evidencia','trim|xss_clean');
		
		$this->form_validation->set_message('required','Field "%s" is required');
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		
		if($this->form_validation->run() == FALSE) {
			redirect('propuesta/agrega');
			return false;
		}
		
		$data_persona = array(
			
			'nombre'	=> $this->input->post('nombre'),
			'email'		=> $this->input->post('correo'),
			'twitter'	=> $this->input->post('prependedInput')
		);
		
		$data_propuesta = array(
			'idCandidato'	=> $this->input->post('candidato'),
			'idLugar'		=> $this->input->post('lugar'),
			'idCategoria'	=> $this->input->post('categoria'),
			'titulo'		=> $this->input->post('titulo'),
			'descripcion'	=> $this->input->post('descripcion'),
			'fecha'			=> date('Y-m-d'),
			'publicado'		=> 0
		);
		
		if(!(strcmp($this->input->post('evidencia'),'') == 0) ){
			
			$data_propuesta['tipoEvidencia'] = 0;
			$data_propuesta['url_evidencia'] = $this->input->post('evidencia');
		}else{
			$data_propuesta['tipoEvidencia'] = 1;
			
			$config['upload_path'] 		= 'static/evidencias/';
			$config['allowed_types'] 	= 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|ppt|pptx';
			$config['max_size']			= '1024';
			$config['max_width']		= '2000';
			$config['max_height']		= '2000';
			$config['remove_spaces']	= TRUE;
			$config['encrypt_name']		= TRUE;

			$this->load->library('upload', $config);

			if ( !($this->upload->do_upload('fileInput')) )
			{
				redirect('propuesta/agrega/errorenvio');
				$data = array('error' => $this->upload->display_errors());
				$this->load->view('propuesta/propuesta_agrega_view', $data);
				return false;
			}
			
			$upload = $this->upload->data();
			$data_propuesta['nombreArchivo'] = $upload['file_name'];

		}
		
		
		// Agrega persona
		$this->load->model('personas_model');
			
		if(! $this->personas_model->persona_existe($data_persona['email'])){
			
			if(!$this->personas_model->crear_persona($data_persona)){
				return false;
			}
		}
		$data_propuesta['idPersona'] = $this->personas_model->get_persona_id($data_persona['email']);
		
		// Crear codigo confirmacion
		$data_propuesta['codigoConfirmacion'] = md5($data_persona['email'].rand().time());
		
		// Enviar correo con codigo de confirmacion
		$this->load->library('email');
		
		$subject = 'Confirmacion de envío de propuesta';
		$message = 'Gracias por agregar una propuesta en votainformado.mx'."\n\n".'Para que tu propuesta pueda ser aprobada tienes que confirmarla haciendo click en la siguiente liga: '.base_url()."propuesta/valida/".$data_propuesta['codigoConfirmacion']."\n\n"."Muchas gracias.";
		
		if($this->email->send_email($data_persona['email'],$subject,$message)) {
			
		}
		
		if(!$this->propuestas_model->crear_propuesta($data_propuesta)){
			return false;
		}
		
		/*
		TODO
		revisar que la persona tenga autorizado publicar
		envío de correo de confirmación
		*/
		
		redirect('propuesta/agrega/enviado');
		
	}
	

	/****************************************************
	 *													*
	 *					   	Ajax	 					*
	 *													*
	 ***************************************************/

}
/* End of file propuesta.php */ 
/* Location: /application/controllers/propuesta.php */