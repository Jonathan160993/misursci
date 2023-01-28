let tabla;

function init()
{
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e)
        {
            guardaryeditar(e);
        })

        $.post("../ajax/rutaajax.php?op=listaru", function(r){
            $("#idusuario").html(r);
            $('#idusuario').selectpicker('refresh');
    });

    $.post("../ajax/rutaajax.php?op=listarz", function(r){
        $("#idzona").html(r);
        $('#idzona').selectpicker('refresh');
   });

}

//funcion limpiar 
function limpiar()
{
    //aqui se colocan los di de los campos del formulario
    //estos ids pertenecen a los campos del formulario en html
    $("#izona").val("");
    $("#idusuaeio").val("");
    $("#fecha").val("");

    $("#totalPro").val("");
    $("#totalp").html("0");
    $(".filas").remove();
    $("#total").html("0");
    $("#costoRuta").val("");
    

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
        $("#cancelar").show();
        listarproducto();

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
                url:'../ajax/rutaajax.php?op=listar',
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
	//$("#btnGuardar").prop("disable",true);
	let formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/rutaajax.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

        success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	         listar();
	    }
	});
    limpiar();
}

function mostrar(idproducto)
{
    $.post("../ajax/rutaajax.php?op=mostrar",{idproducto : idproducto},
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

function anular(idruta)
{
    bootbox.confirm("¿Estas seguro de anular la ruta?", function(result){
        if(result)
        {
             $.post("../ajax/rutaajax.php?op=anular",{idruta : idruta},
             function(e)
             {  
                bootbox.alert(e);
                 tabla.ajax.reload();
             });
        }
    })
}

function listarproducto()
{
    tabla=$('#tblproducto').dataTable(
    {
      "aProcessing":true, //se activa el procesamiento del datatable
      "aServerSide":true, //permite pa paginacion y el filtrado de la informacion
      dom: 'Bfrtip', //se definen los elementos del control de la tabla
      buttons:
            [   
            ],
       "ajax":
            {
                url:'../ajax/rutaajax.php?op=listarArticulo',
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

function listardetalle(idruta)
{             
            tabla=$('#tbldetalle').dataTable(
                {
                  "aProcessing":true, //se activa el procesamiento del datatable
                  "aServerSide":true, //permite pa paginacion y el filtrado de la informacion
                  dom: 'Bfrtip', //se definen los elementos del control de la tabla
                  buttons:
                        [   
                        ],
                   "ajax":
                        {
                            url:'../ajax/rutaajax.php?op=listarDetalle',                    
                            type: "POST",
                            data: {'idruta' : idruta},
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

let cont=0;
let detalles=0;
let exis=0;
let cantidadp=0;
$("#guardar").hide();
const estiloB = "border: 1px solid #ccc; border-radius: 4px; width: 4rem;";
const estiloTr = "width: 2px";


function agregarp(idproducto, nombre, existencia, precio) {
    

    
    exis=existencia;
    let pre=precio;
    if (idproducto!="") 
    {
       
        let subtp=0;
        let fila='<tr  class="filas" id="fila'+cont+'">'+
    	'<td style="'+estiloTr+'"><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'<td style="'+estiloTr+'"><input type="hidden" id="idproducto" name="idproducto[]" value="'+idproducto+'">'+nombre+'</td>'+
    	'<td style="'+estiloTr+'"><input type="hidden"  name="existencia[]" id="existencia[]" value="'+exis+'"  style="'+estiloB+'">'+exis+'</input></td>'+
        '<td style="'+estiloTr+'"><input type="number"  name="cantidadp[]" id="cantidadp[]" value="'+cantidadp+'"   style="'+estiloB+'"></td>'+
        '<td style="'+estiloTr+'">$<input type="hidden" name="precio[]" id="precio[]" value="'+pre+'" disabled  style="'+estiloB+'">'+pre+'</input></td>'+
        '<td style="'+estiloTr+'">$<span name="subtp" id="subtp'+cont+'">'+subtp+'</span></td>'+
    	'</tr>'
    	cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
        
    
      
    }else
    {
        alert("Error al agregar producto");
    }

}
function confirmarproducto(cont) {

    let inpCa = document.getElementsByName('cantidadp[]');
    let inpP = document.getElementsByName("precio[]");
    let inpS = document.getElementsByName("subtp");    
    let inE = document.getElementsByName("existencia[]");



    
  for ( i = 0; i <= cont; i++) {
         
        let inpC = inpCa[i];
        let vinpP = inpP[i];
        let vinpS = inpS[i];   
        let vinE = inE[i]; 
           
        
      //  validar();
        if(parseInt(vinE.value) > parseInt(inpC.value)&& 0 < parseInt(inpC.value)){
            document.getElementsByName('cantidadp[]')[i].style.border="1.8px solid #1ed12d";
            document.getElementsByName("subtp")[i].style.color="#1ed12d";
            vinpS.value = vinpP.value * inpC.value; 
            document.getElementsByName("subtp")[i].innerHTML = vinpS.value; 
            calculart();

        }else{

            //document.getElementsByName('cantidadp[]')[i].style.border=" 2px solid #bb2929";
            document.getElementsByName('cantidadp[]')[i].style.border="1.8px solid #f33920c4";
            document.getElementsByName("subtp")[i].style.color=" #843534";
            document.getElementsByName("subtp")[i].style.opacity="1";
            $("#guardar").hide()
            break; 
            //alert("Error. No puedes agregar mas productos de los que ya hay en inventario");
        }

    }

}
 //funcion que calcula el costo total de la ruta y la cantidad de producto que se lleva el vendedor
function calculart(){
      let sub =  document.getElementsByName("subtp");
  	let  total = 0.0;
    let tot =0;
    let inCant = document.getElementsByName('cantidadp[]')

  	for (var i = 0; i <sub.length; i++) {
		total += document.getElementsByName("subtp")[i].value;
        let totalp =inCant[i]  
         tot += parseInt(totalp.value);  
	}
    //total de producto es igual a la cantidad de productos 
    $("#totalp").html("Pzas/"+tot);
    $("#totalPro").val(tot);

    //total es igual a el costo de toda la ruta
	$("#total").html("$/ " + total);
    $("#costoRuta").val(total);

    evaluar();

}

function evaluar(){
    if (detalles>0)
  {
    $("#guardar").show();
  }
  else
  {
    $("#guardar").hide(); 
    cont=0;
  }
}

function eliminarDetalle(indice){
    $("#fila" + indice).remove();
    calculart();
    detalles=detalles-1;
    evaluar();
}

init();