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
        <div id="paypal-button"></div>
    </p>
    <p>La factura sera mostrada al finalizar el pago.<br>
        <strong>(Para aclaraciones :juanandresruizhernandez10@gmail.com)</strong>
    </p>
</div>


    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
              sandbox: 'AcovA4k-_hwMN7MDWggOU2lR8JwuZRyPUCV4RyoMLrVqFda9E5I7Z0ok8bByzG8aU7j5zj5URVD9vAis',
              production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'es_ES',
            style: {
              size: 'small',
              color: 'black',
              shape: 'pill',
            },
            // Set up a payment
            payment: function(data, actions) {
              return actions.payment.create({
                transactions: [{
                  amount: {
                    total: '<?php echo $total; ?>',
                    currency: 'EUR'
                  }
                }]
              });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
              return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                window.alert('Gracias por su comprar');
              });
            }
          }, '#paypal-button');
    </script>

<!-- Script que oculta el boton de cerrar session -->
<script>
	$(function(){
		$("form button").eq(0).hide();
	});
</script>
<?php
	include 'templates/pie.php';
?>