<?php
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
require_once 'Controladores/archivo_controller.php';
?>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
	<h2 class="text-white mx-2">Archivos de <?php echo  $username; ?></h2>
	<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<ul class="navbar-nav px-3">
		<li class="nav-item text-nowrap">
			<a class="nav-link" href="?c=usuario&a=logout">Cerrar sesión</a>
		</li>
	</ul>
</nav>

<div class="container-fluid">
	<div class="row">
		<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
			<div class="sidebar-sticky pt-3">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a type="button" class="nav-link text-success" id="showFiles">
							<img src="Public/assets/filesicon.png" alt="" width="30" height="30">
							Ver Archivos
						</a>
					</li>
					<?php if ($_SESSION['isAdmin'] === 1) { ?>
						<li class="nav-item">
							<a type="button" id="admin" class="nav-link text-success">
								<img src="Public/assets/admin.png" alt="" width="30" height="30">
								Gestionar usuarios
							</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</nav>
		<main role="main" id="data" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="pt-3 pb-2 mb-1 border-bottom">
				<h1 class="h2">Dashboard</h1>
				<?php if (isset($_SESSION['mostrarAdmin']) && $_SESSION['mostrarAdmin'] == false) {
					require_once 'Vistas/Usuario/archivosUsuario.php';
				} else {
					require_once 'Vistas/Usuario/admin.php';
				}

				if (isset($_SESSION['mostrarAdmin'])) {
					$_SESSION['mostrarAdmin'] = false;
				}

				?>
		</main>

	</div>
</div>

<!-- Modales -->
<div class="modal fade" id="crearDirModal" tabindex="-1" role="dialog" aria-labelledby="crearDirModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Ingresa el nombre de tu carpeta nueva</h5>
			</div>
			<div class="modal-body">
				<form action='?c=archivo&a=crearDirectorio' class="text-center" method="post" name="crearDir" id="crearDir">
					<input type="text" class="form-control" name="dirname">
					<button type="submit" class="btn btn-success mt-2" id="SubmitDir">Crear carpeta</button>
					<p id="errmsg" class="text-danger d-none mt-3"></p>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="subirArchivoModal" tabindex="-1" role="dialog" aria-labelledby="crearDirModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Elige el archivo</h5>
			</div>
			<div class="modal-body">
				<form action='' method="post" class="text-center" enctype="multipart/form-data" name="form1" id="subirArchivo">
					<input type="file" class="form-control" name="file" id="file">
					<button type="submit" class="btn btn-success mt-2" id="SubmitFile">Subir archivo</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>