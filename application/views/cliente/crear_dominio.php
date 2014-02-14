<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if ($this->session->flashdata("error")) {
            echo '<h3>' . $this->session->flashdata("error") . '</h3>';
        }
        if ($this->session->flashdata("mensaje")) {
            echo '<h3>' . $this->session->flashdata("mensaje") . '</h3>';
        }
        ?>

        <?php
        echo form_open("/cliente/crear_dominio");

        $dominio = array(
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
        echo form_submit("crear", "Crear");
        echo form_close();
        ?>
        <hr/>

        <div id="mensaje" >

        </div>


        <table>
            <?php
            foreach ($query->result() as $row) {
                ?>
                <tr>
                    <td>
                        <?php echo $row->dominio ?>
                    </td>
                    <td>
                        <?php echo $row->codigo ?>
                    </td>
                    <td>
                        <button id='<?php echo $row->id; ?>' onclick='eliminar(<?php echo $row->id; ?>)'>Borrar</button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>

        <button onclick="hello()">hola</button>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>

        <script>
            function hello() {
                alert("hello");
            }
        </script>

        <script>
            function eliminar(id) {
                
                
                 $.post("<?php echo base_url()."index.php/cliente/deleteDominio"; ?>", {"id": id}, function(data) {
                 $("#mensaje").html(data.mensaje);
                 if (data.resultado === 1) {
                    $("#"+id).closest("tr").remove();
                 }else{
                    alert("no entre"); 
                 }
                 }, "json");
            }
        </script>

    </body>
</html>
