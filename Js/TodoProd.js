
$('#btnBuscar').click(function(){
    window.location.href= "TodoProd.php?b="+document.getElementById('inpBuscar').value;
});


$('#btnFiltrar').click(function(){
    $.ajax({
        data: {"categoria" : document.getElementById('prodCat').value, "min": document.getElementById('minimo').value, 
        "max": document.getElementById('maximo').value, "ordenar":document.getElementById('prodOrd').value, 
        "b":document.getElementById('busquedaText').getAttribute('busqueda')},
        type: "POST",
        dataType: "json",
        url: "APIs/CargarProdBusqFiltros.php" 
    }).done(function (result) {
      if(result){
        document.getElementById('Columnas').innerHTML = result;
      }else{
        
      }
    
    }).fail(function (result) {
        
    });  
});