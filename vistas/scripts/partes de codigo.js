function confirmarproducto(cont) {

    let inpCaa = document.getElementsByName('cantidadp[]');
    let inpP = document.getElementsByName("precio[]");
    let inpS = document.getElementsByName("subtp");
    

    i=0;
    
  for ( i = 0; i < cont; i++) {

        let inpC = inpCaa[i];
        let vinpP = inpP[i];
        let vinpS = inpS[i];   
        boton.addEventListener("clicK", function(i){ validar(i)})
        if (validar(i)) {
            vinpS.value = vinpP.value * inpC.value; 
            document.getElementsByName("subtp")[i].innerHTML = vinpS.value;  
        } else {
            alert("ERROR. No puedes agregar mas productos que de los que hay en inventario");
        }
       
    }

}


if(parseInt(vinE.value) > parseInt(inpC.value)){
    console.log(true);
    console.log("cantidar",inpC.value);
    console.log("tipo de dato",typeof inpC.value);
    console.log("exisrencia",vinE.value);
    console.log("tipo de dato",typeof vinE.value); 
    console.log(cont);
    console.log("tipo de dato",typeof cont);
}else{
    console.log(false);
    console.log("cantidar",inpC.value);
    console.log("tipo de dato",typeof  inpC.value);
    console.log("exisrencia",vinE.value);
    console.log("tipo de dato",typeof vinE.value); 
    console.log(cont);
    console.log("tipo de dato",typeof cont);
}
vinpS.value = vinpP.value * inpC.value; 
document.getElementsByName("subtp")[i].innerHTML = vinpS.value;  

