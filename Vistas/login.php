<div class="login-container">
	<form class="form-signin text-center" action='?c=usuario&a=login' method="POST">
  		<img class="mb-4" src="Public/assets/cloud.png" alt="" width="72" height="72">
  		<h1 class="h3 mb-3 font-weight-normal">Inicia sesión en FastDrive</h1>
  		<input type="text" id="userName" name="username" class="form-control" placeholder="Escribe tu usuario" required autofocus>
  		<input type="password" id="userPass" name="password" class="form-control" placeholder="Password" required>
  		<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
		<div class="mt-3">
			<a href="?c=signin">¿No tienes una cuenta aún?</a>
		</div>
	</form>
</div>
