<?php
// incluye la clase Db
include 'global/config.php';
require_once('global/conexion.php');
session_start();
	try {
		$datos = $pdo->query('SELECT * FROM tblproductos');
?>
<?php
	include 'templates/cabecera.php';
?>	
	<h1 class="text-center">Ingresar producto</h1>
		<div class="row bg-success">
			<nav class="navbar navbar-dark">
				<div class="col">
					<a class="nav-link text-white" href="administracion.php">Inicio</a>
				</div>
				<div class="col">
					<a class="nav-link text-white" href="mostrar.php">Listar</a>
				</div>
			</nav>
		</div>
		<table class="table table-striped">
  				<thead>
				    <tr>
				      	<th scope="col">ID</th>
						<th scope="col">Nombre</th>
						<th scope="col">Precio</th>
						<th scope="col">Descripción</th>
						<th scope="col">Imagen</th>
				    </tr>
				</thead>
				<tbody>
    					<?php
								foreach($datos as $row){
						?>
						<tr>
							<td><?php
								echo $row["0"];
							?></td>
							<td><?php
								echo $row["1"];
							?></td>
							<td><?php
								echo $row["2"];
							?></td>
							<td><?php
								echo $row["3"];
							?></td>
							<td><img src="<?php echo $row['4'];?>" width="100px" height="100px"></td>
						</tr>
						<?php		
								}
							} catch (PDOException $e) {
					    		print "¡Error!: " . $e->getMessage() . "<br/>";
					    		exit();
					    	}
						?>
    				</tr>
    			</tbody>				
			</table>
		<form action='administrar_producto.php' method='post'>
			<div class="form-group row mt-3">
		  		<label for="nombre" class="mb-2 mr-sm-2">Nombre:</label>
		  		<div class="col-8">
		  			<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Nombre del producto" name="nombre">
		  		</div>  
		    </div>
		    <div class="form-group row">
		  		<label for="nombre" class="mb-2 mr-sm-2">Precio:</label>
		  		<div class="col-8">
		  			<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Precio del producto" step="0.01" name="precio">
		  		</div>  
		    </div>
		    <div class="form-group row mt-3">
		  		<label for="nombre" class="mb-2 mr-sm-2">Descripcion:</label>
		  		<div class="col-8">
		  			<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Descripcion del producto" name="descripcion">
		  		</div>  
		    </div>
		    <div class="form-group row">
		  		<label for="nombre" class="mb-2 mr-sm-2">Imagen:</label>
		  		<div class="col-8">
		  			<input type="file" class="form-control mb-2 mr-sm-2" placeholder="Imagen del producto" name="imagen">
		  			<input class="btn btn-primary" type="submit" name="boton" value="Guardar">
		  		</div>  
		    </div>
		    <input type='hidden' name='insertar' value='insertar'>
		</form>
<?php
	include 'templates/pie.php';
?>