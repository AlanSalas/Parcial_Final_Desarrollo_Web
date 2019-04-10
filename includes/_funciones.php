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
	//HEADER
		case 'consultar_header':
			consultar_header();
		break;

		case 'update_header':
			update_header();
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
	//ABOUT
		case 'consultar_about':
			consultar_about();
		break;
		case 'insertar_about':
			insertar_about();
		break;
		case 'eliminar_about';
			eliminar_about($_POST['id']);
		break;
		case 'consultar_registro_about':
			consultar_registro_about($_POST['id']);
		break;
		case 'editar_about':
			editar_about();
		break;
	//TEAM
		case "insertar_team":
  		insertar_team();
  		break;

  		case "eliminar_team":
  		eliminar_team($_POST["id"]);
		break;

		case 'editar_team':
    	editar_team($registro= $_POST["id"]);
		break;

  		case 'consultar_miembro':
    	consultar_miembro($registro= $_POST["id"]);		
		break;

		case "consultar_team":
  		consultar_team();
  		break;


    
        //CONTACTO

		case 'consultar_contacto':
			consultar_contacto();
		break;
		case 'insertar_contacto':
			insertar_contacto();
		break;
		case 'eliminar_contacto';
			eliminar_contacto($_POST['id']);
			break;
		case 'consultar_registro_contacto':
			consultar_registro_contacto($_POST['id']);
			break;
		case 'editar_contacto':
			editar_contacto();
			break;
		//PORTAFOLIO
		case 'consultar_portafolio':
			consultar_portafolio();
		break;
		case 'insertar_portafolio':
			insertar_portafolio();
		break;
		case 'eliminar_portafolio';
			eliminar_portafolio($_POST['id']);
		break;
		case 'consultar_registro_portafolio':
			consultar_registro_portafolio($_POST['id']);
		break;
		case 'editar_portafolio':
			editar_portafolio();
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


	//------------------------------FUNCIONES MODULO HEADER------------------------------//
	//------------------------------CONSULTAR-----------------------------//
	function consultar_header(){
 // 	global $db;
 // 	$query = "SELECT * FROM proye145_cuda_dweb.header";
	// $stmt = $db->prepare($query);
	// $stmt->execute();
	// $fila = $stmt->fetch(PDO::FETCH_ASSOC);
	// echo json_encode($fila);
		global $mysqli;
		$query = "SELECT * FROM header";
		$respuesta = $mysqli->query($query);
		$fila = mysqli_fetch_array($respuesta);
		echo json_encode($fila); //Imprime Json encodeado	
	}
	//------------------------------ACTUALIZAR-----------------------------//
	function update_header(){
	$titulo= $_POST["titulo"];
	$texto= $_POST["texto"];
	$boton = $_POST["boton"];
	$link = $_POST["link"];
	// $id = $_POST['id'];
 	global $db;
 	$stmt = $db->prepare("UPDATE proye145_cuda_dweb.header SET header_title =?, header_content =?, header_link =?, header_href =? WHERE header_id = 1");
 	$stmt->execute(array($titulo, $texto, $boton, $link));
 	$affected_rows = $stmt->rowCount();
 		if ($affected_rows > 0) {
 			echo "1";
 		} else {
 			echo"0";
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
		$loader = $_POST['loader'];
		$color = $_POST['color'];
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($skill) && empty($porcentaje) && empty($loader) && empty($color)) {
			echo "0";
		}else{
			$sql = "SELECT * FROM skills WHERE loader = '$loader'";
			$rsl = $mysqli->query($sql);
			$row = $rsl->fetch_assoc();
			if ($row) {
				echo "8";
			}else{
				if (empty($titulo)) {
					echo "2";
				}elseif (empty($subtitulo)) {
					echo "3";
				}elseif (empty($skill)) {
					echo "4";
				}elseif (empty($porcentaje)) {
					echo "5";
				}else{
					$sql = "INSERT INTO skills VALUES('', '$titulo', '$subtitulo', '$skill', '$porcentaje', '$loader', '$color')";
					$rsl = $mysqli->query($sql);
					echo "1";
				}
			}
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
	//------------------------------FUNCION PARA EDITAR SKILLS-----------------------------//
	function editar_skills(){
		global $mysqli;
		extract($_POST);
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($skill) && empty($porcentaje) && empty($loader) && empty($color)) {
			echo "0";
		}else{
			$sql = "SELECT * FROM skills WHERE loader = '$loader'";
			$rsl = $mysqli->query($sql);
			$row = $rsl->fetch_assoc();
			if ($row) {
				echo "8";
			}else{
				if (empty($titulo)) {
					echo "2";
				}elseif (empty($subtitulo)) {
					echo "3";
				}elseif (empty($skill)) {
					echo "4";
				}elseif (empty($porcentaje)) {
					echo "5";
				}else{
					$sql = "UPDATE skills SET titulo = '$titulo', subtitulo = '$subtitulo', skill = '$skill', skill_percentage = '$porcentaje', loader = '$loader', color = '$color' WHERE id_skill = '$id'";
					$rsl = $mysqli->query($sql);
					if ($rsl) {
						echo "6";
					}else{
						echo "7";
					}
				}
			}
		}
	}
	//------------------------------FUNCIONES MODULO ABOUT US--------------------------------------//
	//------------------------------FUNCION PARA CONSULTAR ABOUT US-----------------------------//
	function consultar_about(){
		//Conectar a la BD
		global $mysqli;
		//Realizar consulta
		$sql = "SELECT * FROM about";
		$rsl = $mysqli->query($sql);
		$array = [];
		while ($row = mysqli_fetch_array($rsl)) {
			array_push($array, $row);
		}
		echo json_encode($array); //Imprime Json encodeado		
	}
	//------------------------------FUNCION PARA INSERTAR ABOUT US-----------------------------//
	function insertar_about(){
		//Conectar a la bd
		global $mysqli;
		$titulo = $_POST['titulo_us'];
		$subtitulo = $_POST['subtitulo_us'];
		$descripcion = $_POST['descrip_us'];
		$nombre = $_POST['nombre_us'];
		$cargo = $_POST['cargo_us'];
		$imagen = $_POST['img_us'];
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($descripcion) && empty($nombre) && empty($cargo) && empty($imagen)) {
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($descripcion)) {
			echo "4";
		}elseif (empty($nombre)) {
			echo "5";
		}elseif (empty($cargo)) {
			echo "6";
		}elseif (empty($imagen)) {
			echo "7";
		}else{

			$sql = "INSERT INTO about VALUES('', '$titulo_us', '$subtitulo_us', '$descripcion_us', '$nombre_us', '$cargo_us', '$img_us')";

			$sql = "INSERT INTO about VALUES('', '$titulo', '$subtitulo', '$descripcion', '$nombre', '$cargo', '$imagen')";

			$rsl = $mysqli->query($sql);
			echo "1";
		}
	}
	//------------------------------FUNCION PARA ELIMINAR ABOUT US-----------------------------//
	function eliminar_about($id){
		global $mysqli;
		$sql = "DELETE FROM about WHERE id_us = $id";
		$rsl = $mysqli->query($sql);
		if ($rsl) {
			echo "Se elimino correctamente";
		}else{
			echo "Se genero un error, intenta nuevamente";
		}
	}
	//------------------------------FUNCION PARA EDITAR ABOUT US----------------------------//
	function editar_about(){
		global $mysqli;
		extract($_POST);
		//Validacion de campos vacios
		if (empty($titulo_us) && empty($subtitulo_us) && empty($descrip_us) && empty($nombre_us) && empty($cargo_us) && empty($img_us)) {
			echo "0";
		}elseif (empty($titulo_us)) {
			echo "2";
		}elseif (empty($subtitulo_us)) {
			echo "3";
		}elseif (empty($descrip_us)) {
			echo "4";
		}elseif (empty($nombre_us)) {
			echo "5";
		}elseif (empty($cargo_us)) {
			echo "6";
		}elseif (empty($img_us)) {
			echo "7";
		}else{
			$sql = "UPDATE about SET titulo_us = '$titulo_us', subtitulo_us = '$subtitulo_us', descrip_us = '$descrip_us', cargo_us = '$cargo_us', nombre_us = '$nombre_us', img_us = '$img_us'
			WHERE id_us = '$id'";
			$rsl = $mysqli->query($sql);
			if ($rsl) {
				echo "8";
			}else{
				echo "9";
			}
		}
	}
	//------------------------------FUNCION CONSULTAR ABOUT A EDITAR-----------------------------//
	function consultar_registro_about($id){
		global $mysqli;
		$sql = "SELECT * FROM about WHERE id_us = $id";
		$rsl = $mysqli->query($sql);
		$fila = mysqli_fetch_array($rsl);
		echo json_encode($fila); //Imprime Json encodeado	
	}

	//------------------------------FUNCIONES MODULO TEAM------------------------------//

	function consultar_team(){
  global $mysqli;
  $consulta = "SELECT * FROM team";
  $resultado = mysqli_query($mysqli, $consulta);
  $arreglo = [];
  while($fila = mysqli_fetch_array($resultado)){
    array_push($arreglo, $fila);
  }
  echo json_encode($arreglo); //Imprime el JSON ENCODEADO
}


