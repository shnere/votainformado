<?php if (! defined('BASEPATH')) exit('No direct script access');

class Resultados extends CI_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();

	}
	
	function index() {
		global $data;
		// Loading of dynamic libraries
		//$data['dinamicLibrary']['libraryName'] = true;
		
		// TEMPORALMENTE DESHABILITADA
		redirect('');
		
		/* Configuration Information */
		$data['SYS_metaTitle'] 			= 'Resultados | Vota Informado';
		$data['SYS_metaKeyWords'] 		= '';
		$data['SYS_metaDescription'] 	= '';
		$data['pestana'] 				= 2;
		$data['SYS_mainContent'] 		= 'resultados_view';
		$data['queryLimit'] = 8;
		
		$this->load->model('propuestas_model');

		
		
		$data['jvm'] = $this->propuestas_model->get_propuestas_fil( 
										array('publicado' 	=> 1,
										'idCandidato' 	=> 1), 
										$data['queryLimit'], 
										(1*$data['queryLimit']-$data['queryLimit']), 
										array("( `votoPositivo` +  `votoNegativo` )" => "DESC"));
										
		$data['epn'] = $this->propuestas_model->get_propuestas_fil( 
										array('publicado' 	=> 1,
										'idCandidato' 	=> 2), 
										$data['queryLimit'], 
										(1*$data['queryLimit']-$data['queryLimit']), 
										array("( `votoPositivo` +  `votoNegativo` )" => "DESC"));
										
		$data['amlo'] = $this->propuestas_model->get_propuestas_fil( 
										array('publicado' 	=> 1,
										'idCandidato' 	=> 3), 
										$data['queryLimit'], 
										(1*$data['queryLimit']-$data['queryLimit']), 
										array("( `votoPositivo` +  `votoNegativo` )" => "DESC"));
										
		
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