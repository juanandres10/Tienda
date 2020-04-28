<?php
	class CrudProducto{
		// constructor de la clase
		public function __construct(){}

		// método para insertar, recibe como parámetro un objeto de tipo producto
		public function insertar($producto){
			try {
				$dsn = 'mysql:host=localhost;dbname=tienda';
				$user = 'root';
				$password = '';
				$pdo = new PDO($dsn, $user, $password);
		    	$pdo->setAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$insert=$pdo->prepare('INSERT INTO tblproductos (id, nombre, precio, descripcion, imagen) values(NULL,:nombre,:precio, :descripcion, :imagen)');
				$insert->bindValue('nombre',$producto->getNombre());
				$insert->bindValue('precio',$producto->getPrecio());
				$insert->bindValue('descripcion',$producto->getDescripcion());
				$insert->bindValue('imagen',$producto->getImagen());
				$insert->execute();
			}catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				exit();
			}

		}

		// método para mostrar todos los productos
		public function mostrar(){
			$listaProductos=[];
			try {
				$dsn = 'mysql:host=localhost;dbname=tienda';
				$user = 'root';
				$password = '';
				$pdo = new PDO($dsn, $user, $password);
		    	$pdo->setAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$select=$pdo->query('SELECT * FROM tblproductos');

				foreach($select->fetchAll() as $producto){
					$myProducto= new Producto();
					$myProducto->setId($producto['id']);
					$myProducto->setNombre($producto['nombre']);
					$myProducto->setPrecio($producto['precio']);
					$myProducto->setDescripcion($producto['descripcion']);
					$myProducto->setImagen($producto['imagen']);
					$listaProductos[]=$myProducto;
				}
				return $listaProductos;
			}catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				exit();
			}
		}

		// método para eliminar un producto, recibe como parámetro el id del producto
		public function eliminar($id){
			try {
				$dsn = 'mysql:host=localhost;dbname=tienda';
				$user = 'root';
				$password = '';
				$pdo = new PDO($dsn, $user, $password);
		    	$pdo->setAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$eliminar=$pdo->prepare('DELETE FROM tblproductos WHERE id=:id');
				$eliminar->bindValue('id',$id);
				$eliminar->execute();
			}catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				exit();
			}
		}

		// método para buscar un producto, recibe como parámetro el id del producto
		public function obtenerProducto($id){
			try {
				$dsn = 'mysql:host=localhost;dbname=tienda';
				$user = 'root';
				$password = '';
				$pdo = new PDO($dsn, $user, $password);
		    	$pdo->setAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$select=$pdo->prepare('SELECT * FROM tblproductos where id=:id');
				$select->bindValue('id',$id);
				$select->execute();
				$producto=$select->fetch();
				$myProducto= new Producto();
				$myProducto->setId($producto['id']);
				$myProducto->setNombre($producto['nombre']);
				$myProducto->setPrecio($producto['precio']);
				$myProducto->setDescripcion($producto['descripcion']);
				$myProducto->setImagen($producto['imagen']);
				return $myProducto;
			}catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				exit();
			}
		}

		// método para actualizar un producto, recibe como parámetro el producto
		public function actualizar($producto){
			try {
				$dsn = 'mysql:host=localhost;dbname=tienda';
				$user = 'root';
				$password = '';
				$pdo = new PDO($dsn, $user, $password);
		    	$pdo->setAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$actualizar=$pdo->prepare('UPDATE tblproductos SET nombre=:nombre, precio=:precio, descripcion=:descripcion, imagen=:imagen WHERE ID=:id');
				$actualizar->bindValue('id',$producto->getId());
				$actualizar->bindValue('nombre',$producto->getNombre());
				$actualizar->bindValue('precio',$producto->getPrecio());
				$actualizar->bindValue('descripcion',$producto->getDescripcion());
				$actualizar->bindValue('imagen',$producto->getImagen());
				$actualizar->execute();
			}catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				exit();
			}
		}
	}
?>