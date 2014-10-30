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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO pdocente (nombre, cedula, direccion, telefono, grado) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['grado'], "text"));

  mysql_select_db($database_puertoLab, $puertoLab);
  $Result1 = mysql_query($insertSQL, $puertoLab) or die(mysql_error());

  $insertGoTo = "ver-pdocente.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_puertoLab, $puertoLab);
$query_pdocente = "SELECT * FROM pdocente";
$pdocente = mysql_query($query_pdocente, $puertoLab) or die(mysql_error());
$row_pdocente = mysql_fetch_assoc($pdocente);
$totalRows_pdocente = mysql_num_rows($pdocente);

mysql_select_db($database_puertoLab, $puertoLab);
$query_usuario = "SELECT * FROM usuario";
$usuario = mysql_query($query_usuario, $puertoLab) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta charset="utf-8"/>
<title>UEEB “SIMÓN BOLÍVAR”</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
 
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok2v=1613a3a185/"},atok:"a38fcbc1012865eac71d781207e50d91",petok:"c93361c328fbd736c83bda24e6dbc0c6c92f5245-1413814452-1800",zone:"revox.io",rocket:"0",apps:{}}];CloudFlare.push({"apps":{"ape":"ef03c8bba9f0972132b20d5221a364c4"}});!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="../../../ajax.cloudflare.com/cdn-cgi/nexp/dok2v%3d919620257c/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
 
 
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
 
 
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
 
</head>
 
 
<body class="">
 
<?php include("assets/includes/header.php"); ?>
 
 
<div class="page-container row-fluid">
 
<?php include("assets/includes/sidebar.php"); ?>

 
<div class="page-content">
 

<div class="clearfix"></div>
<div class="content">
<ul class="breadcrumb">
<li>
<p>ESTAS AQUÍ</p>
</li>
<li><a href="#" class="active">PERSONAL ADMINISTRATIVO</a> </li>
</ul>


<div class="row-fluid">
<div class="span12">
<div class="grid simple ">
<div class="grid-title">
<h4><span class="semi-bold">PERSONAL ADMINISTRATIVO</span></h4>
<div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="reload"></a></div>
</div>
<div class="grid-body ">
<table class="table" id="example3">
<thead>
<tr>
<th>Nombre y Apellido</th>
<th>Cédula</th>
<th>Dirección</th>
<th>Teléfono</th>
<th>Grado</th>
<th>OPCIONES</th>
</tr>
</thead>
<tbody>

      <?php do { ?>
        <tr class="gradeU">
          <td><?php echo $row_pdocente['nombre']; ?></td>
          <td><?php echo $row_pdocente['cedula']; ?></td>
          <td><?php echo $row_pdocente['direccion']; ?></td>
          <td><?php echo $row_pdocente['telefono']; ?></td>
          <td><?php echo $row_pdocente['grado']; ?></td>
          <td class="center" style="font-size:10px; text-align:center;"><a href="edit-pdocente.php?id=<?php echo $row_pdocente['id']; ?>">EDITAR</a><br> 
        <a href="borrar-pdocente.php?id=<?php echo $row_pdocente['id']; ?>">BORRAR</a></td>
        </tr>
        <?php } while ($row_pdocente = mysql_fetch_assoc($pdocente)); ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div class="admin-bar" id="quick-access" style="margin-bottom:-50px;">
<div class="admin-bar-inner">
<div class="form-horizontal" style="width:90%;">
  <form method="post" name="form2" action="<?php echo $editFormAction; ?>" class="formulario">
	<input type="text" name="nombre" value="" size="20" placeholder="Nombres y Apellidos">
    <input type="text" name="cedula" value="" size="20" placeholder="Cédula de Identidad">
    <input type="text" name="direccion" value="" size="20" placeholder="Dirección">
    <input type="text" name="telefono" value="" size="20" placeholder="Teléfono"><br>
    <input type="text" name="grado" value="" size="20" placeholder="Grado" style="margin-right:400px;">
    <input type="submit" value="Agregar" class="btn btn-primary">
    <button class="btn btn-white btn-cons btn-cancel" type="button" style="margin:5px;">Cancelar</button>
    <input type="hidden" name="MM_insert" value="form2">
  </form>
  <p>&nbsp;</p>
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
<script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="assets/plugins/datatables-responsive/js/lodash.min.js"></script>
 
<script src="assets/js/datatables.js" type="text/javascript"></script>
 
<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
 
 
</body>
</html>
<?php
mysql_free_result($pdocente);

mysql_free_result($usuario);
?>
