
<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Rellena el siguiente formulario para crear una cuenta</p>

<?php 
     include_once __DIR__ . "/../template/alertas.php" ;
?>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Tu Nombre"
                value="<?php echo s($usuario->nombre);?>"  
        >
    </div> <!--campo 1-->

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
                type="text"
                id="apellido"
                name="apellido"
                placeholder="Tu Apellido"
                value="<?php echo s($usuario->apellido);?>"                 
        >
    </div> <!--campo 2-->

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input 
                type="tel"
                id="telefono"
                name="telefono"
                placeholder="Tu Teléfono"
                value="<?php echo s($usuario->telefono);?>"                
        >
    </div> <!--campo 3-->

    <div class="campo">
        <label for="email">E-mail</label>
        <input 
                type="email"
                id="email"
                name="email"
                placeholder="Tu E-mail"
                value="<?php echo s($usuario->email);?>"              
        >
    </div> <!--campo 4-->


    <div class="campo">
        <label for="password">Password</label>
        <input 
                type="password"
                id="password"
                name="password"
                placeholder="Tu Password"             
        >
    </div> <!--campo e-->

    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuanta? Inicia Sesión</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div><!--acciones-->