function consultar_miembro($id){
  global $mysqli;
  $consulta = "SELECT * FROM team WHERE team_id = $id";
  $resultado = mysqli_query($mysqli, $consulta);
  $fila = mysqli_fetch_array($resultado);
  echo json_encode($fila); //Imprime el JSON ENCODEADO
}

function insertar_team(){
  global $mysqli;
  $team_img = $_POST["imagen"];
  $team_name = $_POST["nombre"]; 
  $team_position = $_POST["cargo"];
  $team_description = $_POST["descripcion"];
  $consulta = "INSERT INTO team VALUES('','$team_img','$team_name','$team_position','$team_description')";
  $resultado = mysqli_query($mysqli, $consulta);
    if ($resultado) {
    echo "Se agrego correctamente";
  } else {
    echo "Se generó un error, intenta nuevamente";
  }

}


function editar_team($id){
  global $mysqli;
  extract($_POST);
  $consulta = "UPDATE team SET team_img = '$imagen', team_name = '$nombre', 
  team_position = '$cargo', team_description = '$descripcion' WHERE team_id = '$id' ";
  $resultado = mysqli_query($mysqli, $consulta);
  if($resultado){
    echo "Se editó correctamente";
  }else{
    echo "Se generó un error, intentalo nuevamente";
  }
}



