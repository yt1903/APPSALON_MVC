<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<?php 
     include_once __DIR__ . "/../template/alertas.php" ;
?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">E-mail</label>
        <input 
                type="email"
                id="email"
                name="email"
                placeholder="Tu E-mail"               
        >
    </div> <!--campo e-->
    
    <input type="submit" value="Enviar Instrucciones" class="boton">


</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuanta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crea una</a>
</div><!--acciones-->