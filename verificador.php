<?php
	include 'global/config.php';
	include 'global/conexion.php';
	include 'carrito.php';
	include 'templates/cabecera.php';
?>
<?php
//Variavle ClienID contiene ClienID de Sandbox
$ClientID="AcovA4k-_hwMN7MDWggOU2lR8JwuZRyPUCV4RyoMLrVqFda9E5I7Z0ok8bByzG8aU7j5zj5URVD9vAis";
//Variavle Secret contiene Secret de Sandbox
$Secret="EGM2Gegk10yJN_Ah0k30HIE37b--p-3rJh_TUXEzTnPnvhmXlUok8_zPLknx0i0Mr-hpovQN4-G2u0EO";
//En la variable Login guardamos un inicio de sesion a la url que esta entre parentesis.
$Login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");
//CURLOPT_RETURNTRANSFER devuelve la informacion que le solicitamos por $Login
curl_setopt($Login, CURLOPT_RETURNTRANSFER, TRUE);
//CURLOPT_USERPWD tiene el Nombre de usuario:Contrasña para ser usada durante la conexion
curl_setopt($Login, CURLOPT_USERPWD, $ClientID.":".$Secret);
//CURLOPT_POSTFIELDS solicita via POST todas las credenciales que utiliza $ClientID
curl_setopt($Login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
//curl_exec ejecuta las instrucciones anteriores y guarda su contenido en la variable Respuesta
$Respuesta=curl_exec($Login);
//Descodificamos el json que nos ha proporcionado al ejecutar para objener un objeto.
$objRespuesta=json_decode($Respuesta);
//Asignamos el token a la variable AccesToken para obtener el token de la venta.
$AccessToken=$objRespuesta->access_token;
//Guardamos en $venta un inicio de sesion a la url que hay entre parentesis
$venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/".$_GET['paymentID']);
//CURLOPT_HTTPHEADER incluye un array en el header
curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$AccessToken));
//CURLOPT_RETURNTRANSFER devuelve la informacion que le solicitamos por $venta
curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);
//curl_exec ejecuta las instrucciones anteriores y guarda su contenido en la variable RespuestaVenta
$RespuestaVenta=curl_exec($venta);
//Transforma en un objeto $RespuestaVenta
$obtDatosTransaccion=json_decode($RespuestaVenta);
//Recorremos el array y guardamos los valores que queremos envariables.
$state = $obtDatosTransaccion->state;
$emai = $obtDatosTransaccion->payer->payer_info->email;
$total = $obtDatosTransaccion->transactions[0]->amount->total;
$currency = $obtDatosTransaccion->transactions[0]->amount->currency;
$custom = $obtDatosTransaccion->transactions[0]->custom;
//Separamos los dos valores ($SID#$IDVENTA) que tiene custom por su caracter delimitador # y lo guardamos en clave
$clave=explode("#", $custom);
$SID = $clave[0];
$claveVenta = openssl_decrypt($clave[1], COD, KEY);
//Cerramos las conexioner curls
curl_close($Login);
curl_close($venta);
//Funcion para comprobar si el pago ha sido aprobado
if ($state=="approved") {
	$mensajePaypal="<h3>PAGO APROBADO</h3>";
	//Actualizamos la tabla tblventas para el pago aprobado
	$sentencia = $pdo->prepare("UPDATE `tblventas` SET `paypalDatos` = :paypalDatos, `status` = 'aprobado' WHERE `tblventas`.`id` = :id");
	$sentencia->bindParam(":id", $claveVenta);
	$sentencia->bindParam(":paypalDatos", $RespuestaVenta);
	$sentencia->execute();
	//Actualizamos la tabla tblventas para el estado completado
	$sentencia = $pdo->prepare("UPDATE `tblventas` SET `status` = 'completo' where `tblventas`.`claveTransaccion` = :Clavet and `tblventas`.`total` = :Total and `tblventas`.`id`= :Id;");
	$sentencia->bindParam(":Clavet", $SID);
	$sentencia->bindParam(":Total", $total);
	$sentencia->bindParam(":Id", $claveVenta);
	$sentencia->execute();
}else{
	$mensajePaypal="<h3>Hay un problema con el pago de paypal</h3>";
}
echo "$mensajePaypal";
?>
<?php
	include 'templates/pie.php';
?>