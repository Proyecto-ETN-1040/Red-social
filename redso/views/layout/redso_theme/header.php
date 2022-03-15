<!-- codigo de la primera pantalla donde te pide usuario y contraseña-->
<!-- ............................................................... -->
       <!-- .................................................. -->
            <!-- ........................................ -->
                 <!-- .............................. -->
                      <!-- .................... -->
                           <!-- ........... -->
<!-- para cambiar el color de la cabecera principal-->
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>RED-ETN</title>
	<!-- Favicon, imagen pequeñita-->
	<link rel="icon" href="<?=BASE_URL . '/views/layout/redso_theme/images/descarga.jpg'?>" type="image/x-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

	<!-- Bootstrap Core Css listo-->
	<link href="<?=$_assets['plugins']?>bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Waves Effect Css listo-->
	<link href="<?=$_assets['plugins']?>node-waves/waves.css" rel="stylesheet" />

	<!-- Animation Css listo-->
	<link href="<?=$_assets['plugins']?>animate-css/animate.css" rel="stylesheet" />
	
	<link href="<?=$_assets['css']?>all.min.css" rel="stylesheet" />	<!--listo-->
	<link href="<?=$_assets['css']?>fontawesome.min.css" rel="stylesheet" />	<!--listo-->
    
    <link href="<?=$_assets['css']?>jquery-confirm.min.css" rel="stylesheet" />
    
	<link href="<?=$_assets['plugins']?>bootstrap-select/css/bootstrap-select.css" rel="stylesheet" /><!--listo-->
    
    <link href="<?=$_assets['css']?>dropzone.min.css" rel="stylesheet" />	<!--listo-->

	<!-- Custom Css -->
	<link href="<?=$_assets['css']?>style.css" rel="stylesheet">	<!--listo-->

	<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
	<link href="<?=$_assets['css']?>themes/all-themes.css" rel="stylesheet" />           <!--Color de letras header themes-->	<!--listo-->
    
    <link rel="stylesheet" href="<?=$_assets['plugins']?>skidder/src/jquery.skidder.css"><!--listo-->
    
    <link rel="stylesheet" href="<?=$_assets['plugins']?>jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"><!--listo-->

    <style type="text/css">
	.bootstrap-select li {
		padding:0 0 0 15pt;
		margin:0;
	}
	/*.bootstrap-select ul {
		padding:0; margin:0;
	}
	.bootstrap-select li a {
		padding:0; margin:0;
	}*/
	.linea{
		display: inline;
	}
	</style>
</head>
<!------------------------------------------------------------------------------------------------------------------------------------------>
<!-- color de fondo claro de toda la pagina principal f5eef8 -->
<body class="theme-deep-orange" style="background-color: #f5eef8">
<!-- cargador de pagina -->
<!----- coloro de fondo de mensaje de espera -------------------------------->
	<div class="page-loader-wrapper" style="background-color: #ffffff">
		<div class="loader" >
<!-- coloro de espera del fondo del  circulo que gira-- ............................ -->
			<div class="preloader" style="background-color: #ffffff">
				<!-- muestra el circulo completo -->
					<div class="circle-clipper left" >
					<!-- color de la mitad del circulo 9ccc65-->
						<div class="circle" style= "color:#9ccc65;"></div>
					</div>
					<div class="circle-clipper right" >
					<!-- color de la otra mitad del circulo 9ccc65-->
						<div class="circle" style= "color:#9ccc65;"></div>
					</div>
				<!--  fin de muestra el circulo completo -->
			</div>
<!-- fin de color de espera y circulo que gira-- ...................... -->
<!-- mensaje de espera y color de letra-->
			
			<p style= "color:#000000;">Por favor espere</p>
		</div>
	</div>

	<div class="overlay"></div>
	
	<nav class="navbar">
