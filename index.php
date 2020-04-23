<?php
	include 'global/config.php';
	include 'global/conexion.php';
	include 'carrito.php';
	include 'templates/cabecera.php';
?>
	<div class="alert alert-primary mt-2">
		<?php echo $mensaje;?>
		<a href="#" class="badge badge-primary"> Ver carrito</a>
	</div>
	<div class="row">
		<?php
		//Hacemos una consulta a la tabla productos y lo guardamos en un array.
			$sentencia=$pdo->prepare("select * from tblproductos");
			$sentencia->execute();
			$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		?>
		<?php foreach($listaProductos as $producto){
		//Aqui comenzamos un bucle foreach para recorrer el array de los productos que  usaremos para mostrar todos los productos. ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-2">
					<div class="card">
						<img class="card-img-top" src="<?php echo $producto['imagen'];?>" title="<?php echo $producto['nombre'];?>" alt="<?php echo $producto['nombre'];?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $producto['descripcion'];?>">
						<div class="card-body">
							<span><?php echo $producto['nombre'];?></span>
							<h5 class="card-title mt-2"><?php echo $producto['precio'];?> €</h5>
							<form action="" method="post">
								<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY) ;?>">
								<input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY);?>">
								<input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY);?>">
								<label>Unidades:</label>
								<input type="number" name="cantidad" id="cantidad" value="<?php echo 1; ?>">
								<br>
								<button class="btn btn-primary mt-3" name="btnComprar" value="Agregar" type="sumbit">COMPRAR</button>
							</form>
						</div>
					</div>
				</div>
		<?php } ?>

		</div>
<script>
	$(function () {
  		$('[data-toggle="popover"]').popover()
	});
</script>
<?php
	include 'templates/pie.php';
?>