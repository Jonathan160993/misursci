<?php
    //encabezado de pagina
ob_start();
session_start();
if (!isset($_SESSION["correo"])) 
{
  header("Location: login.html");
}else
{
require 'header.php';
if($_SESSION['acceso']==1)
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
                          <h1 class="box-title" >Usuarios   <button class="btn btn-success" 
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
                            <th>Cargo</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Estatus</th>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Estatus</th>
                          </tfoot>
                        
                        </table>
                        
                    </div>
                     <!----------------formulario para insertar productos--> 
                    <div class="panel-body table-responsive"  
                        id="formularioregistros">
                        <!--compos para agregar productos -->
                        <form name="formulario" id="formulario" method="POST">

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Nombre:</label>
                            <input type="hidden" name="idusuario" id="idusuario">
                            <input type="text" class="form-control" name="nombre" id="nombre"
                            maxlength="75" placeholder="Nombre" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Cargo ocupado:</label>                
                            <select name="cargo" id="cargo" class="form-control select-picker" required>
                                <option value="chofer">Chofer</option>
                                <option value="Almacenista">Almacenista</option>
                                <option value="administrador">Administrativo</option>
                                <option value="ayudante">Ayudante</option>
                            </select>
                          </div>
                                         
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Telefono:</label>
                            <input type="tel" class="form-control" name="telefono" id="telefono"
                            maxlength="10" placeholder="Telefono" required>
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Correo Electronico:</label>
                            <input type="email" class="form-control" name="correo" id="correo"
                             maxlength="50" placeholder="Correo Electronico" required>
                          </div>
                      
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Contraseña:</label>                            
                            <input type="password" class="form-control" name="pass" id="pass" 
                            maxlength="64" placeholder="pass" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                          <ul style="list-style: none;" id="permiso">

                          </ul>             
                            
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

 <script type="text/javascript"  src="scripts/usuario.js"  ></script>
<?php
}
ob_end_flush();
?>
