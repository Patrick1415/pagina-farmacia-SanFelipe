<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3 || $_SESSION['us_tipo'] == 2) {
    include_once 'layouts/header.php';
?>
    <?php
    include_once 'layouts/nav.php';
    ?>

    <div class="modal fade" id="cambiologo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Logo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="logoactual" src="../img/ardilla.jpg" class="profile-user-img img-fluid img-circle">
                    </div>
                    <div class="text-center">
                        <b id="nombre_logo">
                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="edit-prov" style="display: none;">
                        <span><i class="fas fa-check m-1"></i>Se cambio el Logo correctamente</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noedit-prov" style="display: none;">
                        <span><i class="fas fa-times m-1"></i>El Logo no es correcto</span>
                    </div>
                    <form id="form-logo" enctype="multipart/form-data">
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="photo" class="input-group">
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_logo_prov" id="id_logo_prov">
                            <input type="hidden" name="avatar" id="avatar">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crearproveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Proveedor</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add-prov" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Se agrego un nuevo Proveedor</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd-prov" style='display:none;'>
                            <span><i class="fas fa-times m-1"></i>El Proveedor ingresado, ya existe!</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit-prove" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>El Proveedor se modifico correctamente!</span>
                        </div>
                        <form id="form-crear">
                           <div class="form-group">
                               <label for="nombre">Nombres</label>
                               <input id="nombre" type="text" class="form-control" placeholder="Ingresar nombre de la distribuidora o persona" required>
                           </div>
                           <div class="form-group">
                               <label for="telefono">Telefono</label>
                               <input id="telefono" type="number" class="form-control" placeholder="Ingresar Telefono / Celular" required>
                           </div>
                           <div class="form-group">
                               <label for="correo">Correo</label>
                               <input id="correo" type="text" class="form-control" placeholder="Ingresar Correo Electronico">
                           </div>
                           <div class="form-group">
                               <label for="direccion">Dirección</label>
                               <input id="direccion" type="text" class="form-control" placeholder="Ingresar Dirección" required>
                           </div>
                           <input type="hidden"id="id_edit_prov">
                    </div>

                    <div class="card-footer">
                         <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                         <button  type="button" data-dismiss="modal" class="btn btn-danger float-right m-1">Cerrar</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><b>Gestor de Proveedores <button type="button" data-toggle="modal" data-target="#crearproveedor" class="btn bg-gradient-primary ml-2">Crear Proveedor</button></b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestor de Proveedores</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Proveedor</h3>
                        <div class="input-group">
                            <input type="text" id="buscar_proveedor" class="form-control float-left" placeholder="Ingresar nombre del Proveedor">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="proveedores" class="row d-flex align-items-stretch">

                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src="../js/Proveedor.js"></script>