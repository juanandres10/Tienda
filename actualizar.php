<?php
//incluye la clase producto y CrudProducto
	require_once('crud_producto.php');
	require_once('producto.php');
	$crud= new CrudProducto();
	$producto=new Producto();
	//busca el producto utilizando el id, que es enviado por GET desde la vista mostrar.php
	$producto=$crud->obtenerProducto($_GET['id']);
?>
<html>
<head>
	<title>Actualizar Prdocuto</title>
</head>
<body>
	<form action='administrar_producto.php' method='post'>
	<table>
		<tr>
			<input type='hidden' name='id' value='<?php echo $producto->getId()?>'>
			<td>Nombre:</td>
			<td> <input type='text' name='nombre' value='<?php echo $producto->getNombre()?>'></td>
		</tr>
		<tr>
			<td>Precio:</td>
			<td><input type='number' name='precio' step="0.01" value='<?php echo $producto->getPrecio()?>' ></td>
		</tr>
		<tr>
			<td>Descripcion:</td>
			<td><input type='text' name='descripcion' value='<?php echo $producto->getDescripcion()?>' ></td>
		</tr>
		<tr>
			<td>Imagen:</td>
			<td><input type='text' name='imagen' value='<?php echo $producto->getImagen()?>' ></td>
		</tr>
		<input type='hidden' name='actualizar' value='actualizar'>
	</table>
	<input type='submit' value='Guardar'>
	<a href="index.php">Volver</a>
</form>
</body>
</html>