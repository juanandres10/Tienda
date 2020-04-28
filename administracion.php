<?php
	include 'global/config.php';
	include 'global/conexion.php';
	session_start();
	include 'templates/cabecera.php';
?>	
	<h1 class="text-center">Panel de Control</h1>
	<div class="row bg-success mt-2 mb-2">
		<nav class="navbar navbar-dark">
			<div class="col">
				<a class="nav-link text-white" href="ingresar.php">Insertar</a>
			</div>
			<div class="col">
				<a class="nav-link text-white" href="mostrar.php">Listar</a>
			</div>
		</nav>
	</div>
<?php
	include 'templates/pie.php';
?>