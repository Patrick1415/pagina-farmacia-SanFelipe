<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../css/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../css/adminlte.min.css">
<!-- SweetAlert 2 -->
<link rel="stylesheet" href="../css/sweetalert2.css">
<!-- Select 2 -->
<link rel="stylesheet" href="../css/select2.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../vista/adm_catalogo.php" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#ModalAcerca">Acerca de</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto nav-flex-icons">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
            <img src="../img/iconuser.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            Usuario
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalCenter">Cerrar Sesion</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Modal Cerrar Sesion -->
    <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalCenterTitle">Cerrar Sesion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">¿Deseas cerrar sesion?</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <a href="../controlador/Logout.php" class="btn btn-danger" role="button">Cerrar Sesion</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Acerca de -->
    <div class="modal fade" id="ModalAcerca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Acerca de</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <b>Desarrolladores:</b><br>
            -Flores Moya Mathias Fabricio<br>
            -Lezcano Tirado Luis Ramon<br>
            -Ruiz Rodriguez Nestor Eduardo<br>
            -Reyna Pastor Ximena Paulina<br>
            -Rodriguez Ordinola Patrick Angelo<br>
            -Tokumoto Mora Jhon Jorge Hideaki<br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../vista/adm_catalogo.php" class="brand-link">
        <img src="../img/pastillas.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">San Felipe</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <?php
            if ($_SESSION['nombre_tipo'] == 'Administrador') {
            ?>
              <img src="../img/administrador.png" class="img-circle elevation-2" alt="User Image">
            <?php
            } else {
            ?>
              <img src="../img/tecnico.png" class="img-circle elevation-2" alt="User Image">
            <?php
            }
            ?>
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <?php
              echo $_SESSION['nombre_us'];
              echo ' ';
              echo '(';
              echo $_SESSION['nombre_tipo'];
              echo ')';
              ?>
            </a>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header">Usuario</li>
            <li class="nav-item">
              <a href="editar_datos_personales.php" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Datos personales
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_usuario.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Gestor de Usuarios
                </p>
              </a>
            </li>
            <li class="nav-header">ALMACEN</li>
            <li class="nav-item">
              <a href="adm_producto.php" class="nav-link">
                <i class="nav-icon fas fa-pills"></i>
                <p>
                  Gestor de Productos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_atributo.php" class="nav-link">
                <i class="nav-icon fas fa-vials"></i>
                <p>
                  Gestor de Atributos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_lote.php" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Gestor de Lote
                </p>
              </a>
            </li>
            <li class="nav-header">COMPRAS</li>
            <li class="nav-item">
              <a href="adm_proveedor.php" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>
                  Gestor de Proveedores
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>