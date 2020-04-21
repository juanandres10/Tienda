<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro php</title>
</head>
<body>

	<?php
	include 'global/config.php';
	include 'global/conexion.php';

	$boton = $_POST['boton'];

	//Boton de Registrar
	if ($boton == "Registrar"){
		try{
			if (!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) && !empty($_POST['password']) && !empty($_POST['sexo'])) {
				$sql = "INSERT INTO tblUsuarios ( correo, contraseña, nombre, apellidos, sexo ) VALUES ( :correo, :password, :nombre, :apellidos, :sexo )";

				$resultado = $pdo->prepare($sql);
				$nombre=$_POST["nombre"];
				$apellidos=$_POST["apellidos"];
				$correo=$_POST["correo"];
				$contraseña=$_POST["password"];
				$sexo=$_POST["sexo"];
				$resultado->bindValue(':nombre', $nombre);
				$resultado->bindValue(':apellidos', $apellidos);
				$resultado->bindValue(':correo', $correo);
				$resultado->bindValue(':password', $contraseña);
				$resultado->bindValue(':sexo', $sexo);
				$resultado->execute();
				header("location:usuariologeado.php");
			}else{
				echo "usuario no registrado";
			}
		}catch (PDOException $e) {
    		print "¡Error!: " . $e->getMessage() . "<br/>";
    		exit();
		}
	}
	?>
</body>
</html>