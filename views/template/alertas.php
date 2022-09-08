<?php

    //Doble foreach porque el arreglo tiene una llave llamada error $alertas['error'][]=
    foreach ($alertas as $key => $mensajes):
        foreach($mensajes as $mensaje):
?>
   <div class="alerta  <?php echo $key; ?>"> <!--$key tiene otra clase que puede ser error-->

        <?php echo $mensaje; ?>

    </div>


<?php

    endforeach;

    endforeach;

?>