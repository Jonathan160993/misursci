<?php
    //encabezado de pagina
ob_start();
session_start();

if (!isset($_SESSION["correo"])) 
{
  header ('Location: vistas/login.html');
}else
{
 require 'header.php';
 if($_SESSION['almacen']==1)
 {
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Productos   <button class="btn btn-success" 
                          onclick="mostrarform(true)" id="btnagregar">
                          <i class="fa fa-plus-circle"></i>  Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" 
                        id="listadoregistros">
                        <table id="tbllistado" class="table table-striped
                                table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Existencia</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Existencia</th>
                            <th>Estado</th>
                          </tfoot>
                        
                        </table>
                        
                    </div>
                     <!----------------formulario para insertar productos--> 
                    <div class="panel-body table-responsive" style="height: 400px;" 
                        id="formularioregistros">
                        <!--compos para agregar productos -->
                        <form name="formulario" id="formulario" method="POST">

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Nombre:</label>
                            <input type="hidden" name="idproducto" id="idproducto">
                            <input type="text" class="form-control" name="nombre" id="nombre"
                            maxlength="50" placeholder="Nombre" required>
                          </div>
                        
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Precio:</label>
                            <input type="number" class="form-control" name="precio" id="precio"
                             maxlength="50" placeholder="Precio" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Existencia en almacen:</label>                            
                            <input type="number" class="form-control" name="existencia" id="existencia" 
                            maxlength="50" placeholder="Existencia en almacen" required>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar" >
                              <i class="fa fa-save"></i>Guardar</button>

                            <button class="btn btn-danger" type="button"  onclick="cancelarForm()">
                              <i class="fa fa-arrow-circle-left"></i>Cancelar</button>

                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
 <?php
 }
 else
{
  require 'noacceso.php';
}
      //pie de pagina
      require 'footer.php';
 ?>    
 <script type="text/javascript"  src="scripts/producto.js"  ></script>
<?php
}
ob_end_flush();
?>