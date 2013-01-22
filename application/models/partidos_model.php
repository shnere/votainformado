<?php if (! defined('BASEPATH')) exit('No direct script access');

class Partidos_model extends CI_Model {
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
	function getPartidos(){
		return $this->db->get('partidos');
	}

	function getRepresenta(){
		return $this->db->get('representa');
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
/* End of file partidos_model.php */ 
/* Location: /application/models/partidos_model.php */