<?php if (! defined('BASEPATH')) exit('No direct script access');

class Debate extends CI_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();

	}
	
	function index() {
		global $data;
		// Loading of dynamic libraries
		//$data['dinamicLibrary']['libraryName'] = true;
		$data['dinamicLibrary']['debate'] = true;
		
		// TEMPORALMENTE DESHABILITADA
		//redirect('');
		
		/* Configuration Information */
		$data['SYS_metaTitle'] 			= 'Segundo debate presidencial | Vota Informado';
		$data['SYS_metaKeyWords'] 		= 'segundo debate presidencial elecciones 2012 méxico josefina vázquez mota enrique peña nieto andrés manuel lópez obrador gabriel quadri pri pan prd nueva alianza voto informado';
		$data['SYS_metaDescription'] 	= 'Mira en vivo el segundo debate para las elecciones presidenciales de México';
		$data['pestana'] 				= 2;
		$data['SYS_mainContent'] 		= 'debate_view';
		
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


	/****************************************************
	 *													*
	 *					   	Ajax	 					*
	 *													*
	 ***************************************************/

}
/* End of file resultados.php */ 
/* Location: /application/controllers/resultados.php */