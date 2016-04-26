<?php  
	class Alumno
	{
		public $_apellido;
		public $_nombre;
		public $_legajo;
		public $_foto;

		function __construct($apellido, $nombre, $legajo, $foto)
		{
			$this->_apellido = $apellido;
			$this->_nombre = $nombre;
			$this->_legajo = $legajo;
			$this->_foto = $foto;
		}

		public function Guardar() //retorna bool, hacer validacion
		{
			$linea = $this->_apellido." - ".$this->_nombre." - ".$this->_legajo." - ".$this->_foto."\n";
			$archivoAlumnos = fopen("Archivos/alumnos.txt", "a");
			fwrite($archivoAlumnos, $linea);
			fclose($archivoAlumnos);
		}

		public static function GuardarBackup($alumno) //retorna bool, hacer validacion
		{
			$linea = $alumno->_apellido." - ".$alumno->_nombre." - ".$alumno->_legajo." - ".$alumno->_foto." - Delete"."\n";
			$archivoAlumnos = fopen("ArchivosBackup/backupAlumnos.txt", "a");
			fwrite($archivoAlumnos, $linea);
			fclose($archivoAlumnos);
		}

		public static function Modificar($alumno) //retorna bool, hacer validacion
		{
			Alumno::Borrar($alumno);
			$alumno->Guardar();
  
		}

		public static function Borrar($objAlumno) //retorna bool, hacer validacion
		{
			$arrayAlumnos = Alumno::TraerTodos();
			//$alumnoABorrar = $objAlumno->TraerAlumno($objAlumno->_legajo); //validar q $alumnoABorrar no sea null
			unlink("Archivos/alumnos.txt"); //elimina el archivo
			foreach ($arrayAlumnos as $alumno)
			{
				if ($alumno->_legajo != $objAlumno->_legajo) 
				{
					$alumno->Guardar(); //guardo todos menos el alumno a borrar
				}
			}
		}

		public static function TraerTodos() //retorna array de todos los alumnos
		{
			$arrayAlumnos = array();

			$archivoAlumnos = fopen("Archivos/alumnos.txt", "r");
			while (!feof($archivoAlumnos))
			{
				  $linea = fgets($archivoAlumnos); //retorna una linea del archivoAlumnos
	              $alumno = explode(" - ", $linea); //$alumno[0]: Apellido - $alumno[1]: Nombre - $alumno[2]: Legajo - $alumno[3]: Foto 
	              $alumno[0] = trim($alumno[0]); 
	              if ($alumno[0] != "")
	              {
	              	 $objAlumno = new Alumno($alumno[0], $alumno[1], $alumno[2], $alumno[3]);
	              	 $arrayAlumnos[] = $objAlumno;
	              }
	         }
	        fclose($archivoAlumnos);
	        return $arrayAlumnos;      
		}

		// public function TraerAlumno($legajo) //retorna alumno
		// {
		// 	$archivoAlumnos = fopen("Archivos/alumnos.txt", "r");
		// 	while (!feof($archivoAlumnos))
		// 	{
		// 		  $linea = fgets($archivoAlumnos); //retorna una linea del archivoAlumnos
	 //              $alumno = explode(" - ", $linea); //$alumno[0]: Apellido - $alumno[1]: Nombre - $alumno[2]: Legajo - $alumno[3]: Foto 
	 //              $alumno[2] = trim($alumno[2]); 
	 //              if($alumno[2] == $legajo)
	 //              {
	 //              	  $objAlumno = new Alumno($alumno[0], $alumno[1], $alumno[2], $alumno[3]);
	 //              	  break;
	 //              }
		// 	}
		// 	fclose($archivoAlumnos);
	 //        return $objAlumno;
		// }

		public static function CrearTablaAlumnos()
	    {
	        if(file_exists("Archivos/alumnos.txt"))
	        {
	        	$arrayAlumnos = Alumno::TraerTodos();
	            $cadena = " <table border=1><th> Apellido </th><th> Nombre </th><th> Legajo </th><th> Foto </th>";
	            foreach ($arrayAlumnos as $alumno)
	            {
	            	$cadena = $cadena . "<tr><td>".$alumno->_apellido."</td><td>".$alumno->_nombre."</td><td>".$alumno->_legajo."</td><td><img width=50px height=60px src=Fotos/".$alumno->_foto."></img></td></tr>";
	            }
	            $cadena = $cadena . " </table>";
	            $archivoTablaAlumnos = fopen("Archivos/tablaAlumnos.php", "w"); //escritura, si existe lo borra
	            fwrite($archivoTablaAlumnos, $cadena);
	            fclose($archivoTablaAlumnos);
	        }   

	        else
	        {
	            $cadena = "No hay alumnos ingresados";
	            $archivoTablaAlumnos = fopen("Archivos/tablaAlumnos.php", "w");
	            fwrite($archivoTablaAlumnos, $cadena);
	            fclose($archivoTablaAlumnos);
	        }
	    }
	}
?>