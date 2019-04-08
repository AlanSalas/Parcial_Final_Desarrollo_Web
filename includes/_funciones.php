<?php
require_once("con_db.php");
//Recibir variable post
	switch ($_POST["accion"]) {
	//USUARIOS
		case 'login':
			login();
			break;
		case 'consultar_usuarios':
			consultar_usuarios();
			break;
		case 'insertar_usuarios':
			insertar_usuarios();
			break;
		case 'eliminar_usuarios';
			eliminar_usuarios($_POST['id']);
			break;
		case 'editar_usuarios':
			editar_usuarios();
			break;
		case 'consultar_registro_usuarios':
			consultar_registro_usuarios($_POST['id']);
			break;
		case 'carga_foto':
			carga_foto();
			break;
	//SERVICES
		case 'consultar_services':
			consultar_services();
		break;
		case 'insertar_services':
			insertar_services();
		break;
		case 'eliminar_services';
			eliminar_services($_POST['id']);
			break;
		case 'consultar_registro_services':
			consultar_registro_services($_POST['id']);
			break;
		case 'editar_services':
			editar_services();
			break;
	//SKILLS
		case 'consultar_skills':
			consultar_skills();
		break;
		case 'insertar_skills':
			insertar_skills();
		break;
		case 'eliminar_skills';
			eliminar_skills($_POST['id']);
		break;
		case 'consultar_registro_skills':
			consultar_registro_skills($_POST['id']);
		break;
		case 'editar_skills':
			editar_skills();
		break;				
		default:
			# code...
			break;
	}
    //------------------------------FUNCIONES MODULO USUARIOS------------------------------//
    //------------------------------FUNCION PARA VALIDAR LOGIN-----------------------------//
	function login(){
		//echo "Tu usuario es: ".$_POST["usuario"]. ", Tu contraseña es: ".$_POST["password"];
		//Conectar a la BD
		global $mysqli;
		$email = $_POST["usuario"];
		$pass = $_POST["password"];
		//Si el usuario y pass están vacios imprimir 3
		if (empty($email) && empty($pass)) {
			echo "3";
		//Si no están vacios consultar a la bd que el usuario exista.
		}else {
			$sql = "SELECT * FROM usuarios WHERE correo_usr = '$email'";
			$rsl = $mysqli->query($sql);
			$row = $rsl->fetch_assoc();
			//Si el usuario no existe, imprimir 2
			if ($row == 0) {
				echo "2";
			//Si hay resultados verificar datos
			}else{
				$sql = "SELECT * FROM usuarios WHERE correo_usr = '$email' AND password_usr = '$pass'";
				$rsl = $mysqli->query($sql);
				$row = $rsl->fetch_assoc();
				//Si el password no es correcto, imprimir 0
				if ($row["password_usr"] != $pass) {
					echo "0";
				//Si el usuario es correcto, imprimir 1
				}elseif ($email == $row["correo_usr"] && $pass == $row["password_usr"]) {
					echo "1";
					session_start();
					error_reporting(0);
					$_SESSION['usuario'] = $email;
				}
			}
		} 	
	}
	//------------------------------FUNCION PARA CONSULTAR REGISTROS-----------------------------//
	function consultar_usuarios(){
		//Conectar a la BD
		global $mysqli;
		//Realizar consulta
		$sql = "SELECT * FROM usuarios";
		$rsl = $mysqli->query($sql);
		$array = [];
		while ($row = mysqli_fetch_array($rsl)) {
			array_push($array, $row);
		}
		echo json_encode($array); //Imprime Json encodeado		
	}
	//------------------------------FUNCION PARA INSERTAR USUARIOS-----------------------------//
	function insertar_usuarios(){
		//Conectar a la bd
		global $mysqli;
		$nombre = $_POST['nombre_usr'];
		$correo = $_POST['correo_usr'];
		$img_usr = $_POST['img_usr'];
		$telefono = $_POST['telefono_usr'];
		$pass = $_POST['password_usr'];
		$expresion = '/^[9|9|5][0-10]{8}$/';
		//Validacion de campos vacios
		if (empty($nombre) && empty($correo) && empty($telefono) && empty($pass)) {
			echo "0";
		}elseif (empty($nombre)) {
			echo "2";
		}elseif (empty($correo)) {
			echo "3";
		}elseif ($correo != filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			echo "4";
		}elseif (empty($img_usr)) {
			echo "10";
		}elseif (empty($telefono)) {
			echo "5";
		}elseif (preg_match($expresion, $telefono)) {
			echo "6";
		}elseif (empty($pass)) {
			echo "7";
		}else{
			$sql = "INSERT INTO usuarios VALUES('', '$nombre', '$correo', '$img_usr', '$pass', '$telefono', 1)";
			$rsl = $mysqli->query($sql);
			echo "1";
		}
	}
	//------------------------------FUNCION PARA ELIMINAR USUARIOS-----------------------------//
	function eliminar_usuarios($id){
		global $mysqli;
		$sql = "DELETE FROM usuarios WHERE id_usr = $id";
		$rsl = $mysqli->query($sql);
		if ($rsl) {
			echo "Se elimino correctamente";
		}else{
			echo "Se genero un error, intenta nuevamente";
		}
	}
	//------------------------------FUNCION PARA EDITAR USUARIOS-----------------------------//
	function editar_usuarios(){
		global $mysqli;
		extract($_POST);
		$expresion = '/^[9|9|5][0-10]{8}$/';
		//Validacion de campos vacios
		if (empty($nombre_usr) && empty($correo_usr) && empty($telefono_usr) && empty($pass_usr)) {
			echo "0";
		}elseif (empty($nombre_usr)) {
			echo "2";
		}elseif (empty($correo_usr)) {
			echo "3";
		}elseif ($correo_usr != filter_var($correo_usr, FILTER_VALIDATE_EMAIL)) {
			echo "4";
		}elseif (empty($img_usr)) {
			echo "10";
		}elseif (empty($telefono_usr)) {
			echo "5";
		}elseif (preg_match($expresion, $telefono_usr)) {
			echo "6";
		}elseif (empty($password_usr)) {
			echo "7";
		}else{
			$sql = "UPDATE usuarios SET nombre_usr = '$nombre_usr', correo_usr = '$correo_usr', foto_usr = '$img_usr', password_usr = '$password_usr', telefono_usr = '$telefono_usr'
			WHERE id_usr = '$id'";
			$rsl = $mysqli->query($sql);
			if ($rsl) {
				echo "8";
			}else{
				echo "9";
			}
		}
	}
	//------------------------------FUNCION CONSULTAR REGISTRO A EDITAR-----------------------------//
	function consultar_registro_usuarios($id){
		global $mysqli;
		$sql = "SELECT * FROM usuarios WHERE id_usr = $id";
		$rsl = $mysqli->query($sql);
		$fila = mysqli_fetch_array($rsl);
		echo json_encode($fila); //Imprime Json encodeado	
	}
	//------------------------------FUNCION PARA CARGAR IMAGENES------------------------------------//
	function carga_foto(){
		if (isset($_FILES["foto"])) {
			$file = $_FILES["foto"];
			$nombre = $_FILES["foto"]["name"];
			$temporal = $_FILES["foto"]["tmp_name"];
			$tipo = $_FILES["foto"]["type"];
			$tam = $_FILES["foto"]["size"];
			$dir = "../img/usuarios/";
			$respuesta = [
				"archivo" => "img/usuarios/logo.png",
				"status" => 0
			];
			if(move_uploaded_file($temporal, $dir.$nombre)){
				$respuesta["archivo"] = "img/usuarios/".$nombre;
				$respuesta["status"] = 1;
			}
			echo json_encode($respuesta);
		}
	}
	//------------------------------FUNCIONES MODULO SERVICES------------------------------------//
	//------------------------------FUNCION PARA CONSULTAR REGISTROS-----------------------------//
	function consultar_services(){
		//Conectar a la BD
		global $mysqli;
		//Realizar consulta
		$sql = "SELECT * FROM services";
		$rsl = $mysqli->query($sql);
		$array = [];
		while ($row = mysqli_fetch_array($rsl)) {
			array_push($array, $row);
		}
		echo json_encode($array); //Imprime Json encodeado		
	}
	//------------------------------FUNCION PARA INSERTAR SERVICES-------------------------------//
	function insertar_services(){
		//Conectar a la bd
		global $mysqli;
		$titulo = $_POST['titulo'];
		$subtitulo = $_POST['subtitulo'];
		$service = $_POST['service'];
		$desc = $_POST['desc'];
		$img = $_POST['img'];
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($desc) && empty($img)) {
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($service)) {
			echo "4";
		}elseif (empty($desc)) {
			echo "5";
		}elseif (empty($img)){
			echo "6";
		}else{
			$sql = "INSERT INTO services VALUES('', '$titulo', '$subtitulo', '$service', '$desc', '$img')";
			$rsl = $mysqli->query($sql);
			echo "1";
		}
	}
	//------------------------------FUNCION PARA ELIMINAR SERVICES-----------------------------//
	function eliminar_services($id){
		global $mysqli;
		$sql = "DELETE FROM services WHERE id_service = $id";
		$rsl = $mysqli->query($sql);
		if ($rsl) {
			echo "Se elimino correctamente";
		}else{
			echo "Se genero un error, intenta nuevamente";
		}
	}
	//------------------------------FUNCION CONSULTAR REGISTRO A EDITAR-----------------------------//
	function consultar_registro_services($id){
		global $mysqli;
		$sql = "SELECT * FROM services WHERE id_service = $id";
		$rsl = $mysqli->query($sql);
		$fila = mysqli_fetch_array($rsl);
		echo json_encode($fila); //Imprime Json encodeado	
	}
	//------------------------------FUNCION PARA EDITAR SERVICE-----------------------------//
	function editar_services(){
		global $mysqli;
		extract($_POST);
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($desc) && empty($img)) {
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($service)) {
			echo "4";
		}elseif (empty($desc)) {
			echo "5";
		}elseif (empty($img)){
			echo "6";
		}else{
			$sql = "UPDATE services SET titulo = '$titulo', subtitulo = '$subtitulo', service = '$service', service_desc = '$desc', img_service = '$img' WHERE id_service = '$id'";
			$rsl = $mysqli->query($sql);
			if ($rsl) {
				echo "7";
			}else{
				echo "8";
			}
		}
	}
	//------------------------------FUNCIONES MODULO SKILLS--------------------------------------//
	//------------------------------FUNCION PARA CONSULTAR REGISTROS-----------------------------//
	function consultar_skills(){
		//Conectar a la BD
		global $mysqli;
		//Realizar consulta
		$sql = "SELECT * FROM skills";
		$rsl = $mysqli->query($sql);
		$array = [];
		while ($row = mysqli_fetch_array($rsl)) {
			array_push($array, $row);
		}
		echo json_encode($array); //Imprime Json encodeado		
	}
	//------------------------------FUNCION PARA INSERTAR SKILLS-------------------------------//
	function insertar_skills(){
		//Conectar a la bd
		global $mysqli;
		$titulo = $_POST['titulo'];
		$subtitulo = $_POST['subtitulo'];
		$skill = $_POST['skill'];
		$porcentaje = $_POST['porcentaje'];
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($skill) && empty($porcentaje)) {
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($skill)) {
			echo "4";
		}elseif (empty($porcentaje)) {
			echo "5";
		}else{
			$sql = "INSERT INTO skills VALUES('', '$titulo', '$subtitulo', '$skill', '$porcentaje')";
			$rsl = $mysqli->query($sql);
			echo "1";
		}
	}
	//------------------------------FUNCION PARA ELIMINAR SKILLS-----------------------------//
	function eliminar_skills($id){
		global $mysqli;
		$sql = "DELETE FROM skills WHERE id_skill = $id";
		$rsl = $mysqli->query($sql);
		if ($rsl) {
			echo "Se elimino correctamente";
		}else{
			echo "Se genero un error, intenta nuevamente";
		}
	}
	//------------------------------FUNCION CONSULTAR REGISTRO A EDITAR-----------------------------//
	function consultar_registro_skills($id){
		global $mysqli;
		$sql = "SELECT * FROM skills WHERE id_skill = $id";
		$rsl = $mysqli->query($sql);
		$fila = mysqli_fetch_array($rsl);
		echo json_encode($fila); //Imprime Json encodeado	
	}
	//------------------------------FUNCION PARA EDITAR SERVICE-----------------------------//
	function editar_skills(){
		global $mysqli;
		extract($_POST);
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($skill) && empty($porcentaje)) {
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($skill)) {
			echo "4";
		}elseif (empty($porcentaje)) {
			echo "5";
		}else{
			$sql = "UPDATE skills SET titulo = '$titulo', subtitulo = '$subtitulo', skill = '$skill', skill_percentage = '$porcentaje' WHERE id_skill = '$id'";
			$rsl = $mysqli->query($sql);
			if ($rsl) {
				echo "6";
			}else{
				echo "7";
			}
		}
	}
?>