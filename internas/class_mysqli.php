<?php 
class class_mysqli{
	
	//Primera parte: Declaración de variables y constructor
	//Variables de conexión
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;

	//Identificación de errores
	var $Error="";
	var $Errno=0;

	//Retorno de conexiones
	var $Conexion_ID=0;
	var $Consulta_ID=0;

	//Constructor
	public function __construct($host="", $user="", $pass="", $db=""){
		$this->BaseDatos=$db;
		$this->Servidor=$host;
		$this->Usuario=$user;
		$this->Clave=$pass;
	}

	//Segunda parte: Conexión a la BD usando POO
	//Función para conectar a la BD
	function conectar($host, $user, $pass, $db){
		if($db != "")$this->BaseDatos=$db;
		if($host != "")$this->Servidor=$host;
		if($user != "")$this->Usuario=$user;
		if($pass != "")$this->Clave=$pass;
		$this->Conexion_ID = new mysqli($this->Servidor, $this->Usuario, $this->Clave, $this->BaseDatos);
		if (!$this->Conexion_ID) {
			$this->Error="Ha fallado la conexion...";
			print $this->Error;
			return 0;
		}
		return $this->Conexion_ID;
	}

	//Tercera parte: Gestión de las consultas SQL, creación de tablas en HTML, etc.
	//Función para ejecutar una sentencia SQL
	function consulta($sql=""){
		if ($sql=="") {
			$this->Error="No hay sentencia SQL";
			print $this->Error;
			return 0;
		}
		$this->Consulta_ID=mysqli_query($this->Conexion_ID, $sql);
		if (!$this->Consulta_ID) {
			$this->Error="Error de sentencia SQL";
			print $this->Error;
			return 0;
		}
		return $this->Consulta_ID;
	}

	//Retorna el número de campos de la consulta
	function numregistros(){
		return mysqli_num_rows($this->Consulta_ID);
	}
	function numcampos(){
		return mysqli_num_fields($this->Consulta_ID);
	}
	
	//Muestra el contenido de la consulta SQL en una tabla
	function verconsultaCrud(){
		echo "<table border=1>";
		echo "<thead>";
		echo "<tr>";
		for ($i=0; $i < $this->numcampos(); $i++) { 
			echo "<td>".mysqli_fetch_field_direct($this->Consulta_ID, $i)->name."</td>";
		}
		
		echo "</tr>";
		echo "</thead>";
		while ($row=mysqli_fetch_array($this->Consulta_ID)) {
			echo "<tr>";
			for ($i=0; $i < $this->numcampos(); $i++) { 
				echo "<td>".$row[$i]."</td>";
			}
			
			echo "</tr>";
		}
		echo "</table>";
	}
}
?>