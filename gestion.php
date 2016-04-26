
<?php  
	require_once 'Alumno.php';

	$apellido = $_POST['txtApellido'];
	$nombre = $_POST['txtNombre'];
	$legajo = $_POST['numLegajo'];
	$foto = $_FILES['fileFoto']['name'];
	$boton = $_POST['btn'];

	//validar foto


		$nomYExt = explode(".", $foto);
		$pathFoto = $apellido."_".$nombre."_".$legajo.".".$nomYExt[1];
		move_uploaded_file($_FILES['fileFoto']['tmp_name'], "Fotos/$pathFoto");


	$alumno = new Alumno($apellido, $nombre, $legajo, $pathFoto); 

	if ($boton == "Ingresar Alumno") 
	{

			$alumno->Guardar();
		
	}

	else if ($boton == "Borrar Alumno") 
	{
		$fecharAhora=date("Y_m_d H_i_s"); 
		Alumno::GuardarBackup($alumno);
		Alumno::Borrar($alumno);
		print_r("ArchivosBackup/FotosBackup/$fecharAhora"."_delete_"."$pathFoto");
		copy("Fotos/$pathFoto", "ArchivosBackup/FotosBackup/$fecharAhora"."_delete_"."$pathFoto");
		unlink("Fotos/$pathFoto");		
	}

	else 
	{
		$fecharAhora=date("Y_m_d H_i_s");
		$backupalumno=Alumno::Modificar($alumno);
		print_r("ArchivosBackup/FotosBackup/$fecharAhora"."_update_"."$pathFoto");
	 	copy("Fotos/$pathFoto", "ArchivosBackup/FotosBackup/$fecharAhora"."_update_"."$pathFoto");

	}

	header("location:index.php");
?>