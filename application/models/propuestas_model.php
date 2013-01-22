<?php if (! defined('BASEPATH')) exit('No direct script access');

class Propuestas_model extends CI_Model {
	/****************************************************
	 *													*
	 *						Create						*
	 *													*
	 ***************************************************/
	
	function crear_propuesta($data){
		return $this->db->insert('propuestas', $data);	
	}

	/****************************************************
	 *													*
	 *						Read						*
	 *													*
	 ***************************************************/
	
	function get_all_propuestas($data = array()) {
		return $this->db->get_where('propuestas',$data);
	}
	
	function cuantas_propuestas($categoria = 0) {
		if($categoria == 0){
			return $this->db->count_all('propuestas');
		}
		$query = $this->db->get_where('propuestas', array('idCategoria' => $categoria, 'publicado' => 1));
		return $query->num_rows();
	}
	
	function get_propuestas_fil($arrFiltro, $limit, $offset, $arrOrderBy){
		
		if($arrOrderBy != NULL){
			$strComp 	= "";
			$first		= true;
			foreach( $arrOrderBy as $key => $value ){
				if($first){
					$strComp .= $key." ".$value;
					$first	 = !$first;
				}else{
					$strComp .= ", ".$key." ".$value;
				}
				
			}
			$this->db->order_by($strComp);
		}
		return $this->db->get_where('propuestas', $arrFiltro, $limit, $offset);
	}
	
	function get_propuesta($id){
		
		$this->db->select('propuestas.titulo, propuestas.fecha, propuestas.descripcion, propuestas.votoPositivo, propuestas.votoNegativo, propuestas.tipoEvidencia, propuestas.url_evidencia, propuestas.nombreArchivo,  candidatos.idCandidato, candidatos.nombre, persona.nombre as nombrePersona, persona.idPersona , persona.twitter, lugar.nombreLugar, categorias.nombreCategoria');
		$this->db->where('propuestas.idPropuesta', $id);
		$this->db->from('propuestas','candidatos','categorias','lugar');
		$this->db->join('lugar','propuestas.idLugar = lugar.idLugar');
		$this->db->join('categorias', 'propuestas.idCategoria = categorias.idCategoria');
		$this->db->join('candidatos','propuestas.idCandidato = candidatos.idCandidato');
		$this->db->join('persona', 'propuestas.idPersona = persona.idPersona' );
		
		$query = $this->db->get();
		
		return ($query->num_rows() > 0) ? $query->row() : 'fail';
		
	}
	
	function valid_conf_code($conf_code = '')
	{
		$query = $this
				->db
				->where	('codigoConfirmacion',$conf_code)
				->get	('propuestas');

		return ($query->num_rows() > 0) ? $query->row(0)->idPropuesta : -1;	
	}
	
	
	/****************************************************
	 *													*
	 *						Update						*
	 *													*
	 ***************************************************/
	
	function update_propuesta($idPropuesta, $arrayUpdate){		
		return $this
			->db
			->where	('idPropuesta',$idPropuesta)
			->update('propuestas' ,$arrayUpdate);
	}
	
	function voto_favor($idPropuesta) {
		return $this->db
			->where	('idPropuesta',$idPropuesta)
			->set('votoPositivo','votoPositivo +1',FALSE)
			->update('propuestas');
	}

	function voto_contra($idPropuesta) {
		return $this->db
			->where	('idPropuesta',$idPropuesta)
			->set('votoNegativo','votoNegativo +1',FALSE)
			->update('propuestas');
	}

	/****************************************************
	 *													*
	 *						Delete						*
	 *													*
	 ***************************************************/

}
/* End of file propuestas_model.php */ 
/* Location: /application/models/propuestas_model.php */