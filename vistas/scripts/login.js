$("#frmAcceso").on('submit',function(e)
{
    e.preventDefault();
    correo=$("#correo").val();
     pass=$("#pass").val();

    $.post("../ajax/usuarioajax.php?op=verificar",
    {"correo":correo, "pass":pass}, 
    function(dato)
    {
         if (dato!="null") 
         {
             $(location).attr("href","productov.php");
         }else{
                bootbox.alert("Usuario y/o Contraseña incorrectos");
         }   
    });
})