<!-- color rectangular verde donde esta chat, inicio, etc.  --  **********************************************  -->
    
		<div class="container-fluid" style="background-color: #0b5345">
			<div class="navbar-header" >
				<a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
				
				<a class="navbar-brand linea" href="#">REDSO</a>
				<a href="javascript:void(0);" class="navbar-brand dropdown-toggle linea" data-toggle="dropdown" role="button"><?php if(count($this->pubn)>0){?><button title="Notificaciones" class="btn-xs btn-primary" style="position:absolute; font-size:8px; margin:-8px 0 0 12px; padding:0px 3px 0px 3px"><?=count($this->pubn)?></button><?php } ?><i class="fa fa-bell"></i></a>
						<ul class="dropdown-menu">
							<li class="header">PUBLICACIONES </li>
							<li class="body">
								<ul class="menu">
									<?php if ( count($this->publicacion) > 0 ) : ?>
<!-- imagen por defecto -->
									<?php foreach ($this->pubn as $publicacion) : 
                                        if($publicacion['usu_foto']==''){
                                            $img = 'views/layout/imgs/silueta.jpg';	
                                        }else{
                                            $img = 'uploads/usuarios/'.$publicacion['usu_foto'];
                                        } 
                                    ?>
                                    <li>
										<a href="<?=BASE_URL . 'perfil/notificaciones/'.$publicacion['not_id'].'/'.$publicacion['uid']?>">
											<div class="icon-circle " >
												
												<img src="<?=BASE_URL . $img?>" class="img-responsive img-circle" >
											</div>
											<div class="menu-info">
												<h4><?=$publicacion['usu_nombre']." ".$publicacion['usu_apellido']?></h4>
												<p>
													
													<?=$publicacion['pub_fecha']?> | <?=$publicacion['pub_hora']?>
												</p>
											</div>
										</a>
									</li>
                                    <?php endforeach; ?>
                					<?php endif; ?>
									
								</ul>
							</li>
							<li class="footer">
								<a href="<?=BASE_URL . 'inicio/notificaciones'?>">Ver todas las publicaciones</a>
							</li>
						</ul>
					</div>
                    
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<!-- Call Search -->
					<!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
					<!-- #END# Call Search -->

					<?php /*if ( Session::get('nivel') == 2 ) : ?>
						<li><a href="<?=BASE_URL . 'usuarios/usuarios_no_habilitados'?>"><i class="fa fa-cog"></i> No Habilitados</a></li>
					<?php endif;*/ ?>

					<li><a href="<?=BASE_URL?>"><i class="fa fa-home"></i> Inicio</a></li>
                    <li><a href="<?=BASE_URL . 'perfil'?>"><i class="fa fa-users"></i> Perfil</a></li>
                    <li><a href="<?=BASE_URL . 'chat'?>"><i class="fa fa-comments"></i> Chat</a></li>
					<li><a href="<?=BASE_URL . 'drive'?>"><i class="fa fa-cloud"></i> Drive</a></li>
					
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
							<i class="fa fa-cog"></i>
							Opciones
						</a>
						<ul class="dropdown-menu">
							<li class="header">Opciones</li>
							<li class="body">
								<ul class="menu tasks">
									<?php if ( Session::get('adm') != 1 ) : ?>
                                    <li>
										<a href="<?=BASE_URL . 'inicio'?>">
											<h4>Publicaciones</h4>
										</a>
									</li>
                                    <?php endif; ?>
									<li>
										<a href="<?=BASE_URL . 'perfil'?>">
											<h4>Perfil de usuario</h4>
										</a>
									</li>
                                    <?php if ( Session::get('adm') == 1 ) : ?>
                                    <li>
										<a href="<?=BASE_URL . 'admin/usuarios'?>">
											<h4>Administrar Contenidos</h4>
										</a>
									</li>
                                    <?php endif; ?>
									<li>
										<a href="<?=BASE_URL . 'usuarios/logout'?>">
											<h4>Cerrar Sesión</h4>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		
	</nav>
	