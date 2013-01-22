<?php if (! defined('BASEPATH')) exit('No direct script access');

class Personas_model extends CI_Model {
	/****************************************************
	 *													*
	 *						Create						*
	 *													*
	 ***************************************************/
	
	function crear_persona($data){
		return $this->db->insert('persona', $data);	
	}

	/****************************************************
	 *													*
	 *						Read						*
	 *													*
	 ***************************************************/
	function get_personas(){
		return $this->db->get('persona');
	}
	
	function persona_existe($email){
		
		if( $this->db->get_where('persona', array('email' => $email))->num_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}
	
	function get_persona_id($email){
		return $this->db->get_where('persona', array('email' => $email))->row()->idPersona;
	}
	
	function persona_puede_publicar($email){
		
		$query =  $this->db->get_where('persona', array('email' => $email));
		return $query->result()->strikes < 3 ? TRUE : FALSE;
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
/* End of file personas_model.php */ 
/* Location: /application/models/personas_model.php */