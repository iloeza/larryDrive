<div class="container text-center login__form">
	<h2>Inicia sesión en Larry Drive</h2>
    <form action='?c=usuario&a=login' method="POST">
        <div class="form-group">
	    <label for="userName">Usuario</label>
	    <input type="text" class="form-control" id="userName" name="username" >
        </div>
        <div class="form-group">
	    <label for="userPass">Password</label>
	    <input type="password" class="form-control" id="userPass" name="password">
	</div>
        <button type="submit" class="btn btn-primary mt-3">Iniciar Sesión</button>
		<div class="mt-3">
			<a href="?c=signin">No tienes una cuenta aún?</a>
		</div>
    </form>
</div>
