<?php if (! defined('BASEPATH')) exit('No direct script access');

class Candidato extends CI_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();

	}
	
	function index($idCandidato,$fancyURL='') {
		// Loading of dynamic libraries
		$data['dinamicLibrary']['tabs'] = true;
		$data['queryLimit'] = 8;
		$this->load->model('candidatos_model');
		$this->load->model('propuestas_model');
		$this->load->model('personas_model');
		
		$data['candidato'] = $this->candidatos_model->getCandidato($idCandidato);
		
		// Obtener Propuestas
		$data['queryPropuestasPopulares'] = $this->propuestas_model->get_propuestas_fil( 
										array('publicado' 	=> 1,
										'idCandidato' 	=> $idCandidato), 
										$data['queryLimit'], 
										(1*$data['queryLimit']-$data['queryLimit']), 
										array("( `votoPositivo` +  `votoNegativo` )" => "DESC"));
										
		$data['queryPropuestasRecientes']	= $this->propuestas_model->get_propuestas_fil( 
										array('publicado' 	=> 1,
										'idCandidato' 	=> $idCandidato), 
										$data['queryLimit'], 
										(1*$data['queryLimit']-$data['queryLimit']), 
										array("fecha" => "DESC"));
																						
		$data['queryPropuestasMejores']	= $this->propuestas_model->get_propuestas_fil(
										array('publicado' 	=> 1,
										'idCandidato' 	=> $idCandidato),
										$data['queryLimit'], 
										(1*$data['queryLimit']-$data['queryLimit']), 
										array("`votoPositivo` / (  `votoPositivo` +  `votoNegativo` )" => "DESC"));
																																												
		$data['queryPropuestasPeores']	= $this->propuestas_model->get_propuestas_fil( 
											array('publicado' 	=> 1,
											'idCandidato' 	=> $idCandidato),
											$data['queryLimit'], (1*$data['queryLimit']-$data['queryLimit']), 
											array("`votoNegativo` / (  `votoPositivo` +  `votoNegativo` )" => "DESC"));

		
		$data['queryPersonas'] 			= $this->personas_model->get_personas();

		// Arreglos para traducir id a nombres
		$data['arrPersonas']			= array();
		
		foreach($data['queryPersonas']->result() as $row){
			$data['arrPersonas'][$row->idPersona] = $row->nombre;
		}
		
		/* Configuration Information */
		$data['SYS_metaTitle'] 			= 'Propuestas de '.$data['candidato']->nombre.' en Vota Informado';
		$data['SYS_metaKeyWords'] 		= $data['candidato']->nombre.',propuestas de candidatos,propuesta,propuestas,promesas';
		$data['SYS_metaDescription'] 	= 'Revisa las propuestas de '.$data['candidato']->nombre.'.';
		$data['pestana'] 				= -1;
		$data['SYS_mainContent'] 		= 'candidato_view';
		
		// Checar que exista el candidato
		if(!empty($data['candidato'])) {
			$this->load->view('/includes/template', $data);
		}else {
			redirect('');
		}
		
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
/* End of file candidato.php */ 
/* Location: /application/controllers/candidato.php */