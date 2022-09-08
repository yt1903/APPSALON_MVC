<h1 class="nombre-pagina">Modifica Servicios</h1>
<p class="descripcion-pagina">Administracion de Servicio</p>

<?php
    include_once __DIR__ .'/../template/barra.php';
    include_once __DIR__ .'/../template/alertas.php';
?>

<form method="POST" class="formulario"> <!--action="/servicios/crear"  se elimina el action porque la url viendo con el id si no hay action se ejecuta el mismo formularion desde el qu se llama-->
  <?php
        include_once  __DIR__. '/formulario.php';
  ?>
        <input 
                type="submit"
                class="boton"
                value="Actualizar">
</form>