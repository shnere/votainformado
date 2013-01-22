<?php if (! defined('BASEPATH')) exit('No direct script access');

class Main extends CI_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		//$this->load->model('propuestas_model');
	}
	
	function index($pageNum = 1,$categoria = 0) {
		// Loading of dynamic libraries
		$data['dinamicLibrary']['main_vota'] = true;
		$data['dinamicLibrary']['popover'] 	 = true;
		$data['dinamicLibrary']['charts'] 	 = true;
		
		$this->load->model('propuestas_model');
		$this->load->model('partidos_model');
		$this->load->model('candidatos_model');
		$this->load->model('categorias_model');
		
		// Filtrar
		$data['queryOrder']['categoria']= ($categoria!=0||$categoria!=NULL)?($categoria):($this->input->post('categoria'));
		
		if($data['queryOrder']['categoria'] != false && $data['queryOrder']['categoria'] != -1){
			$arrFiltros['idCategoria']	= $data['queryOrder']['categoria'];
		}
		
		// Filtrar por publicados
		$arrFiltros['publicado']  = 1;
		
		// En que pag estoy
		$data['queryOffset']		= $pageNum;
		// Cuantos quiero mostrar por pagina
		$data['queryLimit']			= 9; //como 9gag de antes ;)
		// Cuantas propuestas hay
		$data['queryCountAll']		= $this->propuestas_model->cuantas_propuestas($data['queryOrder']['categoria']);
		
		$data['categoria'] = $data['queryOrder']['categoria'];
		
		// Query que obtiene unicamente los que se piden
		$data['queryPropuestas']	= $this->propuestas_model->get_propuestas_fil( $arrFiltros, 
																				$data['queryLimit'], 			
																				($pageNum*$data['queryLimit']-$data['queryLimit']), 
																				array("randomOrder" => "DESC"));
																				
																				/*
																					TODO Temporalmente ordenado por titulo, real por fecha
																				*/
		
		$data['max'] = ceil($data['queryCountAll'] / $data['queryLimit']);
		
		// Query que obtiene todos los partidos
		$data['queryPartidos'] 		= $this->partidos_model->getPartidos();
		$data['queryRepresenta'] 	= $this->partidos_model->getRepresenta();
		$data['queryCandidatos'] 	= $this->candidatos_model->getCandidatos();
		$data['queryCategorias'] 	= $this->categorias_model->getCategorias();
		
		// Crea arreglo donde se asigna cada id de partido con su nombre corto (pan prd pri)
		foreach($data['queryPartidos']->result() as $row){
			$data['arrPartidos'][$row->idPartido] = $row->nombreCorto;
		}
		foreach($data['queryRepresenta']->result() as $row){
			$data['arrRepresenta'][$row->idCandidato] = $row->idPartido;
		}
		foreach($data['queryCandidatos']->result() as $row){
			$data['arrCandidatos'][$row->idCandidato] = $row->nombre;
		}
		foreach($data['queryCategorias']->result() as $row){
			$data['arrCategorias'][$row->idCategoria] = $row->nombreCategoria;
		}
		
		/* Configuration Information */
		$data['SYS_metaTitle'] 			= 'Vota Informado | Vota por propuestas, no por partidos.';
		$data['SYS_metaKeyWords'] 		= 'votainformado,voto,votoinformado,propuestas,promesas,campaña,elecciones,elecciones mexico,mexico 2012,elecciones 2012,candidatos,voto,propuestas,propuestas candidatos,josefina vazquez mota,enrique peña nieto,andres manuel lopez obrador,amlo,jvm,epn,quadri,propuestas josefina,propuestas peña nieto,propuestas quadri,propuestas amlo,mexico 2012,campañas,campañas electorales';
		$data['SYS_metaDescription'] 	= 'Revisa y evalúa las propuestas de los candidatos para estas próximas elecciones a la presidencia de México 2012. Creemos que un voto informado elige a un candidato por las propuestas que ofrece, sin importar el partido político al que pertenezca.'; //Decidamos bien y ejerzamos nuestro derecho estas próximas elecciones a la presidencia de México 2012.
		$data['pestana'] 				= 0;
		$data['SYS_mainContent'] 		= 'main_vota_view';
		$this->load->view('/includes/template', $data);
	}

	/****************************************************
	 *													*
	 *					   Views	 					*
	 *													*
	 ***************************************************/
	function resultados(){
		$data['SYS_metaTitle'] 			= 'Vota Informado | Vota por propuestas, no por partidos.';
		$data['SYS_metaKeyWords'] 		= 'votainformado,voto,votoinformado,propuestas,campaña,elecciones,elecciones mexico,mexico 2012,elecciones 2012,candidatos';
		$data['SYS_metaDescription'] 	= 'Creemos que un voto informado elige a un candidato por las propuestas que ofrece, sin importar el partido político al que pertenezca. Decidamos bien y ejerzamos nuestro derecho estas próximas elecciones a la presidencia de México 2012.';
		$data['pestana'] 				= 0;
		$data['SYS_mainContent'] 		= 'mis_resultados_view';
		$this->load->view('/includes/template', $data);
	}

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

	function voto_favor() {
		$this->load->model('propuestas_model');
		$idPropuesta = $this->input->post('idPropuesta');
		/*
			TODO checar que no sea bot
		*/
		if ($this->propuestas_model->voto_favor($idPropuesta)){
			echo "ok";
		}else{
			echo "notok";
		}
	}
	
	function voto_contra() {
		$this->load->model('propuestas_model');
		$idPropuesta = $this->input->post('idPropuesta');
		
		if ($this->propuestas_model->voto_contra($idPropuesta)){
			echo "ok";
		}else{
			echo "notok";
		}
	}

}
/* End of file main.php */ 
/* Location: /application/controllers/main.php */