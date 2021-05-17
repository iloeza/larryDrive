<?php
require __DIR__.'/partials/layout_head.php';
?>

<div class="container text-center login__form">
	<h2>Ingresa a LarryDrive</h2>
    <form action='../Controladores/createUser_controller.php'>
        <div class="form-group">
	    <label for="userName">Usuario</label>
	    <input type="text" class="form-control" id="userName" >
        </div>
        <div class="form-group">
	    <label for="userPass">Password</label>
	    <input type="password" class="form-control" id="userPass">
	</div>
        <button type="submit" class="btn btn-primary mt-3">Crear cuenta</button>
    </form>
</div>

<?php
require __DIR__.'/partials/layout_footer.html';
?>
