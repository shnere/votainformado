<?php if (! defined('BASEPATH')) exit('No direct script access');

class Candidatos_model extends CI_Model {
	/****************************************************
	 *													*
	 *						Create						*
	 *													*
	 ***************************************************/

	/****************************************************
	 *													*
	 *						Read						*
	 *													*
	 ***************************************************/
	function getCandidatos(){
		return $this->db->get('candidatos');
	}
	
	function getCandidato($id){
		
		return $this->db->get_where('candidatos', array('idCandidato' => $id))->row();
	}

	/****************************************************
	 *													*
	 *						Update						*
	 *													*
	 ***************************************************/

	/****************************************************
	 *													*
	 *						Delete						*
	 *													*
	 ***************************************************/

}
/* End of file candidatos_model.php */ 
/* Location: /application/models/candidatos_model.php */