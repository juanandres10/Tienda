<?php
//incluye la clase Producto y CrudProducto
session_start();
require_once('crud_producto.php');
require_once('producto.php');
$crud= new CrudProducto();
$producto=new Producto();
//obtiene todos los productos con el método mostrar de la clase crud
$listaProductos=$crud->mostrar();
?>
<?php
	include 'templates/cabecera.php';
?>	
		<div class="row bg-success mt-2 mb-2">
			<nav class="navbar navbar-dark">
				<div class="col">
					<a class="nav-link text-white" href="administracion.php">Inicio</a>
				</div>
				<div class="col">
					<a class="nav-link text-white" href="ingresar.php">Insertar</a>
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
						<th scope="col">Actualizar</th>
						<th scope="col">Eliminar</th>
				    </tr>
				</thead>
				<tbody>
    					<?php foreach ($listaProductos as $producto) {?>
						<tr>
							<td><?php echo $producto->getId() ?></td>
							<td><?php echo $producto->getNombre() ?></td>
							<td><?php echo $producto->getPrecio() ?></td>
							<td><?php echo $producto->getDescripcion() ?></td>
							<td><img src="<?php echo $producto->getImagen() ?>" width="100px" height="100px"></td>
							<td><a href="actualizar.php?id=<?php echo $producto->getId()?>&accion=a">Actualizar</a></td>
							<td><a href="administrar_producto.php?id=<?php echo $producto->getId()?>&accion=e">Eliminar</a></td>
						</tr>
					<?php }?>
    			</tbody>				
			</table>
<?php
	include 'templates/pie.php';
?>