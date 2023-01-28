let tabla;

function init()
{
    mostrarform(false);
    listar();

}

//Funcion para mostrar el formulario
function mostrarform(bandera)
{
    
    
    //condicion para mostrar formulario e informacion
    if(bandera)
    {
        //los ids de esta funcion pertenecen al listado
        //para mostar los datos en el html
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnguardar").prop("disable",false);
       
    } else
        {
            $("#listadoregistros").show();
            $("#formularioregistros").hide();
          
        }

}

//funcion para listar datos
function listar()
{
    tabla=$('#tbllistado').dataTable(
    {
      "aProcessing":true, //se activa el procesamiento del datatable
      "aServerSide":true, //permite la paginacion y el filtrado de la informacion
      dom: 'Bfrtip', //se definen los elementos del control de la tabla
      buttons:
            [   //botones necesarios para exportar a estos formatos
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
       "ajax":    
            {
                url:'../ajax/permisoajax.php?op=listar',
                type : "get", 
                dataType : "json",
                error: function(e){  
                    console.log(e.responseText);
                }
            },

            "bDestroy": true,
            "iDisplayLength": 5,
            "order":[[0, "desc"]]
    }).DataTable();
}

init();