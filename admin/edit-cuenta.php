<?php require_once('../Connections/puertoLab.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuario SET usuario=%s, clave=%s, nombre=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['clave'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_puertoLab, $puertoLab);
  $Result1 = mysql_query($updateSQL, $puertoLab) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varID_usuario = "0";
if (isset($_GET['id'])) {
  $varID_usuario = $_GET['id'];
}
mysql_select_db($database_puertoLab, $puertoLab);
$query_usuario = sprintf("SELECT * FROM usuario WHERE usuario.id_usuario = %s", GetSQLValueString($varID_usuario, "int"));
$usuario = mysql_query($query_usuario, $puertoLab) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta charset="iso-8859-1"/>
<title>UEEB “SIMÓN BOLÍVAR”</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
 
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok2v=1613a3a185/"},atok:"1cc6641e8c5a264d38c5962738639893",petok:"ba47a87f745b77b81ee3e70d2a24954dede5ae77-1413814449-1800",zone:"revox.io",rocket:"0",apps:{}}];CloudFlare.push({"apps":{"ape":"19760860f3efb021ee8b409775ad86db"}});!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="../../../ajax.cloudflare.com/cdn-cgi/nexp/dok2v%3d919620257c/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
<link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
 
 
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
 
 
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
 
<link href="assets/plugins/boostrap-slider/css/slider.css" rel="stylesheet" type="text/css"/>
</head>
 
 
<body class="">
 
<?php include("assets/includes/header.php"); ?>
 
<div class="page-container row">
 
<?php include("assets/includes/sidebar.php"); ?>
 
 
<div class="page-content">
 

<div class="clearfix"></div>
<div class="content">
<ul class="breadcrumb">
<li>
<p>ESTAS AQUÍ</p>
</li>
<li><a href="#" class="active">MODIFICAR DATOS USUARIO</a> </li>
</ul>
 
<div class="row">
<div class="col-md-12">
<div class="grid simple">
<div class="grid-title no-border">
<h4>Modificando datos de: <span class="semi-bold"> <?php echo $row_usuario['usuario']; ?></span></h4>
<div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="reload"></a> </div>
</div>
<div class="grid-body no-border"> <br>
<div class="row">
<div class="col-md-8 col-sm-8 col-xs-8">
<div class="form-group">
  <form method="post" name="form1" action="<?php echo $editFormAction; ?>" class="formulario">
    <table align="center">
      <tr valign="baseline">
        <td nowrap align="right">Usuario:</td>
        <td><input type="text" name="usuario" value="<?php echo htmlentities($row_usuario['usuario'], ENT_COMPAT, 'UTF-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Clave:</td>
        <td><input type="text" name="clave" value="<?php echo htmlentities($row_usuario['clave'], ENT_COMPAT, 'UTF-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Nombre:</td>
        <td><input type="text" name="nombre" value="<?php echo htmlentities($row_usuario['nombre'], ENT_COMPAT, 'UTF-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" value="Actualizar registro"></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" class="btn btn-primary">
    <input type="hidden" name="id_usuario" value="<?php echo $row_usuario['id_usuario']; ?>">
  </form>
  <p>&nbsp;</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
 
</div>
 
 
<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
 
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
 
 
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
<script src="assets/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
 
<script src="assets/js/form_elements.js" type="text/javascript"></script>
 
<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
 
 
</body>
</html>
<?php
mysql_free_result($usuario);
?>
