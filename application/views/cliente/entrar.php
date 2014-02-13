<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestion de Clientes</title>
    </head>
    <body>
        <?php
            if($this->session->flashdata("error")){
                echo '<h3>'.$this->session->flashdata("error").'</h3>';
            }
        ?>
        
        <?php
            echo form_open("/cliente/entrar/");
            
            $dominio=array(
                'name' => 'dominio',
                'placeholder' => "Escribe tu dominio"
            );
            
            $codigo=array(
               'name' => 'codigo',
               'placeholder' => "Escribe el codigo"
            );   
            
        ?>
        <label>
            Dominio
            <?php
                  echo form_input($dominio);
            ?>
        </label>
        <br>
        <label>
            Codigo
            <?php
                  echo form_input($codigo);
            ?>
        </label>
        <?php
            echo form_submit("entrar","Entrar");
            echo form_close();
        ?>
    </body>
</html>
