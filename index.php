<?php
	include 'global/config.php';
	include 'global/conexion.php';
	include 'templates/cabecera.php';
?>
<div class="row">
		<?php
			$sentencia=$pdo->prepare("select * from tblproductos");
			$sentencia->execute();
			$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		?>
		<?php foreach($listaProductos as $producto){ ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-2 mt-2">
					<div class="card">
						<img class="card-img-top" src="<?php echo $producto['imagen'];?>" title="<?php echo $producto['nombre'];?>" alt="<?php echo $producto['nombre'];?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $producto['descripcion'];?>">
						<div class="card-body">
							<span><?php echo $producto['nombre'];?></span>
							<h5 class="card-title"><?php echo $producto['precio'];?> €</h5>
							<p class="card-text">descripcion</p>
							<form action="" method="post">
								<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY) ;?>">
								<input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY);?>">
								<input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY);?>">
								<span>Cantidad:</span>
								<input type="number" name="cantidad" id="cantidad" value="1">
								<button class="btn btn-primary mt-3" name="btnAccion" value="Agregar" type="sumbit">Agregar al carrito</button>
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