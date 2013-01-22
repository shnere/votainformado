<?php if (! defined('BASEPATH')) exit('No direct script access');

class Acerca extends CI_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();

	}
	
	function index($option = NULL) {
		global $data;
		// Loading of dynamic libraries
		$data['dinamicLibrary']['validation'] 	= true;
		$data['dinamicLibrary']['alerts'] 		= true;
		
		if($option == 'contact')
			$data['contact'] = true;
		
		/* Configuration Information */
		$data['SYS_metaTitle'] 			= 'Acerca | Vota Informado';
		$data['SYS_metaKeyWords'] 		= 'acerca,vota,about us,votainformado,vota,elecciones,mexico 2012,elecciones 2012';
		$data['SYS_metaDescription'] 	= 'Acerca del equipo de votainformado';
		$data['pestana'] 				= 4;
		$data['SYS_mainContent'] 		= 'acerca_view';
		$this->load->view('/includes/template', $data);
	}

	function como_se_usa() {
		global $data;
		// Loading of dynamic libraries
		//$data['dinamicLibrary']['libraryName'] = true;

		/* Configuration Information */
		$data['SYS_metaTitle'] 			= '¿Como se usa? | Vota Informado';
		$data['SYS_metaKeyWords'] 		= 'como se usa,vota,How to,votainformado,vota,elecciones,mexico 2012,elecciones 2012';
		$data['SYS_metaDescription'] 	= '¿Como se usa VotaInformado? 1) Lee la propuesta, 2) Vota por ella, 3) Descubre quién es el candidato que la promueve, 4) Sigue informándote para decidir por quién deberías votar. ';
		$data['pestana'] 				= 3;
		$data['SYS_mainContent'] 		= 'como_funciona_view';
		$this->load->view('/includes/template', $data);
	}

	/****************************************************
	 *													*
	 *					   Views	 					*
	 *													*
	 ***************************************************/


	/****************************************************
	 *													*
	 *					   Methods	 					*
	 *													*
	 ***************************************************/
	
	function contacto() {
		$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean');
		$this->form_validation->set_rules('correo','Correo','trim|required|xss_clean');
		$this->form_validation->set_rules('mensaje','mensaje','trim|required|xss_clean');

		$this->form_validation->set_message('required','Field "%s" is required');
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');

		if($this->form_validation->run() == FALSE) {
			redirect('acerca');
			return false;
		}
		
		// Enviar correo con codigo de confirmacion
		$this->load->library('email');
		
		$subject = 'Contacto Votainformado';
		$message = 'Nombre: '.$this->input->post('nombre')."\n\n".'Correo: '.$this->input->post('correo')."\n\n".'Mensaje: '.$this->input->post('mensaje');
		
		if($this->email->send_email('fernando@votainformado.mx,alan@votainformado.mx',$subject,$message)) {
			redirect('/acerca/index/contact');
		}
	}
	
	/****************************************************
	 *													*
	 *					   	Ajax	 					*
	 *													*
	 ***************************************************/

}
/* End of file acerca.php */ 
/* Location: /application/controllers/acerca.php */