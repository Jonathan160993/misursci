<?php
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
<!--inicio de contenido html -->
<div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Consulta De ventas</h1>
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
                            <th>Fecha</th>
                            <th>Cliente/tienda</th>
                            <th>Monto de venta</th>
                            <th>Chofer</th>
                            <th>Detalles</th>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot> 
                             <th>Fecha</th>
                            <th>Cliente/tienda</th>
                            <th>Monto de venta</th>
                            <th>Chofer</th>
                            <th>Detalles</th>
                          </tfoot>
                        
                        </table>
                        
                    </div>
                     
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->



<!--Aqui se visualizan los productos vendidos a detalle de cada vendedor -->
  <div class="modal fade" id="myModald" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Productos Vendidos</h4>
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
<!--Fin DE MODAL DONDE SE MUESTRAN LOS PRODUCTOS VENDIDOS EN CADA VENTA-->


<?php
}
else
{
  require 'noacceso.php';
}
      //pie de pagina
      require 'footer.php';
 ?> 
<!--script para generar codigo de barras para clientes-->
 <script type="text/javascript"  src="scripts/cventas.js"  ></script>

 <?php
}
ob_end_flush();
?>
