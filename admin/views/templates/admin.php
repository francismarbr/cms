<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo URL_CMS; ?>/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_CMS; ?>/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URL_CMS; ?>/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL_CMS; ?>/assets/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo URL_CMS; ?>/assets/adminlte/dist/css/skins/skin-blue-light.min.css">

  <link rel="stylesheet" href="<?php echo URL_CMS; ?>/assets/css/estilos.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo URL_CMS; ?>/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b>BT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>EFEBIT</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li>
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> Olá <?php echo $nome_usuario; ?></span>
            </a>
            
          </li>

          <li>
            <a href="<?php echo URL_CMS.'/login/logout'; ?>">
              <i class="fa fa-exit"></i> Sair
            </a>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="<?php echo ($menu_ativo == 'dashboard') ? 'active' :''; ?>">
          <a href="<?php echo URL_CMS; ?>/dashboard">
            <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
          </a>
        </li>

        <li class="header">MÓDULO CMS</li>

        <li class="treeview <?php echo ($menu_ativo == 'conteudo') ? 'active' :'';?>">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Conteúdo</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              
              <li <?php echo ($submenu_ativo == 'post') ? 'class="active"'  :''; ?>><a href="<?php echo URL_CMS; ?>/pagina"><i class="fa fa-file-text"></i> <span>Páginas e Posts</span></a></li>

              <li <?php echo ($submenu_ativo == 'categoria') ? 'class="active"'  :''; ?>><a href="<?php echo URL_CMS; ?>/categoria"><i class="fa fa-ellipsis-v"></i> <span>Categorias</span></a></li>
              
            </ul>
          </li>

          <li class="<?php echo ($menu_ativo == 'midia') ? 'active' :''; ?>">
            <a href="<?php echo URL_CMS; ?>/midia">
              <i class="fa fa-image"></i> <span>Mídia</span>
            </a>
          </li>

          <li class="<?php echo ($menu_ativo == 'produto') ? 'active' :''; ?>">
            <a href="<?php echo URL_CMS; ?>/produto">
              <i class="fa fa-cube"></i> <span>Produtos</span>
            </a>
          </li>

          <li class="<?php echo ($menu_ativo == 'servico') ? 'active' :''; ?>">
            <a href="<?php echo URL_CMS; ?>/servico">
              <i class="fa fa-tasks"></i> <span>Serviços</span>
            </a>
          </li>

          <li class="<?php echo ($menu_ativo == 'galeria') ? 'active' :''; ?>">
            <a href="<?php echo URL_CMS; ?>/galeria">
            <i class="fa fa-camera-retro"></i> <span>Galeria de fotos</span>
            </a>
          </li>

          <li class="<?php echo ($menu_ativo == 'profissional') ? 'active' :''; ?>">
            <a href="<?php echo URL_CMS; ?>/profissional">
              <i class="fa fa-user-circle-o"></i> <span>Profissional</span>
            </a>
          </li>

          <li class="<?php echo ($menu_ativo == 'portfolio') ? 'active' :''; ?>">
            <a href="<?php echo URL_CMS; ?>/portfolio">
              <i class="fa fa-cubes"></i> <span>Portfólio</span>
            </a>
          </li>

          <li class="<?php echo ($menu_ativo == 'banner') ? 'active' :''; ?>">
            <a href="<?php echo URL_CMS; ?>/banner">
              <i class="fa fa-dashboard"></i> <span>Banners Slider</span>
            </a>
          </li>

          <li class="treeview <?php echo ($menu_ativo == 'configuracoes') ? 'active' :''; ?>">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Configurações</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php echo ($submenu_ativo == 'perfilAcesso') ? 'class="active"'  :''; ?>><a href="<?php echo URL_CMS; ?>/perfilAcesso"><i class="fa fa-unlock-alt"></i>Perfis de Acesso</a></li>

              <li <?php echo ($submenu_ativo == 'permissao') ? 'class="active"'  :''; ?>><a href="<?php echo URL_CMS; ?>/permissao"><i class="fa fa-key"></i>Permissões</a></li>

              <li <?php echo ($submenu_ativo == 'usuario') ? 'class="active"'  :''; ?>><a href="<?php echo URL_CMS; ?>/usuario"><i class="fa fa-users"></i>Usuários</a></li>
            </ul>
          </li>

      </ul>

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
      <?php $this->carregarView($nomeView, $dadosView); ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Sistema desenvolvido pela <a href="https://efebit.com" target="_blank"> EFEBIT </a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy;2015 - <?php echo date('Y'); ?> </strong> 
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo URL_CMS; ?>/assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL_CMS; ?>/assets/js/script.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo URL_CMS; ?>/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL_CMS; ?>/assets/adminlte/dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>