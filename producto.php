<?php
	class Producto{
		private $id;
		private $nombre;
		private $precio;
		private $descripcion;
		private $imagen;
 
		function __construct(){}
 
		public function getNombre(){
		return $this->nombre;
		}
 
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
 
		public function getPrecio(){
			return $this->precio;
		}
 
		public function setPrecio($precio){
			$this->precio = $precio;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
 
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getImagen(){
			return $this->imagen;
		}
 
		public function setImagen($imagen){
			$this->imagen = $imagen;
		}
 
		public function getId(){
			return $this->id;
		}
 
		public function setId($id){
			$this->id = $id;
		}
	}
?>