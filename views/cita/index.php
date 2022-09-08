<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige Tus Servicios y Coloca Tus Datos</p>

<?php 
    
    include_once  __DIR__ . '/../template/barra.php';    

?>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button> <!--Se pueden crear atributos propios en html como data-paso-->
        <button type="button" data-paso="2">Tus Datos y Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"> 
            <!--Se inyecta con Js-->
        </div><!--listado-servicios-->
    </div><!--paso-1-->

    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>

        <form class="formulario"> <!--No va a tener action porque se va a usar Js para que se
                                         mas interactivo-->
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                    id="nombre"
                    type="text"
                    placeholder="Tu Nombre"
                    value="<?php echo $nombre;  ?>"
                    disabled
                />
            </div> <!--campo1-->

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input 
                    id="fecha"
                    type="date"
                    min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                />
            </div> <!--campo2-->

            <div class="campo">
                <label for="hora">Hora</label>
                <input 
                    id="hora"
                    type="time"
  
              
                />
            </div> <!--campo2-->
            <input type="hidden" id="id" value="<?php echo $id;  ?>">

        </form>


    </div><!--paso-2-->
    
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que tu información sea correcta</p>

    </div><!--paso-3-->

    <div class="paginacion">
        <button 
            id="anterior"
            class="boton"
            >&laquo; Anterior</button>
        
        <button 
            id="siguiente"
            class="boton"
            >Siguiente &raquo;</button>
    </div><!--paginacion-->
</div><!--app-->

<?php
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>