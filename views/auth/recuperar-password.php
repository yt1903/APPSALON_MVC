<h1 class="nombre-pagina">Recuperar Password</h1> 

<p class="descripcion-pagina">Coloca Tu Nuevo Password a Continuación</p>

<?php 
    
    include_once  __DIR__ . '/../template/alertas.php';    

?>

<?php if($error) return ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Tu Nuevo Password"
        />

    </div>

   <input type="submit" class="boton" value="Nuevo Password"> 
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuanta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crea una</a>

</div>