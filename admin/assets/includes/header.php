

<div class="header navbar navbar-inverse ">
 
<div class="navbar-inner">
<div class="header-seperation">
<ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
<li class="dropdown"> <a id="main-menu-toggle" href="#main-menu" class="">
<div class="iconset top-menu-toggle-white"></div>
</a> </li>
</ul>
 
<a href="index-2.html" style="color:#FFF; margin-left:11px; font-size:18px; font-weight:bold;">UEEB “SIMÓN BOLÍVAR”</a>

</div>
 
<div class="header-quick-nav">
 
<div class="pull-left">
<ul class="nav quick-section">
<li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle">
<div>MENU</div>
</a> </li>
</ul>
<ul class="nav quick-section">
<li class="quicklinks"> <a href="#" class="">
<div class="iconset top-reload"></div>
</a> </li>
<li class="quicklinks"> <span class="h-seperate"></span></li>
<li class="quicklinks"> <a href="#" class="">
<div class="iconset top-tiles"></div>
</a> </li>
</ul>
</div>
 
 
<div class="pull-right">
<ul class="nav quick-section ">
<li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
<div><?php echo $row_usuario['nombre']; ?></div>
</a>
<ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
<li><a href="edit-cuenta.php?id=<?php echo $row_usuario['id_usuario']; ?>"> Mi Cuenta</a> </li>
<li class="divider"></li>
<li><a href="<?php echo $logoutAction ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Salir</a></li>
</ul>
</li>
<li class="quicklinks"> <span class="h-seperate"></span></li>
</ul>
</div>
 
</div>
 
</div>
 
</div>