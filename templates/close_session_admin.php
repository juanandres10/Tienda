<form action="#" method="POST">
	<button type="submit" class="btn btn-primary text-white" name="boton" value="Administracion">Administracion Web</button>
	<button type="submit" class="btn btn-primary text-white" name="boton" value="Cerrar">Cerrar Sesion</button>
	<?php
		echo $_SESSION['tipo'];
		echo $_SESSION['id'];
		echo $_SESSION['contraseña'];
		echo $_SESSION['email'];
	?>
</form>