<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php 
    
    include_once  __DIR__ . '/../template/barra.php';    

?>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha;?>"
            />
        </div>

    </form>

</div>
<?php
    if(count($citas)===0){
        echo "<h2>No hay citas en esta fecha<h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php 
            $idCitaAnterior=0;
            foreach ($citas as $key=>$cita){   
                if ($idCitaAnterior !== $cita->id){  
                
                    $totalCita=0
        ?>
                <li>
                    <p>ID: <span><?php echo $cita->id  ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora  ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente  ?></span></p>
                    <p>Email: <span><?php echo $cita->email  ?></span></p>
                    <p>Teléfono: <span><?php echo $cita->telefono  ?></span></p>
                </li>
                <h3>Servicios</h3>

        <?php
                $idCitaAnterior = $cita->id;
                }//If 
                
        ?>   
                <p class="servicio"><?php echo $cita->servicio . " $". $cita->precio?></p>
        <?php
                $totalCita+=$cita->precio;
                $registroActual=$cita->id;
                $proximoRegistro=$citas[$key+1]->id ?? 0;
                if(esUltimo($registroActual,$proximoRegistro)){
         ?>

                 <p class="total">Total: <span>$<?php echo $totalCita;?></span></p>

                 <form action="/api/eliminar" method="POST">
                   <input 
                            type="hidden"
                            name="id"
                            value="<?php echo $cita->id?>"
                    >

                    <input type="submit" class="boton-eliminar" value="Eliminar">
                 </form>
                
        <?php   
                } //If ultimo registro          
         
            }//Foreach
        ?>
         
    </ul>
   
</div>
<?php
    $script = "
        <script src='build/js/buscador.js'></script>
    ";
?>