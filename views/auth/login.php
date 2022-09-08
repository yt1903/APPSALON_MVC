<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesion con tus datos</p>

<?php 
     include_once __DIR__ . "/../template/alertas.php" ;
?>

<form class="formulario" method="POST" action="/"> 
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu email"
            name="email"


        />

    </div><!--campo 1-->

    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu password"
            name="password"

        />

    </div><!--campo 2-->
    <input type="submit" class="boton" value="Iniciar Sesión">

</form><!--formulario-->

<div class="acciones">
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crea una</a>
    <a href="/olvide">¿Olvidaste tu password?</a>

</div><!--acciones-->