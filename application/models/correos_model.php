<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Correos_model extends CI_Model {

    var $id = "";
    var $dominio_id = "";
    var $correo = "";
    var $pass = "";
    var $forward = "";
    var $forward_mail = "";

    function __construct($data) {
        parent::__construct();
        $this->load->database();

        $this->$id = $data['id'];
        $this->$dominio_id = $data['dominio_id'];
        $this->$correo = $data['correo'];
        $this->$pass = $data['pass'];
        $this->$forward = $data['forward'];
        $this->$forward_mail = $data['forward_mail'];
    }

    public function obtenertodos($dominio_id) {
        $this->db->where(array("dominio_id", $id));
        $query = $this->db->get("correos");
        if ($query->row_num() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    public function agregar() {
        $this->db->insert($this);
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    public function modificar($id) {
        $this->db->update($this);
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    public function eliminar($id) {
        $this->db->delete($this);
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

}

?>