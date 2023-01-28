let tabla;

function init()
{
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e)
        {
            guardaryeditar(e);
        })

        $.post("../ajax/clienteajax.php?op=filtra", function(r){
                $("#idzona").html(r);
                $('#idzona').selectpicker('refresh');
        });



}

//funcion limpiar 
function limpiar()
{
    //aqui se colocan los i de los campos del formulario
    //estos ids pertenecen a los campos del formulario en html
    $("#idcliente").val("");
    $("#nombre").val("");
    $("#codigo").val("");
    $("#idzona").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#nombretienda").val("");
    $("#imprimir").hide();
    $("#nombretienda").addClass("form-control");
    $("#nombretienda").css("border"," 1px solid #ccc")
    $("#nombre").css("border"," 1px solid #ccc")
    //$("#nombretienda2").addClass("form-group")
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
        $("#mensajen").hide();
        $("#mensajet").hide();
       
    //    document.getElementById("nombretienda").style.border="#555"

    
        
    } else
        {
            $("#listadoregistros").show();
            $("#formularioregistros").hide();
            $("#btnagregar").show();
            $("#mensajen").hide();
            $("#mensajet").hide();
            
            //activarcampo();
            
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
                url:'../ajax/clienteajax.php?op=listar',
                type : "get", 
                dataType : "json",
                error: function(e){  
                    console.log(e.responseText);
                }
            },

            "bDestroy": true,"iDisplayLength": 5,"order":[[0, "desc"]]
    }).DataTable();
}

//funcion para desactivar campo del codigo
function desactivarcampo(){
    let codigo = document.getElementById("codigoo");
        codigo.disabled=true;
}

//volvemos a activar el campo
function activarcampo(){
    let codigo = document.getElementById("codigoo");
        codigo.disabled=false;
}


//funcion para guardar y editar registros 

function guardaryeditar(e) {
	e.preventDefault();
	$("#btnGuardar").prop("disable",true);
	let formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/clienteajax.php?op=guardaryeditar",
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

function mostrar(idcliente)
{
    $.post("../ajax/clienteajax.php?op=mostrar",{idcliente : idcliente},
     function(data, status)
    {

        data = JSON.parse(data);
        
        mostrarform(true);
        
        $("#idzona").val(data.nombrezona);
        $('#idzona').selectpicker('refresh');
        $("#nombre").val(data.nombre);
        $("#codigo").val(data.codigo);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#idcliente").val(data.idcliente);
      //  desactivarcampo();
    })

}

function desactivar(idcliente)
{
    bootbox.confirm("¿Estas seguro de desactivar este cliente?", function(result){
        if(result)
        {
             $.post("../ajax/clienteajax.php?op=desactivar",{idcliente : idcliente},
             function(e)
             {  
                bootbox.alert(e);
                 tabla.ajax.reload();
             });
        }
    })
}

function activar(idcliente)
{
    bootbox.confirm("¿Estas seguro de activar este cliente?", function(result){
        if(result)
        {
             $.post("../ajax/clienteajax.php?op=activar",{idcliente : idcliente}, function(e){  
                bootbox.alert(e);
                tabla.ajax.reload();
             });
        }
    })
}
//funcion para generar el codigo de barras para identificar a los clientes
function generarbarcode() 
{
    
    let nombre =document.getElementById("nombre");
    let nombret =document.getElementById("nombretienda"); 
    let codigo =document.getElementById("codigo");
    let codigoo =document.getElementById("codigoo");

    if (nombre.value.length != 0 && nombret.value.length != 0) {

         codigo.value = nombre.value.slice(0,5)+nombret.value.slice(0,6);
         codigoo.value = nombre.value.slice(0,5)+nombret.value.slice(0,6);
         console.log(codigoo);
        document.getElementById("codigoo").innerHTML =  codigoo.value;
        document.getElementById("codigo").innerHTML =  codigo.value;
        document.getElementById("nombre").style.border="1.8px solid #1ed12d"
        document.getElementById("nombretienda").style.border="1.8px solid #1ed12d"
        $("#mensajen").hide();
        $("#mensajet").hide();
       // return codigo;
        //let zonac = zona.value.slice(5,8); //  let codigo = zonac;

    } else {

        if (nombre.value.length == 0 && nombret.value.length != 0) {
           document.getElementById("nombre").style.border="1.8px solid #f33920c4"
            document.getElementById("nombretienda").style.border="1.8px solid #1ed12d"
            $("#nombretienda").addClass("has-error");
            $("#mensajen").show();
            $("#mensajet").hide();
            
        } else {
            if (nombre.value.length != 0 && nombret.value.length == 0) 
            {

                document.getElementById("nombre").style.border="1.8px solid #1ed12d";
                $("#mensajen").hide();
                document.getElementById("nombretienda").style.border="1.8px solid #f33920c4";
                $("#mensajet").show();
                
            } else{
                document.getElementById("nombre").style.border="1.8px solid #f33920c4"
                document.getElementById("nombretienda").style.border="1.8px solid #f33920c4"
                $("#mensajen").show();
                $("#mensajet").show();
            }
        }        

         
    }

   
}








function imprimir() 
{
    codigo=$("#codigo").val();
    JsBarcode("#barcode", codigo);
    $("#imprimir").show();
    $("#imprimir").printArea();    
}


init();