function eliminar_team($id){
  global $mysqli;
  $query = "DELETE FROM team WHERE team_id = $id";
  $resultado = mysqli_query($mysqli, $query);
  if ($resultado) {
    echo "Se eliminó correctamente";
  } else {
    echo "Se generó un error, intenta nuevamente";
  }
}

//------------------------------FUNCIONES MODULO PORTAFOLIO--------------------------------------//
	//------------------------------FUNCION PARA CONSULTAR PORTAFOLIO-----------------------------//
	function consultar_portafolio(){
		//Conectar a la BD
		global $mysqli;
		//Realizar consulta
		$sql = "SELECT * FROM portafolio";
		$rsl = $mysqli->query($sql);
		$array = [];
		while ($row = mysqli_fetch_array($rsl)) {
			array_push($array, $row);
		}
		echo json_encode($array); //Imprime Json encodeado		
	}
	//------------------------------FUNCION PARA INSERTAR PORTAFOLIO-----------------------------//
	function insertar_portafolio(){
		//Conectar a la bd
		global $mysqli;
		$titulo = $_POST['titulo'];
		$subtitulo = $_POST['subtitulo'];
		$img = $_POST['foto'];
		$descripcion = $_POST['descri_img'];
		$expresion = '/^[9|9|5][0-10]{8}$/';
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($img)&& empty($descripcion)) {
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($img)) {
			echo "4";
		}elseif (empty($descripcion)) {
			echo "5";
		}else{
			$sql = "INSERT INTO portafolio VALUES('', '$titulo', '$subtitulo','$img','$descripcion')";
			$rsl = $mysqli->query($sql);
			echo "1";
		}
	}
	//------------------------------FUNCION PARA ELIMINAR PORTAFOLIO -----------------------------//
	function eliminar_portafolio($id){
		global $mysqli;
		$sql = "DELETE FROM portafolio WHERE id_port = $id";
		$rsl = $mysqli->query($sql);
		if ($rsl) {
			echo "Se elimino correctamente";
		}else{
			echo "Se genero un error, intenta nuevamente";
		}
	}
	//------------------------------FUNCION PARA EDITAR PORTAFOLIO ----------------------------//
	function editar_portafolio(){
		global $mysqli;
		extract($_POST);
		$expresion = '/^[9|9|5][0-10]{8}$/';
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($img)&& empty($descripcion)){
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($img)) {
			echo "4";
		}elseif (empty($descripcion)) {
			echo "5";
		}else{
			$sql = "UPDATE portafolio SET titulo = '$titulo', subtitulo = '$subtitulo', img = '$img', descripcion= '$descripcion'
			WHERE id_port = '$id'";
			$rsl = $mysqli->query($sql);
			if ($rsl) {
				echo "8";
			}else{
				echo "9";
			
			
			}
		}
	}
	//------------------------------FUNCION CONSULTAR PORTAFOLIO A EDITAR-----------------------------//
	function consultar_registro_portafolio($id){
		global $mysqli;
		$sql = "SELECT * FROM portafolio WHERE id_port = $id";
		$rsl = $mysqli->query($sql);
		$fila = mysqli_fetch_array($rsl);
		echo json_encode($fila); //Imprime Json encodeado	
	}

	//------------------------------FUNCIONES CONTACTO------------------------------------//
	//------------------------------FUNCION PARA CONSULTAR CONTACTO-----------------------------//
	function consultar_contacto(){
		//Conectar a la BD
		global $mysqli;
		//Realizar consulta
		$sql = "SELECT * FROM contacto";
		$rsl = $mysqli->query($sql);
		$array = [];
		while ($row = mysqli_fetch_array($rsl)) {
			array_push($array, $row);
		}
		echo json_encode($array); //Imprime Json encodeado		
	}
	//------------------------------FUNCION PARA INSERTAR CONTACTO-------------------------------//
	function insertar_contacto(){
		//Conectar a la bd
		global $mysqli;
		$titulo = $_POST['titulo'];
		$subtitulo = $_POST['subtitulo'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($name) && empty($email)&& empty($message)) {
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($name)) {
			echo "4";
		}elseif (empty($email)) {
			echo "5";
		}elseif (empty($message)){
			echo "6";
		}else{
			$sql = "INSERT INTO contacto VALUES('', '$titulo', '$subtitulo', '$name', '$email', '$message')";
			$rsl = $mysqli->query($sql);
			echo "1";
		}
	}
	//------------------------------FUNCION PARA ELIMINAR CONTACTO-----------------------------//
	function eliminar_contacto($id){
		global $mysqli;
		$sql = "DELETE FROM contacto WHERE id_contacto = $id";
		$rsl = $mysqli->query($sql);
		if ($rsl) {
			echo "Se elimino correctamente";
		}else{
			echo "Se genero un error, intenta nuevamente";
		}
	}
	//------------------------------FUNCION CONSULTAR REGISTRO A EDITAR-----------------------------//
	function consultar_registro_contacto($id){
		global $mysqli;
		$sql = "SELECT * FROM contacto WHERE id_contacto = $id";
		$rsl = $mysqli->query($sql);
		$fila = mysqli_fetch_array($rsl);
		echo json_encode($fila); //Imprime Json encodeado	
	}
	//------------------------------FUNCION PARA EDITAR CONTACTO-----------------------------//
	function editar_contacto(){
		global $mysqli;
		extract($_POST);
		//Validacion de campos vacios
		if (empty($titulo) && empty($subtitulo) && empty($name) && empty($email)&&empty($message)) {
			echo "0";
		}elseif (empty($titulo)) {
			echo "2";
		}elseif (empty($subtitulo)) {
			echo "3";
		}elseif (empty($name)) {
			echo "4";
		}elseif (empty($email)) {
			echo "5";
		}elseif (empty($message)){
			echo "6";
		}else{
			$sql = "UPDATE contacto SET titulo = '$titulo', subtitulo = '$subtitulo', name = '$name', email = '$email', message = '$message' WHERE id_contacto = '$id'";
			$rsl = $mysqli->query($sql);
			if ($rsl) {
				echo "7";
			}else{
				echo "8";
			}
		}
	}
?>