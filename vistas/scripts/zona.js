let tabla;

function init()
{
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e)
        {
            guardaryeditar(e);
        })


}

//funcion limpiar 
function limpiar()
{
    //aqui se colocan los di de los campos del formulario
    //estos ids pertenecen a los campos del formulario en html
    $("#idzona").val("");
    $("#nombre").val("");
    $("#poblado").val("");
    
}

//Funcion para mostrar el formulario
function mostrarform(bandera)
{
    limpiar();
    
    //condicion para mostrar formulario e informacion
    if(bandera)
    {
        //los ids de esta funcion pertenecen al listado
        //para mostar los datos en el html
        
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnguardar").prop("disable",true);
        $("#btnagregar").hide();
        
        
    } else
        {
            $("#listadoregistros").show();
            $("#formularioregistros").hide();
            $("#btnagregar").show();
            
        }

}

//funcion para ocultar el formulario
function cancelarForm()
{   //limpia los campos y oculta el formulario
    mostrarform(false);
    limpiar();
    
}

//funcion para listar datos
function listar()
{
    tabla=$('#tbllistado').dataTable(
    {
      "aProcessing":true, //se activa el procesamiento del datatable
      "aServerSide":true, //permite pa paginacion y el filtrado de la informacion
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
                url:'../ajax/zonaajax.php?op=listar',
                type : "get", 
                dataType : "json",
                error: function(e){  
                    console.log(e.responseText);
                }
            },

            "bDestroy": true,"iDisplayLength": 5,"order":[[0, "desc"]]
    }).DataTable();
}
//funcion para guardar y editar registros 

function guardaryeditar(e) {
	e.preventDefault();
	$("#btnGuardar").prop("disable",true);
	let formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/zonaajax.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

        success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }
	});
    limpiar();
}

function mostrar(idzona)
{
    $.post("../ajax/zonaajax.php?op=mostrar",{idzona : idzona},
     function(data, status)
    {

        data = JSON.parse(data);
        mostrarform(true);
        $("#nombre").val(data.nombrezona);
        $("#poblado").val(data.poblado);
        $("#idzona").val(data.idzona);
       

    })

}

function desactivar(idzona)
{
    bootbox.confirm("¿Estas seguro de desactivar este cliente?", function(result){
        if(result)
        {
             $.post("../ajax/zonaajax.php?op=desactivar",{idzona : idzona},
             function(e)
             {  
                bootbox.alert(e);
                 tabla.ajax.reload();
             });
        }
    })
}

function activar(idzona)
{
    bootbox.confirm("¿Estas seguro de activar este cliente?", function(result){
        if(result)
        {
             $.post("../ajax/zonaajax.php?op=activar",{idzona : idzona}, function(e){  
                bootbox.alert(e);
                tabla.ajax.reload();
             });
        }
    })
}




init();