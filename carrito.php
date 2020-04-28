<?php
session_start();
$mensaje="";
if ($_POST) {
    //Comprobamos si btnComprar esta definido y no es nulo.
    if (isset($_POST['btnComprar'])) {
        //Comprobamos la opcion agregar
        if ($_POST['btnComprar'] == 'Agregar') {
            //Desencriptamos los valores de los productos
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
            }
            if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
            }
            if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
                $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
            
            }if (isset($_POST['cantidad'])) {
                $CANTIDAD=$_POST['cantidad'];
            }
            //Comprobamos si hemos iniciado sesion
            if(isset($_SESSION['tipo'])){
                //Comprobamos si se ha creado la session carrito
                if(!isset($_SESSION['CARRITO'])){
                    //En caso de no estar creada la copiamos nosotros
                    $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO,
                    );
                    $_SESSION['CARRITO'][0]=$producto;
                    $mensaje="Producto agregado al carrito";
                }else{
                    //si ya estaba creado el carrito comprobamos si el producto ya estaba en el carro
                    $idProductos=array_column($_SESSION['CARRITO'],"ID");
                    if(in_array($ID,$idProductos)){
                        foreach($_SESSION['CARRITO'] as $indice => $producto){
                            if($producto['ID']==$ID){
                                //Sumamos a la cantidad que teniamos la nueva cantidad
                                $CANTIDADNUEVA = $CANTIDAD + $producto['CANTIDAD'];
                                $producto=array(
                                    'ID'=>$ID,
                                    'NOMBRE'=>$NOMBRE,
                                    'CANTIDAD'=>$CANTIDADNUEVA,
                                    'PRECIO'=>$PRECIO,
                                );
                                //Sobrescribimos la cantidad creando un array nuevo el cual tendra la nueva cantidad.
                                $_SESSION['CARRITO'][$indice]=$producto;
                                $mensaje = "Has añadido ".$CANTIDAD." unidades mas de ". $producto['NOMBRE']." a tu carrito";
                            }
                        }
                    }else{
                        //Añadimos productos al array de carrito ya creado.
                        $numeroProductos=count($_SESSION['CARRITO']);
                        $producto=array(
                            'ID'=>$ID,
                            'NOMBRE'=>$NOMBRE,
                            'CANTIDAD'=>$CANTIDAD,
                            'PRECIO'=>$PRECIO,
                        );
                        $_SESSION['CARRITO'][$numeroProductos]=$producto;
                        $mensaje="Producto agregado al carrito";
                    };
                }
            }else{
                //Si es un visitante comprobamos si está vacio el carrito de la cookies
                echo "Este es el de cookies";
                if (empty($_COOKIE['carrito'])) {
                    //Si esta vacio la clase cookie la creamos
                    $aCarrito=array();
                    $aCarrito[0]=array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'CANTIDAD'=>$CANTIDAD,
                        'PRECIO'=>$PRECIO
                    );
                
                    setcookie('carrito',serialize($aCarrito),time()+30000,"/");
        
                }else{
                    //Comprobamos si el producto esta en el carrito de la cookie
                    $aCarrito=unserialize($_COOKIE['carrito'],["allowed_classes" => true]);
                    setcookie('carrito',serialize($aCarrito),time()-30000,"/");
                    $idProductos=array_column($aCarrito,"ID");
                    if(in_array($ID,$idProductos)){
                        foreach($aCarrito as $indice => $producto){
                            if($producto['ID']==$ID){
                                //Sumamos a la cantidad que teniamos la nueva cantidad
                                $CANTIDADNUEVA = $CANTIDAD + $producto['CANTIDAD'];
                                $producto=array(
                                    'ID'=>$ID,
                                    'NOMBRE'=>$NOMBRE,
                                    'CANTIDAD'=>$CANTIDADNUEVA,
                                    'PRECIO'=>$PRECIO,
                                );
                                //Sobrescribimos la cantidad creando un array nuevo el cual tendra la nueva cantidad.
                                $aCarrito[$indice]=$producto;
                                setcookie('carrito',serialize($aCarrito),time()-30000,"/");
                                $mensaje = "Has añadido ".$CANTIDAD." unidades mas de ". $producto['NOMBRE']." a tu carrito";
                            }
                        }
                    }else{
                        //Agregamos productos al array cookie carrito ya creado.
                        $numeroProductos=count($aCarrito);
                        $aCarrito[$numeroProductos]=array(
                            'ID'=>$ID,
                            'NOMBRE'=>$NOMBRE,
                            'CANTIDAD'=>$CANTIDAD,
                            'PRECIO'=>$PRECIO,
                        );
                    
                        setcookie('carrito',serialize($aCarrito),time()+30000,"/");
                        $mensaje="Producto agregado al carrito"; 
                    };
                
                }
            }        
        }

        //comprobamos si la opcion es eliminar
        if ($_POST['btnComprar'] == 'Eliminar') {
            //desencriptamos la id del producto a eliminar
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
            }
            //Comprobamos si hay una sesion ya iniciada
            if (isset($_SESSION['tipo'])) {
                //Si encuentra una sesion busca por id y lo borra
                foreach($_SESSION['CARRITO'] as $indice => $producto){
                    if($producto['ID']==$ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado...')</script>";
                    }
                }
            }else{
                //Borra por id en la cookie carrito
                $aCarrito=unserialize($_COOKIE['carrito'],["allowed_classes" => true]);
                setcookie('carrito',serialize($aCarrito),time()-30000,"/");
                //se busca el prodcuto en la variable y se borra
                foreach($aCarrito as $indice => $producto){
                    if($producto['ID']==$ID){
                        unset($aCarrito[$indice]);
                        echo "<script>alert('Elemento borrado sin conexion...')</script>";
                    }
                }
                //si el carrito cookie tiene algo volvemos a crear la cookie
                if (!empty($aCarrito)) {
                    setcookie('carrito',serialize($aCarrito),time()+30000,"/");
                }   
            }
        }
    }   
}

?>