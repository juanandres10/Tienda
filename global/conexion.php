<?php
$servidor="mysql:dbname=".BD.";host=".SERVIDOR;

// Si conecta con el servidor.
try{
    $pdo=new PDO($servidor,USUARIO,PASSWORD,
    array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
    );
// Si no conecta con el servidor.
}catch(PDOException $e){
	print "¡Error!: " . $e->getMessage() . "<br/>";
	exit();
}
?>