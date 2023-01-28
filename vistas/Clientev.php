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
                          <h1 class="box-title" >Clientes   <button class="btn btn-success" 
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
                            <th>Nombre del local</th>
                            <th>Codigo</th>
                            <th>Zona</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Estatus</th>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Nombre del local</th>
                            <th>Codigo</th>
                            <th>Zona</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
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
                            <input type="hidden" name="idcliente" id="idcliente">
                            <input type="text" class="form-control" name="nombre" id="nombre"
                            maxlength="75" placeholder="Nombre" required>
                            <p  class="mensajen" id="mensajen" >debes introducir el nombre del cliente</p>       
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12" id="nombretienda2">
                            <label>Nombre de tienda/local:</label>
                            <input type="text"  class="form-control" name="nombretienda" id="nombretienda"
                            maxlength="75" placeholder="Nombre" required>
                            <p class="mensajet" id="mensajet" >debes introducir el nombre de la tienda</p>
                          </div>
                        
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Zona:</label>
                              <select name="idzona" id="idzona" class="form-control selectpicker"
                                data-live-search="true"  require></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Direccion:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion"
                             maxlength="50" placeholder="Diereccion" required>
                          </div>
                      
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                          col-xs-12">
                            <label>Telefono:</label>                            
                            <input type="tel" class="form-control" name="telefono" id="telefono" 
                            maxlength="10" placeholder="Numero Telefonico" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 
                           col-xs-12">
                            <label>Codigo:</label>
                            <input type="text" class="form-control" name="codigoo" id="codigoo" maxlength="50"   placeholder="Codigo" required disabled>
                            <input type="hidden" class="form-control" name="codigo" id="codigo" maxlength="50"   placeholder="Codigo" required >
                            <button class="btn btn-success" type="button" onclick="generarbarcode()">Generar codigo</button>
                             <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir Codigo</button> 
                             <div id="imprimir">
                                  <svg id="barcode"></svg>
                              </div>
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
<!--script para generar codigo de barras para clientes-->
 <script type="text/javascript"  src="../publico/js/JsBarcode.all.min.js"  ></script>
 <script type="text/javascript"  src="../publico/js/jquery.PrintArea.js"  ></script>
 <script type="text/javascript"  src="scripts/cliente.js"  ></script>

 <?php
}
ob_end_flush();
?>
