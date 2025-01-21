<?php
class class_mysqli
{
	// Variables de conexión
	private $BaseDatos;
	private $Servidor;
	private $Usuario;
	private $Clave;

	// Identificación de errores
	public $Error = "";
	public $Errno = 0;

	// Retorno de conexiones
	private ?mysqli $Conexion_ID = null;
	private ?mysqli_result $Consulta_ID = null;

	// Constructor
	public function __construct($host = "", $user = "", $pass = "", $db = "")
	{
		$this->BaseDatos = $db;
		$this->Servidor = $host;
		$this->Usuario = $user;
		$this->Clave = $pass;
	}

	// Función para conectar a la BD
	public function conectar($host = "", $user = "", $pass = "", $db = "")
	{
		if ($db != "") $this->BaseDatos = $db;
		if ($host != "") $this->Servidor = $host;
		if ($user != "") $this->Usuario = $user;
		if ($pass != "") $this->Clave = $pass;
		$this->Conexion_ID = new mysqli($this->Servidor, $this->Usuario, $this->Clave, $this->BaseDatos);
		if ($this->Conexion_ID->connect_error) {
			$this->Error = "Ha fallado la conexión: " . $this->Conexion_ID->connect_error;
			print $this->Error;
			return null;
		}
		return $this->Conexion_ID;
	}

	// Función para ejecutar una sentencia SQL
	public function consulta($sql = "")
	{
		if ($sql == "") {
			$this->Error = "No hay sentencia SQL";
			print $this->Error;
			return null;
		}
		if (!$this->Conexion_ID) {
			$this->Error = "No hay conexión activa";
			print $this->Error;
			return null;
		}
		$resultado = $this->Conexion_ID->query($sql);
		if ($resultado === false) {
			$this->Error = "Error de sentencia SQL: " . $this->Conexion_ID->error;
			print $this->Error;
			return null;
		}
		$this->Consulta_ID = $resultado instanceof mysqli_result ? $resultado : null;
		return $this->Consulta_ID;
	}

	// Retorna el número de registros de la consulta
	public function numregistros()
	{
		return $this->Consulta_ID ? $this->Consulta_ID->num_rows : 0;
	}

	// Retorna el número de campos de la consulta
	public function numcampos()
	{
		return $this->Consulta_ID ? $this->Consulta_ID->field_count : 0;
	}

	// Muestra el contenido de la consulta SQL en una tabla
	public function verconsultaCrud()
	{
		if ($this->Consulta_ID === null) {
			echo "No hay resultados para mostrar.";
			return;
		}

		echo "<table border=1>";
		echo "<thead>";
		echo "<tr>";
		for ($i = 0; $i < $this->numcampos(); $i++) {
			echo "<td>" . $this->Consulta_ID->fetch_field_direct($i)->name . "</td>";
		}
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($row = $this->Consulta_ID->fetch_array(MYSQLI_NUM)) {
			echo "<tr>";
			for ($i = 0; $i < $this->numcampos(); $i++) {
				echo "<td>" . htmlspecialchars($row[$i]) . "</td>";
			}
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
}
