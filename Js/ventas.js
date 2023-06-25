function Filtrar(){
   var c = document.getElementById('tipoCon').value;
   var cat = "";
    if(document.getElementById('prodCat').value != "Selecciona una Categoria")
        cat = document.getElementById('prodCat').value;
   

   if(c == "detallada"){
    var parametrosD = {
        "ventasFiltrosD" : "si",
        "fechaI" : document.getElementById('minimo').value,
        "fechaF" : document.getElementById('maximo').value,
        "cat" : cat};
    $.ajax({
        data: parametrosD,
        type: "POST",
        url: "APIs/API_User.php"
    }).done(function (re) {
    
      document.getElementById('ventas').innerHTML = re;
    }).fail(function (re) {
        console.log("La solicitud regreso con un error: " + re);
    });
   }else{
    
    var m="";
    var y="";
    var F = document.getElementById('minimo').value;
    if(F != ''){  
        m= new Date(F).getMonth();
        m++ ;
        y= new Date(F).getFullYear();       
    }
    var parametros = {
        "ventasA" : "si",
        "month" : m,
        "year" : y,
        "cat" : cat};
       
    $.ajax({
        data: parametros,
        type: "POST",
        url: "APIs/API_User.php"
    }).done(function (re) {
    alert(re);
      document.getElementById('ventas').innerHTML = re;
    }).fail(function (re) {
        console.log("La solicitud regreso con un error: " + re);
    });
   }
   
}


function Consulta(){
    if(document.getElementById('tipoCon').value == "agrupada"){
        document.getElementById('maximo').setAttribute("hidden","");
    }else{
        document.getElementById('maximo').removeAttribute("hidden");
    }
}