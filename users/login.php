	<?php


	//boton de Iniciar sesion
		try{
			//Ejecutamos la sentencia para comprobar si esta el correo y contraseña en la base de datos.
			$sql = "select * from tblUsuarios where correo = :correo and contraseña = :password";
			$resultado = $pdo->prepare($sql);
			$correo=$_POST["correo"];
			$contraseña=$_POST["password"];
			$resultado->bindValue(':correo', $correo);
			$resultado->bindValue(':password', $contraseña);
			$resultado->execute();
			$numero_registro=$resultado->rowCount();

			//Si el numero de filas que sale es diferente a 0 osea que encuentre 1.
			if ($numero_registro!=0) {
				//Declaramos si existe la cookie carrito.
				if (isset($_COOKIE['carrito'])) {
					//Pasamos el valor de lo que tiene el usuario invitado en la cookie a la session del ususario logeado y borramos la cookie carrito.
					$aCarrito=unserialize($_COOKIE['carrito'],["allowed_classes" => true]);
					$_SESSION['CARRITO']=$aCarrito;
					setcookie('carrito',"",time()-30000,"/");
				}//Creamos sessiones si el usuario esta logeado que usaremos mas adelante.
				$_SESSION['email']=$correo;
				$_SESSION['contraseña']=$contraseña;
				foreach($resultado->fetchAll() as $key => $value){
					$_SESSION['tipo']=($value[11]);
					$_SESSION['id']=($value[0]);
					//Mensaje de bienvenida que le mostrara su nombre y sus apellidos.
					$mensaje.=ucwords("Bienvenido ".($value[3])." ".($value[4]));
				}
			}else{
				$mensaje.="Este usuario no se encuentra en la base de datos.</br>";
			}

		}catch (PDOException $e) {
    		print "¡Error!: " . $e->getMessage() . "<br/>";
    		exit();
		}
	?>