<?php
    if( ! defined("BASEPATH")) exit("No direct script access allowed");

class Cliente_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }
    
    function obtenerRegistros(){
        $query = $this->db->get("clientes");
        if($query->num_rows() > 0){
            return $query;
        }else{
            return null;
        }
    }
    
    function agregarRegistro($datos){
        $this->db->insert("clientes",array("dominio"=>$datos['dominio'],"codigo"=>$datos['codigo']));
        return ($this->db->affected_rows() != 1) ? false : true;
    }
 
    function comprobarRegistro($data){
        $this->db->where(
                array("dominio"=>$data['dominio'],
                      "codigo"=>$data['codigo'])
                );
        $query = $this->db->get("clientes");
        if($query->num_rows()>0){
            return $query->row()->id;
        }else{
            return null;
        }
    }
    
    function eliminarRegistro($id){
        $this->db->where(
                array(
                    "id" => $id
                )
        );
        $this->db->delete("clientes");
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
}

?>
