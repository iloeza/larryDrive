<?php
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
	require_once 'Controladores/archivo_controller.php';
?>
<div class="container-fluid">
	<nav class="home__navbar navbar navbar-dark">
		<span class="text-right"><?php echo $username ;?></span>
	</nav>

	<div>
		<h2>Archivos de <?php echo  $username ;?></h2>
	</div>
	<form action='' method="post" enctype="multipart/form-data" name="form1" id="subirArchivo">
		<input type="file" name="file" id="file">
		<input type="submit" name="SubmitBtn" id="SubmitBtn" value="Subir archivo">
	</form>	
	<form action='?c=archivo&a=crearDirectorio' method="post" name="crearDir" id="crearDir">
		<input type="text" name="dirname">
		<input type="submit" name="submitDir" id="SubmitDir" value="Crear Directorio">
	</form>	

	<div id="data">

		<?php
		$archivos = new ArchivoController();?>

		<nav aria-label="breadcrumb">
	  		<ol class="breadcrumb">
				<?php $rutasActivas = empty($_SESSION['ruta']) ? false : true; ?>
				<li class="breadcrumb-item <?php echo $rutasActivas ? "" : "active"; ?>"><span class="getDir" point="-1">Home</span></li>
				<?php if ($rutasActivas !== "active") { 
					$point = 0; ?>
					<?php foreach($_SESSION['ruta'] as $ruta){ ?> 
					<li class="breadcrumb-item active"><span class="getDir" point=<?php echo $point;?>><?php echo $ruta; ?></span></li>
				<?php 
					$point++;
				}} ?>
	  		</ol>
		</nav>
		<?php echo $archivos->GetArchivos(); ?>
	</div>	
</div>

