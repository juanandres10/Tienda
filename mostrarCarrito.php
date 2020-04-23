<?php
	include 'global/config.php';
	include 'carrito.php';
	include 'templates/cabecera.php';
?>

<br>
<h3>Lista del carrito</h3>
<?php if(!empty($_SESSION['CARRITO'])) { ?>

<table class="table">
    <tbody>
        <tr class="table-dark">
            <th width="40%">Descripción</th>
            <th width="15%" class="text-center">Cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%" class="text-center">--</th>
        </tr>
        <?php $total=0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){
        //Aqui comenzamos un bucle foreach para recorrer el array de la sesion carrito que contiene los productos que hemos seleccionado.?>
        <tr>
            <td width="40%"><?php echo $producto['NOMBRE'] ?></td>
            <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
            <td width="20%" class="text-center"><?php echo $producto['PRECIO'] ?> €</td>
            <td width="20%" class="text-center"><?php echo number_format($producto['CANTIDAD'] * $producto['PRECIO'],2);?> €</td>
            <td width="5%" class="text-center">
                <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY) ;?>">
                    <button class="btn btn-danger" type="submit" name="btnComprar" value="Eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php $total=$total + ($producto['CANTIDAD'] * $producto['PRECIO']);
        //Creamos la variable total que contendra el valor total que el cliente tendra que pagar.?>
        <?php } ?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3><?php echo number_format($total,2); ?> €</h3></td>
            <td></td>
        </tr>
            <td colspan="5">
                <form action="pagar.php" method="post">
                    <div class="alert alert-primary" role="alert">
                        <div class="form-group">
                            <label for="my-input">Correo de contacto:</label>
                            <input id="email" name="email" class="form-control" type="email" placeholder="Por favor escribe tú correo" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">
                            Los productos se enviarán a este correo.
                        </small>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion" value="proceder">Proceder a pagar >></button>
                </form>
            </td>
        <tr>
        </tr>
    </tbody>
</table>
<?php }else{ ?>

<div class="alert alert-primary">
    No hay productos en el carrito...
</div>

<?php } ?>

<?php
	include 'templates/pie.php';
?>