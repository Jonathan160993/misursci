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
if($_SESSION['administracion']==1)
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
                          <h1 class="box-title" >Rutas   <button class="btn btn-success" 
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
                            <th>Fecha</th>
                            <th>Zona</th>
                            <th>Empleado</th>
                            <th>valor de ruta</th>
                            <th>Estatus</th>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot>
                           <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Zona</th>
                            <th>Empleado</th>
                            <th>valor de ruta</th>
                            <th>Estatus</th>
                          </tfoot>
                        
                        </table>
                        
                      </div>

                      
                     <!----------------formulario para insertar productos--> 
                        <div class="panel-body table-responsive"  
                        id="formularioregistros">
                        <!--compos para agregar productos -->
                        <form name="formulario" id="formulario" method="POST">

                        <div class="form-group col-lg-6 col-md-6 col-sm-8 
                          col-xs-12">
                            <label>Empleado:</label>
                              <select name="idusuario" id="idusuario" class="form-control selectpicker"
                                data-live-search="true"  require></select>
                            
                          </div>

                          <div class="form-group  col-lg-6 col-md-6 col-sm-8 
                          col-xs-12">
                            <label>Zona:</label>
                              <select name="idzona" id="idzona" class="form-control selectpicker"
                                data-live-search="true"  require></select>
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha"
                             maxlength="50" placeholder="Fecha" required>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <a data-toggle="modal" href="#miModal">           
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"
                              style="margin-bottom: 1rem"> 
                              <span class="fa fa-plus"></span> Agregar Producto</button>
                            </a>
                          </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 panel-body table-responsive">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">                          
                                <thead style="background-color:orange;">
                                    <th>Quitar</th>
                                    <th>Artículo</th>
                                    <th>Existencia</th>
                                    <th>Cantidad</th>
                                    <th>Precio </th>
                                    <th> Subtotal</th>
                                    
                                </thead>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                     
                                </tfoot>
                                <tbody>
                                  
                                </tbody>
                            </table>
                            
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 panel-body>
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">                          
                                <thead style="background-color:orange;">
                                    <th>Cantidan total de Articulos</th>
                                    <th><h4 id="totalp"> 0</h4><input type="hidden" name="totalPro" id="totalPro"></th>
                                    <th>Costo total de ruta</th>
                                    <th><h4 id="total"> 0</h4><input type="hidden" name="costoRuta" id="costoRuta"></th>  
                                </thead>
                                <tfoot>
                                    <th><button id="boton" type="button"  onclick="confirmarproducto(detalles)"   class="btn btn-info"><span class="fa fa-check">
                                      Validar Ruta
                                    </span></button></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>                    
                                </tfoot>
                                <tbody>
                                  
                                </tbody>
                

                          </div>          
                            
                          </div>
                        
                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="guardar">
                                 <button class="btn btn-primary" type="submit" id="btnGuardar" >
                                  <i class="fa fa-save"></i>Guardar</button> 
                              </div>


                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="cancelar"> 
                                  <button class="btn btn-danger" type="button" id="btncancelar" onclick="cancelarForm()">
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
  <!--Modal-->
  <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Producto</h4>
        </div>
        <div class="modal-body">
          <table id="tblproducto" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Existencia</th>              
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Existencia</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  

  <!--aqui se encuentra el modal para visualizar los productos agregados en la ruta-->
  <div class="modal fade" id="myModald" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Productos Cargados</h4>
        </div>
        <div class="modal-body">
          <table id="tbldetalle" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Nombre</th>
                <th>Cantidad</th>            
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
                <th>Nombre</th>
                <th>Cantidad</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>
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

 <script type="text/javascript"  src="scripts/ruta.js"  ></script>
<?php
}
ob_end_flush();
?>
