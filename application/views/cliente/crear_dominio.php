<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if($this->session->flashdata("error")){
                echo '<h3>'.$this->session->flashdata("error").'</h3>';
            }
            if($this->session->flashdata("mensaje")){
                echo '<h3>'.$this->session->flashdata("mensaje").'</h3>';
            }
        ?>
        
        <?php
            echo form_open("/cliente/crear_dominio");
            
            $dominio=array(
                'name' => 'dominio',
                'placeholder' => "Escribe tu dominio"
            );
        ?>
        <label>
            Dominio
            <?php
                  echo form_input($dominio);
            ?>
        </label>
        <?php
            echo form_submit("crear","Crear");
            echo form_close();
        ?>
    </body>
</html>
