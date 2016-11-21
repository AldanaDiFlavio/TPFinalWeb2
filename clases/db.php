<?php
	require_once "config.php";

	class BaseDatos {
		public $conexion;
		protected $bd;

		public function conectar(){
			$this->conexion = mysqli_connect(HOST, USER, PASS, DBNAME) or die("No se ha podido conectar a la base de datos.");
			return true;
		}

		public function desconectar(){
			if($this->conexion){
				mysqli_close($this->conexion);
			}
		}

	}
?>