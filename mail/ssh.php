<?php

    ob_start();
    session_start();
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
        die("Connection failed : " . mysqli_error($conn));
    }
    
    if ( !$dbcon ) {
        die("Database Connection failed : " . mysqli_error($conn));
    }
    
    // it will never let you open index(login) page if session is set
    
    
    $error = false;
    
    if( isset($_POST['btn-login']) ) {  
        
        // prevent sql injections/ clear user invalid inputs
        $user = trim($_POST['user']);
        $user = strip_tags($user);
        $user = htmlspecialchars($user);
        
        $pass = trim($_POST['pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);
        // prevent sql injections / clear user invalid inputs
        
        if(empty($user)){
            $error = true;
            $userError = "Introduce tu preciuser";
        } 
        
        if(empty($pass)){
            $error = true;
            $passError = "Introduce tu precipass";
        }
        
        // if there's no error, continue to login
        if (!$error) {
            $connection = ssh2_connect('localhost', 22);
            if (ssh2_auth_password($connection, $user, $pass)) {
                echo "Authentication Successful!\n";
                $_SESSION['ssh'] = $user;
                header("Location: register.php");
            } else {
                die('Authentication Failed...');
            }
        }
        
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ssh.preciapps.com</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Inicia sesión en el servidor para añadir cuentas de correo</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="text" name="user" class="form-control" placeholder="Usuario" value="<?php echo $user; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $userError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="30" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Iniciar Sesión</button>
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
