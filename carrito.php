<?php
session_start();
$mensaje="";
if ($_POST) {
    //Comprobamos si btnComprar esta definido y no es nulo.
    if (isset($_POST['btnComprar'])) {
        //comprobamos si la opcion es agregar
        if ($_POST['btnComprar'] == 'Agregar') {
            //desencriptamos los valores de los productos
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
            //comprobamos si hemos iniciado sesion
            if(isset($_SESSION['tipo'])){
                //comprobamos si se ha creado el carrito de sesion
                if(!isset($_SESSION['CARRITO'])){
                    //si no se ha creado creamos el carrito añadiendo el producto
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
                        //si el producto ya estaba en el carrito aumentamos la cantidad de ese producto
                        echo "<script>alert('El producto ya ha sido seleccionado...')</script>";
                        $mensaje="";
                    }else{
                        //si no estaba en el carrito añadimos el producto en su lugar
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
                //si no habia iniciado sesion comprobamos si está vacio el carrito de la cookies
                echo "Este es el de cookies";
                if (empty($_COOKIE['carrito'])) {
                    //si está vacio añadimos el producto en un array y creamos la cookie con ese array
                    $aCarrito=array();
                    $aCarrito[0]=array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'CANTIDAD'=>$CANTIDAD,
                        'PRECIO'=>$PRECIO
                    );
                
                    setcookie('carrito',serialize($aCarrito),time()+30000,"/");
        
                }else{
                    //si no estaba vacio comprobamos si el producto ya estaba en el carrito
                    //para ello guardamos el contenido de la cookie en la variable y aCarrito y borramos la cookie
                    $aCarrito=unserialize($_COOKIE['carrito'],["allowed_classes" => true]);
                    setcookie('carrito',serialize($aCarrito),time()-30000,"/");
                    $idProductos=array_column($aCarrito,"ID");
                    if(in_array($ID,$idProductos)){
                        echo "<script>alert('El producto ya ha sido seleccionado...')</script>";
                        $mensaje="";
                    }else{
                        //si el producto no estaba en el carrito añadimos el producto en el array y volvemos a crear la cookie
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

        //comprobamos si la opcion es agregar
        if ($_POST['btnComprar'] == 'Eliminar') {
            //desencriptamos la id del producto a eliminar
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
            }
            //se comprueba si ha iniciado sesion
            if (isset($_SESSION['tipo'])) {
                //si ha iniciado se busca el producto con el id en la variable de sesion carrito  y se borra
                foreach($_SESSION['CARRITO'] as $indice => $producto){
                    if($producto['ID']==$ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado...')</script>";
                    }
                }
            }else{
                //si no se ha iniciado sesion se guarda el contenido de la cookie carrito en una variable y se borra la cookie
                $aCarrito=unserialize($_COOKIE['carrito'],["allowed_classes" => true]);
                setcookie('carrito',serialize($aCarrito),time()-30000,"/");
                //se busca el prodcuto en la variable y se borra
                foreach($aCarrito as $indice => $producto){
                    if($producto['ID']==$ID){
                        unset($aCarrito[$indice]);
                        echo "<script>alert('Elemento borrado sin conexion...')</script>";
                    }
                }
                //si la variable no queda vacia se vuelve a crear la cookie carrito
                if (!empty($aCarrito)) {
                    setcookie('carrito',serialize($aCarrito),time()+30000,"/");
                }   
            }
        }
    }   
}

?>