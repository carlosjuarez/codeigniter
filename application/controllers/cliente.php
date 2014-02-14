<?php

class cliente extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("mihelper");
        $this->load->helper("form");
        $this->load->library("session");
        $this->load->model("cliente_model");
        $this->load->helper('url');
    }

    public function entrar() {
        if ($this->input->post("entrar")) {
            $data = array(
                'dominio' => $this->input->post('dominio'),
                'codigo' => $this->input->post("codigo")
            );
            $id = $this->cliente_model->comprobarRegistro($data);
            if ($id) {
                $this->session->set_userdata("dominio_id", $id);
                if ($id == 1) {
                    $this->load->view("cliente/crear_dominio");
                } else {
                    $data["dominio"] = $this->input->post("dominio");
                    $this->load->view("cliente/administrar_correo", $data);
                }
            } else {
                $this->session->set_flashdata("error", "El codigo que escribio no es correcto");
                $this->load->view("cliente/entrar");
            }
        } else {
            $this->load->view("cliente/entrar");
        }
    }

    public function administrar_correo($dominio) {
        if ($this->session->get_userdata("dominio_id")) {
            if ($this->input->post("guardar")) {
                
            }
        } else {
            echo "por la salida";
            $this->load->view("cliente/administrar_correo");
        }
    }

    public function crear_dominio() {
        if ($this->session->userdata("dominio_id") == 1) {
            if ($this->input->post("crear")) {
                $codigo = substr(md5(rand()), 0, 7);
                $data = array(
                    "dominio" => $this->input->post("dominio"),
                    "codigo" => $codigo
                );
                if ($this->cliente_model->agregarRegistro($data)) {
                    $titulo = "Nuevo dominio Creado";
                    $mensaje = "Se genero el codigo " . $codigo . " para el dominio " . $this->input->post("dominio");
                    if (true) {/* $this->send_mail($titulo, $mensaje)) { */
                        $this->session->set_flashdata("mensaje", "El dominio se ha creado correctamente");

                        $datos["query"] = $this->cliente_model->obtenerRegistros();
                        $this->load->view("cliente/crear_dominio",$datos);
                    } else {
                        $this->session->set_flashdata("error", "No se envio correo");
                        $this->load->view("cliente/crear_dominio");
                    }
                } else {
                    $this->session->set_flashdata("error", "No se pudo guardar el registro");
                    $this->load->view("cliente/crear_dominio");
                }
            } else {

                $datos["query"] = $this->cliente_model->obtenerRegistros();
                $this->load->view("cliente/crear_dominio", $datos);
            }
        } else {
            $this->load->view("cliente/entrar");
        }
    }

    public function deleteDominio() {
        if ($this->session->userdata("dominio_id") == 1) {
            $id = $this->input->post("id");
            if ($this->cliente_model->eliminarRegistro($id)) {
                $mensaje = "<p>Registro eliminado con exito<p>";
                $resultado = 1;
            } else {
                $mensaje = "<p>No se pudo eliminar el registro<p>";
                $resultado = 0;
            }
            $result = json_encode(array("mensaje" => $mensaje, "resultado" => $resultado));
            echo $result;
        }
    }

    public function salir() {
        $this->session->sess_destroy();
        $this->load->view("cliente/entrar");
    }

    private function send_mail($titulo, $mensaje) {

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'juvcarl@gmail.com',
            'smtp_pass' => 'as.p.K_il.T',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('juvcarl@gmail.com', 'Carlos Juarez');
        $this->email->to('juvcarl@hotmail.com');

        $this->email->subject($titulo);
        $this->email->message($mensaje);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

}

?>