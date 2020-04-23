<?php
session_start();
$mensaje="";
//Comprobamos si btnComprar esta definido y no es nulo.
if(isset($_POST['btnComprar'])){
    //Con switch declaramos los casos que hara el boton btnComprar dependiendo de su value.
    switch($_POST['btnComprar']){
        //Caso-> Agregar productos de index.php a mostrarCarrito.php.
        case 'Agregar':
            //Desencryptamos los valores que trae el producto.
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                $mensaje.="Ok ID correcto " . $ID . "</br>";
            }else{
                $mensaje.="Uppss.. ID incorrecto " . $ID  . "</br>";
            }
            if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                $mensaje.="Ok nombre " . $NOMBRE  . "</br>";
                }else{
                    $mensaje.="Uppss.. algo paso con el nombre"  . "</br>";
                    break;
                }
                if(is_numeric($_POST['cantidad'])){
                    $CANTIDAD=$_POST['cantidad'];
                    $mensaje.="Ok cantidad " . $CANTIDAD  . "</br>";
                }else{
                    $mensaje.="Uppss.. algo paso con la cantidad"  . "</br>";
                    break;
                }
                if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
                    $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                    $mensaje.="Ok precio " . $PRECIO  . "</br>";
                }else{
                    $mensaje.="Uppss.. algo paso con el precio"  . "</br>";
                    break;
                }
            //Creamos la Session CARRITO y le asignamos el valor 0 en el array.
            if(!isset($_SESSION['CARRITO'])){
                $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO
                );
                $_SESSION['CARRITO'][0]=$producto;
                $mensaje="Producto agregado al carrito";
            }else{
                //Comprobamos que no se selecione el mismo producto dos veces comparando ID.
                $idProductos=array_column($_SESSION['CARRITO'], "ID");
                if(in_array($ID,$idProductos)){
                    echo "<script>alert('El producto ya ha sido seleccionado...')</script>";
                    $mensaje="";
                //Añadimos productos a la Session CARRITO que ha sido creada anteriormente.
                }else{
                    $NumeroProductos=count($_SESSION['CARRITO']);
                    $producto=array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'CANTIDAD'=>$CANTIDAD,
                        'PRECIO'=>$PRECIO
                    );
                    $_SESSION['CARRITO'][$NumeroProductos]=$producto;
                    $mensaje="Producto agregado al carrito";
                }
            }
            $mensaje=print_r($_SESSION,true);
        break;
        //Caso-> Eliminar productos de mostrarCarrito.php.
        case "Eliminar":
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                foreach($_SESSION['CARRITO'] as $indice=>$producto){
                    if($producto['ID'] == $ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado...')</script>";
                    }
                }
            }else{
                $mensaje.="Uppss.. ID incorrecto " . $ID  . "</br>";
            }
        break;
    }
}
?>