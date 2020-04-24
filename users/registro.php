	<?php

	//Boton de Registrar
		try{
			if (!empty($_POST['nombre']) && preg_match_all("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/", $_POST['nombre'])) {
				if (!empty($_POST['apellidos']) && preg_match_all("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/", $_POST['apellidos'])) {
					if (!empty($_POST['password']) && preg_match_all("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/", $_POST['password'])) {
						if (!empty($_POST['direccion']) && preg_match_all("/[A-Za-z\s]+[0-9]/", $_POST['direccion'])) {
							if (is_numeric($_POST['telefono']) && preg_match_all("/(^[0-9]{9}\b)/", $_POST['telefono'])) {
								if (!empty($_POST['provincia']) && preg_match_all("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/", $_POST['provincia'])) {
									if (is_numeric($_POST['cod_postal']) && preg_match_all("/(^[0-9]{5}\b)/", $_POST['cod_postal'])) {
										if (!empty($_POST['correo']) && preg_match_all("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $_POST['correo'])) {
											if (!empty($_POST['localidad']) && preg_match_all("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/", $_POST['localidad'])) {
												if (!empty($_POST['sexo'])) {

													$sql = "INSERT INTO tblUsuarios ( correo, contraseña, nombre, apellidos, direccion, localidad, provincia, cod_postal,  telefono, sexo, tipo ) VALUES ( :correo, :password, :nombre, :apellidos, :direccion, :localidad, :provincia, :cod_postal, :telefono, :sexo, :tipo )";

													$resultado = $pdo->prepare($sql);
													$nombre=$_POST["nombre"];
													$apellidos=$_POST["apellidos"];
													$correo=$_POST["correo"];
													$contraseña=$_POST["password"];
													$direccion=$_POST["direccion"];
													$localidad=$_POST["localidad"];
													$provincia=$_POST["provincia"];
													$cod_postal=$_POST["cod_postal"];
													$telefono=$_POST["telefono"];
													$sexo=$_POST["sexo"];
													$tipo="Registrado";
													$resultado->bindValue(':nombre', $nombre);
													$resultado->bindValue(':apellidos', $apellidos);
													$resultado->bindValue(':correo', $correo);
													$resultado->bindValue(':password', $contraseña);
													$resultado->bindValue(':direccion', $direccion);
													$resultado->bindValue(':localidad', $localidad);
													$resultado->bindValue(':provincia', $provincia);
													$resultado->bindValue(':cod_postal', $cod_postal);
													$resultado->bindValue(':telefono', $telefono);
													$resultado->bindValue(':sexo', $sexo);
													$resultado->bindValue(':tipo', $tipo);
													$resultado->execute();
													echo "<script>alert('¡¡¡El usuario ha sido registado con exito')</script>";
													$mensaje.="Inicie sesion y disfrute de su visita a la tienda.</br>";
												}else{
													echo "<script>alert('Elige sexo')</script>";
													$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
												}
											}else{
												echo "<script>alert('La localidad esta mal')</script>";
												$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
											}
										}else{
											echo "<script>alert('El correo electronico esta mal escrito')</script>";
											$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
										}
									}else{
										echo "<script>alert('El codigo postal esta mal')</script>";
										$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
									}
								}else{
									echo "<script>alert('La provincia esta mal')</script>";
									$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
								}
							}else{
								echo "<script>alert('El numero de telefono esta mal')</script>";
								$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
							}
						}else{
							echo "<script>alert('La direccion esta mal')</script>";
							$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
						}
					}else{
						echo "<script>alert('La contraseña no es valida')</script>";
						$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
					}
				}else{
					echo "<script>alert('Los apellidos estan mal')</script>";
					$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
				}
			}else{
				echo "<script>alert('El nombre no es correcto')</script>";
				$mensaje.="Ha habido algun problema durante su registro, intentalo de nuevo.</br>";
			}

		}catch (PDOException $e) {
    		print "¡Error!: " . $e->getMessage() . "<br/>";
    		exit();
		}
	?>