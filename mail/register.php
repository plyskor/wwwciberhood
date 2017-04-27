<?php
	ob_start();
	session_start();
	if( isset($_SESSION['ssh'])!="" ){
		echo 'Estás en el servidor como el usuario '.$_SESSION['ssh'];
	}else{
		header("Location: ssh.php");
	}
	// this will avoid mysql_connect() deprecation error.
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	// but I strongly suggest you to use PDO or MySQLi.
	
	define('DBHOST', '127.0.0.1');
	define('DBUSER', 'usermail');
	define('DBPASS', 'y5L}xA<e');
	define('DBNAME', 'servermail');
	
	$conn = mysqli_connect(DBHOST,DBUSER,DBPASS);
	$dbcon = mysqli_select_db($conn,DBNAME);
	
	if ( !$conn ) {
		die("Conexión a mysql server fallida: " . mysqli_error($conn));
	}
	
	if ( !$dbcon ) {
		die("Conexión a base de datos fallida: : " . mysqli_error($conn));
	}

	$error = false;
	if ( isset($_POST['btn-logout']) ){
		session_unset();
		header("Location: ssh.php");
	}
	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		
		
		
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		$pass2 = trim($_POST['pass2']);
		$pass2 = strip_tags($pass2);
		$pass2 = htmlspecialchars($pass2);
			// check email exist or not
			$stmt = $conn->prepare("SELECT email FROM virtual_users WHERE email=?");
			$stmt->bind_param("s", $email);
			$email = trim($_POST['email']);
			$email = strip_tags($email);
			$email = htmlspecialchars($email);
		//basic email validation
			if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
				$error = true;
				$emailError = "Introduce un correo válido (email@ciberhood.com)";
				} else {
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows!=0){
				$error = true;
				$emailError = "Ese correo ya esta en uso";
			}
		}
		// password validation
		if($pass!=$pass2){
			$error = true;
			$passError = "Las conraseñas no coinciden";
		}
		if (empty($pass)){
			$error = true;
			$passError = "Inserta una contraseña";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "La conraseña debe tener al menos 6 caracteres";
		}
		
		// password encrypt using SHA256();
		$password = $pass;
		$stmt->close();
		// if there's no error, continue to signup
		if( !$error ) {
			if($stmt = $conn->prepare("INSERT INTO virtual_users (domain_id, password , email) VALUES ('1', ENCRYPT(?, CONCAT('$6$', SUBSTRING(SHA(RAND()), -16))),?)")){
			$stmt->bind_param("ss", $pass,$email);
			$email = trim($_POST['email']);
			$email = strip_tags($email);
			$email = htmlspecialchars($email);
			$pass = trim($_POST['pass']);
			$pass = strip_tags($pass);
			$pass = htmlspecialchars($pass);
			$stmt->execute();
			$stmt->store_result();
			if ($stmt->affected_rows==1) {
				$errTyp = "exito";
				$errMSG = "Se ha creado la cuenta. Inicia sesión en un cliente de correo";
				//WELCOME MAIL
				$to = $email;
				$subject = "Bienvenido";
				$message = "Hola ".$email.", el administrador de correo te da la bienvenida al mail privado de CiberHood";
				// More headers
				$headers .= 'From: <postmaster@ciberhood.com>' . "\r\n";
				mail($to,$subject,$message,$headers);
				unset($email);
				session_unset();
				unset($pass);
			} else {
				$errTyp = "danger";
				$errMSG = "Algo ha ido mal. Inténtalo de nuevo";	
			}	
			}else {printf("Error message:: %s\n", $conn->error);}
		} 
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crear Correo CiberHood</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Añadir cuenta de correo mail.preciapps.com</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="email@preciapps.com" maxlength="40" value="<?php echo $email ?>" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                
            </div>
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass2" class="form-control" placeholder="Re-Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Añadir</button>
            </div>
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-logout">Salir</button>
            </div>
            <div class="form-group">
            	<hr />
            </div>
            
         
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>
