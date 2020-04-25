<?php
	include 'global/config.php';
	include 'global/conexion.php';
	include 'carrito.php';
	include 'templates/cabecera.php';
?>

<?php
	//Definimos que pasara cuando alguien pulse el boton de proceder pago.
    if($_POST){
        $total=0;
        $SID=session_id();
        //Recorremos la session carrito para sacar el total de precio * cantidad.
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $total=$total+($producto['PRECIO'] * $producto['CANTIDAD']);
        }
        //Preparamos una sentencia para guardar los registros de la venta en la tabla tblventas.
        $sentencia=$pdo->prepare("insert into tblventas (id, claveTransaccion, paypalDatos, fecha, total, status) values (NULL, :ClaveTransaccion, '', NOW(), :Total, 'pendiente');");
        $sentencia->bindParam(":ClaveTransaccion", $SID);
        $sentencia->bindParam(":Total", $total);
        $sentencia->execute();
        $idVenta=$pdo->lastInsertId();
        //Recorremos con un bucle for la session carrito para sacar el id, precio y cantidad de los productos.
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $sentencia=$pdo->prepare("insert into tbldetalleventa (id, idVenta, idProducto, idUsuario, precio, cantidad) values (NULL, :IDVENTA, :IDPRODUCTO, :IDUSUARIO, :PRECIO, :CANTIDAD);");
            $sentencia->bindParam(":IDVENTA", $idVenta);
            $sentencia->bindParam(":IDPRODUCTO", $producto['ID']);
            $sentencia->bindParam(":IDUSUARIO", $_SESSION['id']);
            $sentencia->bindParam(":PRECIO", $producto['PRECIO']);
            $sentencia->bindParam(":CANTIDAD", $producto['CANTIDAD']);
            $sentencia->execute();
        }
    }
?>
<div class="jumbotron text-center mt-4">
    <h1 class="display-4">¡ Paso Final !</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con paypal la cantidad de: 
        <h4><?php echo number_format($total,2); ?> €</h4>
    </p>
    <p>Los productos podran ser descargados una vez que se procese el pago<br>
        <strong>(Para aclaraciones :juanandresruizhernandez10@gmail.com)</strong>
    </p>
</div>
<!-- Script que oculta el boton de cerrar session -->
<script>
	$(function(){
		$("form button").eq(0).hide();
	});
</script>
<?php
	include 'templates/pie.php';
?>