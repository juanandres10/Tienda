<?php
	//Comprueba si hay valores en el carrito y lo guarda en  el array de la cookie.
	if (isset($_SESSION['CARRITO'])) {
		//Crea la cookie con el valor de los productos de los usuarios logeados.
		$iTemCad = time() + (60 * 60);
        setcookie('carrito', serialize($_SESSION['CARRITO']), $iTemCad, '/');
	}
	//Destruye la session.
	session_destroy();

	//Borra el contenido de todos los arrays.
	$_SESSION = array();
	//Si esta declarada la cookie session name que devuelve el nombre de la sesion actual borramos la cookie.
	if(isset($_COOKIE[session_name()])) { 
		setcookie(session_name(),'', time() - 42000, '/');
	}
?>