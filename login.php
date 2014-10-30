<?php require_once('Connections/puertoLab.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['clave'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin/index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_puertoLab, $puertoLab);
  
  $LoginRS__query=sprintf("SELECT usuario, clave FROM usuario WHERE usuario=%s AND clave=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "int")); 
   
  $LoginRS = mysql_query($LoginRS__query, $puertoLab) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html>

<!-- Mirrored from revox.io/webarch/2.7/login.html by HTTrack Website Copier/3.x [XR&CO'2010], Mon, 20 Oct 2014 14:17:25 GMT -->
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta charset="utf-8"/>
<title>UEEB “SIMÓN BOLÍVAR” Iniciar Seción</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
 
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok2v=1613a3a185/"},atok:"a38fcbc1012865eac71d781207e50d91",petok:"0ba1c3ac009cd0911e02f4dc8a0cebf293a9720f-1413814434-1800",zone:"revox.io",rocket:"0",apps:{}}];CloudFlare.push({"apps":{"ape":"18979afe923294e44698999dd005c540"}});!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="../../../ajax.cloudflare.com/cdn-cgi/nexp/dok2v%3d919620257c/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<link href="admin/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="admin/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="admin/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="admin/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="admin/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
 
 
<link href="admin/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="admin/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="admin/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
 
</head>
 
 
<body class="error-body no-top">
<div class="container">
<div class="row login-container column-seperation">
<div class="col-md-5 col-md-offset-1">
  <img src="images/top_intro.png" width="439" height="187"> </div>
<div class="col-md-5 "> <br>
<form  id="inicio" name="inicio" method="POST" action="<?php echo $loginFormAction; ?>" class="login-form">
<div class="row">
<div class="form-group col-md-10">
<label class="form-label">Usuario</label>
<div class="controls">
<div class="input-with-icon  right">
<i class=""></i>
<input type="text" name="usuario" size="15" maxlength="30"  id="usuario" class="form-control"/>
</div>
</div>
</div>
</div>
<div class="row">
<div class="form-group col-md-10">
<label class="form-label">Contraseña</label>
<span class="help"></span>
<div class="controls">
<div class="input-with-icon  right">
<i class=""></i>
<input type="password" name="clave" size="15" maxlength="30" id="clave"class="form-control" />
</div>
</div>
</div>
</div>
<div class="row">
<div class="control-group  col-md-10">
</div>
</div>
<div class="row">
<div class="col-md-10">
<button class="btn btn-primary btn-cons pull-right" type="submit">Entrar</button>
</div>
</div>
</form>
</div>
</div>
</div>
 
 
<script src="admin/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="admin/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="admin/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="admin/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="admin/assets/js/login.js" type="text/javascript"></script>
 
 
</body>
</html>