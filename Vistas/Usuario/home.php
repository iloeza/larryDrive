<?php
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>
<div class="container-fluid">
	<nav class="home__navbar navbar navbar-dark">
		<span class="text-right"><?php echo $username ;?></span>
	</nav>

	<div>
		<h2>Archivos de <?php echo  $username ;?></h2>
	</div>
	<form action='?c=archivo&a=SubirArchivo' method="post" enctype="multipart/form-data" name="form1">
		<input type="file" name="file" id="file">
		<input type="submit" name="SubmitBtn" id="SubmitBtn" value="Subir archivo">
	</form>	

</div>
