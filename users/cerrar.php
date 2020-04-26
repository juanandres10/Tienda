<?php
	
	if (isset($_SESSION['CARRITO'])) {
		$iTemCad = time() + (60 * 60);
        setcookie('carrito', serialize($_SESSION['CARRITO']), $iTemCad, '/');
	}
	session_destroy();

	$_SESSION = array();
	if(isset($_COOKIE[session_name()])) { 
		setcookie(session_name(),'', time() - 42000, '/');
	}
?>