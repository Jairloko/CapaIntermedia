function Filtrar(){
    var cat = "";
    if(document.getElementById('prodCat').value != "Selecciona una Categoria")
        cat = document.getElementById('prodCat').value;
    var parametros = {
        "pedidosFiltros" : "si",
        "fechaI" : document.getElementById('minimo').value,
        "fechaF" : document.getElementById('maximo').value,
        "cat" : cat};
    $.ajax({
        data: parametros,
        type: "POST",
        url: "APIs/API_User.php"
    }).done(function (re) {
    
      document.getElementById('pedidos').innerHTML = re;
    }).fail(function (re) {
        console.log("La solicitud regreso con un error: " + re);
    });
}

$('#btnBuscar').click(function(){
    window.location.href= "TodoProd.php?b="+document.getElementById('inpBuscar').value;
});