<?php if (! defined('BASEPATH')) exit('No direct script access');

class Categorias_model extends CI_Model {
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
	function getCategorias(){
		$this->db->order_by('nombreCategoria', 'ASC');
		return $this->db->get('categorias');
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