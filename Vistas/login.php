<?php
require __DIR__.'/partials/layout_head.php';
?>

<div class="container text-center login__form">
	<h2>Crea tu cuenta en Larry Drive</h2>
    <form action='../Controladores/login.php'>
        <div class="form-group">
	    <label for="userName">Usuario</label>
	    <input type="text" class="form-control" id="userName" >
        </div>
        <div class="form-group">
	    <label for="userPass">Password</label>
	    <input type="password" class="form-control" id="userPass">
	</div>
        <button type="submit" class="btn btn-primary mt-3">Iniciar Sesion</button>
    </form>
</div>

<?php
require __DIR__.'/partials/layout_footer.html';
?>

