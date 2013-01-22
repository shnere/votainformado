<?php if (! defined('BASEPATH')) exit('No direct script access');

class Cron extends CI_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('propuestas_model');
	}
	
	function index() {
		global $data;
		// Loading of dynamic libraries
		//$data['dinamicLibrary']['libraryName'] = true;
		
		// No direct access
		redirect('');
		
		/* Configuration Information */
		$data['SYS_metaTitle'] 			= '';
		$data['SYS_metaKeyWords'] 		= '';
		$data['SYS_metaDescription'] 	= '';
		$data['pestana'] 				= 0;
		$data['SYS_mainContent'] 		= '';
		$this->load->view('/includes/template', $data);
	}

	/****************************************************
	 *													*
	 *					   Methods	 					*
	 *													*
	 ***************************************************/

	function refresh_random() {
		$queryPropuestas = $this->propuestas_model->get_all_propuestas();
		
		foreach($queryPropuestas->result() as $row) {
			$this->propuestas_model->update_propuesta($row->idPropuesta, array('randomOrder' => rand()));
		}
		redirect('');
	}


	/****************************************************
	 *													*
	 *					   	Ajax	 					*
	 *													*
	 ***************************************************/

}
/* End of file cron.php */ 
/* Location: /application/controllers/cron.php */