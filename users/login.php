	<?php


	//boton de Iniciar sesion
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
				if (isset($_COOKIE['carrito'])) {
					$aCarrito=unserialize($_COOKIE['carrito'],["allowed_classes" => true]);
					$_SESSION['CARRITO']=$aCarrito;
					setcookie('carrito',"",time()-30000,"/");
				}
				$_SESSION['email']=$correo;
				$_SESSION['contraseña']=$contraseña;
				foreach($resultado->fetchAll() as $key => $value){
					$_SESSION['tipo']=($value[11]);
					$_SESSION['id']=($value[0]);
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