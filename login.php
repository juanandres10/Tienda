<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Comprueba Login</title>
</head>
<body>

	<?php
	include 'global/config.php';
	include 'global/conexion.php';

	$boton = $_POST['boton'];

	//boton de Iniciar sesion
	if ($boton == "Entrar") {
		try{
			$sql = "select * from tblUsuarios where correo = :correo and contraseña = :password";
			$resultado = $pdo->prepare($sql);
			$correo=$_POST["correo"];
			$contraseña=$_POST["password"];
			$resultado->bindValue(':correo', $correo);
			$resultado->bindValue(':password', $contraseña);
			$resultado->execute();
			$numero_registro=$resultado->rowCount();

			if ($numero_registro!=0) {
				/*session_start();
				$_SESSION["usuario"]=$_POST["usuario"];*/
				header("location:usuariologeado.php");
			}else{
				echo "no se puede encontrar";
			}

		}catch (PDOException $e) {
    		print "¡Error!: " . $e->getMessage() . "<br/>";
    		exit();
		}
	}
	?>
</body>
</html>