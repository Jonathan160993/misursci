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
    $("#idproducto").val("");
    $("#nombre").val("");
    $("#precio").val("");
    $("#existencia").val("");
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
        $("#btnguardar").prop("disable",false);
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
                url:'../ajax/productoajax.php?op=listar',
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
//funcion para guardar y editar registros 

function guardaryeditar(e) {
	e.preventDefault();
	$("#btnGuardar").prop("disable",true);
	let formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/productoajax.php?op=guardaryeditar",
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

function mostrar(idproducto)
{
    $.post("../ajax/productoajax.php?op=mostrar",{idproducto : idproducto},
     function(data, status)
    {

        data = JSON.parse(data);
        mostrarform(true);
        
        $("#nombre").val(data.nombre);
        $("#precio").val(data.precio);
        $("#existencia").val(data.existencia);
        $("#idproducto").val(data.idproducto);

    })

}

function desactivar(idproducto)
{
    bootbox.confirm("¿Estas seguro de desactivar este producto?", function(result){
        if(result)
        {
             $.post("../ajax/productoajax.php?op=desactivar",{idproducto : idproducto},
             function(e)
             {  
                bootbox.alert(e);
                 tabla.ajax.reload();
             });
        }
    })
}

function activar(idproducto)
{
    bootbox.confirm("¿Estas seguro de activar este producto?", function(result){
        if(result)
        {
             $.post("../ajax/productoajax.php?op=activar",{idproducto : idproducto}, function(e){  
                bootbox.alert(e);
                tabla.ajax.reload();
             });
        }
    })
}




init();